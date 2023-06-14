<?php

declare(strict_types=1);

namespace Entity;

class movie_cast
{
    private int $id ;
    private string $name ;
    private int|null $avatarId;
    private string $role;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
    * @return string
    */
    public function getRole(): string
    {
        return $this->role;
    }
    /**
    * @return int
    */
    public function getAvatarId(): int
    {
        if (is_null($this->avatarId))
        {
            $this->avatarId = 0;
        }
        return $this->avatarId;
    }



}
