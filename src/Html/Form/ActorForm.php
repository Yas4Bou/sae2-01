<?php
declare(strict_types=1);

namespace Html\Form;
use Entity\actor;
// use Html\StringEscaper;

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

    /**
     * Cette méthode prend en paramètre un url
     * @param string $url
     * Cette méthode retourne la représentation HTML du formulaire
     * @return String
     */
    public function getHtmlForm(string $url): String
    {
        $html = '<form action="' . $url . '" method="POST">';

        if ($this->actor !== null) {
            $html .= '<input type="hidden" name="id" value="' . $this->actor?->getId() . '">';

            $html .= '<label for="name">Nom:</label>';
            $html .= '<input type="text" name="name" value="' . $this->escapeString($this->actor?->getName() ?? '') . '" required>';
        }
        
        $html .= '<button type="submit">Enregistrer</button>';

        $html .= '</form>';

        return $html;
    }

    public function setEntityFromQueryString(): void
    {
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? null;


        if ($id !== null && is_numeric($id)) {
            $id = (int)$id;
        } else {
            $id = null;
        }


        if ($name === null) {
            throw new ParameterException("Le nom de l'acteur est requis.");
        }


        $name = $this->stripTagsAndTrim($name);


        $this->actor = new actor($name, $id);
    }

}