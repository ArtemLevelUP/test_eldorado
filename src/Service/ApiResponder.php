<?php

declare(strict_types=1);

namespace Service;

use Knp\Component\Pager\PaginatorInterface;
use Request\PaginationRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ApiResponder
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * ApiResponder constructor.
     * @param SerializerInterface $serializer
     * @param PaginatorInterface $paginator
     */
    public function __construct(SerializerInterface $serializer, PaginatorInterface $paginator)
    {
        $this->serializer = $serializer;
        $this->paginator = $paginator;
    }

    /**
     * @param mixed|null $data
     * @param int $code
     * @param array $groups
     * @param string $format
     * @return Response
     */
    public function answer($data = null, int $code = Response::HTTP_OK, array $groups = [], string $format = 'json')
    {
        if (empty($groups)) {
            $groups[] = 'Default';
        }
        $data = $this->serializer->serialize($data, $format, ['groups' => $groups]);
        $response = new Response();
        $response->setContent($data);
        $response->setStatusCode($code);
        $response->headers->set('Content-Type', (new Request())->getMimeType($format));

        return $response;
    }

    /**
     * @param PaginationRequest $paginationRequest
     * @param null $data
     * @param int $code
     * @param array $groups
     * @param string $format
     *
     * @return Response
     */
    public function paginatedAnswer(PaginationRequest $paginationRequest, $data = null, int $code = Response::HTTP_OK, $groups = [], $format = 'json')
    {
        $pagination = $this->paginator->paginate($data, $paginationRequest->getPage(), $paginationRequest->getLimit());
        $result = [
            'items' => $pagination->getItems(),
            'page'  => $pagination->getCurrentPageNumber(),
            'limit' => $pagination->getItemNumberPerPage(),
            'total' => $pagination->getTotalItemCount(),
        ];

        return $this->answer($result, $code, $groups, $format);
    }

    /**
     * @param ConstraintViolationListInterface $errors
     * @param int                              $code
     *
     * @return Response
     */
    public function violation(ConstraintViolationListInterface $errors, int $code = Response::HTTP_BAD_REQUEST): Response
    {
        $data = [];
        $headers = [];

        foreach ($errors as $error) {
            /** @var ConstraintViolationInterface $error */
            if (!\array_key_exists($error->getPropertyPath(), $data)) {
                $data[$error->getPropertyPath()] = [];
            }

            $data[$error->getPropertyPath()][] = $error->getMessage();
            if (isset($error->getConstraint()->payload['HEADERS'])) {
                $headers = array_merge($headers, $error->getConstraint()->payload['HEADERS']);
            }
        }

        return new JsonResponse(['errors' => $data], $code, $headers);
    }
}
