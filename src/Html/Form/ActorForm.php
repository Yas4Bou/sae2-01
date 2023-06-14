<?php
declare(strict_types=1);

namespace Html\Form;
use Entity\actor;

class ActorForm
{
    private ?Actor $actor;

    /**
     * @param actor|null $actor
     */
    public function __construct(?actor $actor)
    {
        $this->actor = $actor;
    }

    /**
     * @return actor|null
     */
    public function getActor(): ?actor
    {
        return $this->actor;
    }


}