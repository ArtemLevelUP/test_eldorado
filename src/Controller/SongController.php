<?php

declare(strict_types=1);

namespace App\Controller;

use Annotations\RestController;
use App\Entity\Song;
use App\Request\Song\Create;
use App\Service\SongUtil;
use Doctrine\ORM\EntityManagerInterface;
use Service\ApiResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart")
 * @RestController()
 */
class SongController
{
    /**
     * @var ApiResponder
     */
    private $responder;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var SongUtil
     */
    private $songUtil;

    /**
     * SongController constructor.
     * @param ApiResponder $responder
     * @param EntityManagerInterface $em
     * @param SongUtil $songUtil
     */
    public function __construct(ApiResponder $responder, EntityManagerInterface $em, SongUtil $songUtil)
    {
        $this->responder = $responder;
        $this->em = $em;
        $this->songUtil = $songUtil;
    }

    /**
     * @Route("/", methods={"GET"})
     * @return Response
     */
    public function list(): Response
    {
        return $this->responder->answer(
            $this->em->getRepository(Song::class)->findAll()
        );
    }

    /**
     * @Route("/{song}", methods={"GET"})
     * @param Song $song
     * @return Response
     */
    public function read(Song $song): Response
    {
        return $this->responder->answer($song);
    }

    /**
     * @Route("/", methods={"POST"})
     * @param Create $createRequest
     * @return Response
     */
    public function create(Create $createRequest)
    {
        $song = $this->songUtil->create($createRequest);

        return $this->responder->answer($song, Response::HTTP_CREATED);
    }
}