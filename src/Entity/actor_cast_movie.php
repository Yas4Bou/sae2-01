<?php

declare(strict_types=1);

namespace Entity;

class actor_cast_movie
{
    private int $id ;
    private string $title;
    private string $role;
    private string $releaseDate;

    private int $posterId;

    private int|null $avatarId;

    /**
    * @return int
    */
    public function getId(): int
    {
        return $this->id;
    }
    /**
    * @return string
    */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
    * @return string
    */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
    * @return string
    */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
    * @return int
    */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

}
