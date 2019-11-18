<?php

declare(strict_types=1);

namespace App\Request\Song;

use Service\ValidatableDTOInterface;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Constraints as Assert;

class Create implements ValidatableDTOInterface
{
    /**
     * @SWG\Property(type="string")
     * @Assert\NotNull()
     * @Assert\Length(min="3", max="255")
     *
     * @var string
     */
    private $track;

    /**
     * @SWG\Property(type="string")
     * @Assert\NotNull()
     * @Assert\Length(min="3", max="255")
     *
     * @var string
     */
    private $artist;

    /**
     * @SWG\Property(type="string")
     * @Assert\NotNull()
     * @Assert\Length(min="3", max="255")
     *
     * @var string
     */
    private $album;

    /**
     * @SWG\Property(type="integer")
     * @Assert\NotNull()
     * @Assert\Length(max="4")
     * @Assert\GreaterThanOrEqual(max="1970")
     *
     * @var int
     */
    private $year;

    /**
     * @return string
     */
    public function getTrack(): string
    {
        return $this->track;
    }

    /**
     * @param string $track
     */
    public function setTrack(string $track): void
    {
        $this->track = $track;
    }

    /**
     * @return string
     */
    public function getArtist(): string
    {
        return $this->artist;
    }

    /**
     * @param string $artist
     */
    public function setArtist(string $artist): void
    {
        $this->artist = $artist;
    }

    /**
     * @return string
     */
    public function getAlbum(): string
    {
        return $this->album;
    }

    /**
     * @param string $album
     */
    public function setAlbum(string $album): void
    {
        $this->album = $album;
    }

    /**
     * @return string
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }
}
