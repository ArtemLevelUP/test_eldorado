<?php

declare(strict_types=1);

namespace Request;

use Symfony\Component\HttpFoundation\Request;

class PaginationRequest
{
    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    private $page;

    /**
     * PaginationRequest constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->limit = $request->query->getInt('limit', 25);
        $this->page = $request->query->getInt('page', 1);
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }
}
