<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;

class affiche
{
    private int $id ;
    private string $jpeg;
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
    public function getJpeg(): string
    {
        return $this->jpeg;
    }
    

}
