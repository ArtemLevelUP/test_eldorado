<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Song;
use App\Request\Song\Create;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;

class SongUtil
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * SongUtil constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Create $createRequest
     *
     * @return Song
     */
    public function create(Create $createRequest): Song
    {
        $song = (new Song())
            ->setTrack($createRequest->getTrack())
            ->setArtist($createRequest->getArtist())
            ->setAlbum($createRequest->getAlbum())
            ->setYear($createRequest->getYear())
            ->setDateCreate(Carbon::now());

        $this->em->persist($song);
        $this->em->flush();

        return $song;
    }
}