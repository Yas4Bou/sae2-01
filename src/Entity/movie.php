<?php

declare(strict_types=1);

namespace Entity;

class movie
{
    private int $posterId;
    private string $originalLanguage;
    private string $originaltitle;
    private string $overview;
    private string $releaseDate;
    private int $runtime;
    private string $tagline;
    private string $title;

    /**
    * @return int
    */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
    * @return string
    */
    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    /**
    * @return string
    */
    public function getOriginaltitle(): string
    {
        return $this->originaltitle;
    }

    /**
    * @return string
    */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
    *  @return string
    */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
    * @return int
    */
    public function getRuntime(): int
    {
        return $this->runtime;
    }

    /**
    * @return string
    */
    public function getTagline(): string
    {
        return $this->tagline;
    }/**
 * @return string
 */
public function getTitle(): string
{
    return $this->title;
}










}
