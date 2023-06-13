<?php

declare(strict_types=1);

namespace Entity;

class actor
{
    private string|null $death;
    private int $avatarId ;
    private string|null $birthday;
    private string $name;
    private string $biography;
    private string $placeOfBirth;
    private int $id;


    /**
    * @return int
    */
    public function getAvatarId(): int
    {
        return $this->avatarId;
    }

    /**
    * @return string
    */
    public function getBirthday(): string
    {
        if (is_null($this->birthday))
        {
            $this->birthday = " incon";
        }
        return $this->birthday;
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
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
    * @return string
    */
    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    /**
    * @return int
    */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * getter de la date de mort
     * @return string|null
     */
    public function getDeath(): string
    {
        if (is_null($this->death)){
            $this->death = "encore vivant";
        }
        return $this->death;
    }




}
