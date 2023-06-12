<?php

declare(strict_types=1);

namespace Html;

class WebPage
{
    private string $head ;
    private string $title ;
    private string $body ;


    /**
     * @param string $title */
    public function __construct(string $title = "")
    {
        $this->title = $title;
        $this->head = "";
        $this->body = "";

    }

    /**
     * @return string
     */
    public function getHead() : string
    {
        return $this->head;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody() : string
    {
        return $this->body;
    }
    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


    /**
     * @param string $content
     * @return void
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }


    /**
     * @param string $css
     * @return void
     */
    public function appendCss(string $css): void
    {
        $this->head .= "<style>\n $css \n </style>";
    }


    /**
     * @param string $url
     * @return void
     */
    public function appendCssUrl(string $url): void
    {
        $this->head.= "<link rel=\"stylesheet\" href=\"$url\"/>";

    }


    /**
     * @param string $js
     * @return void
     */
    public function appendJs(string $js): void
    {
        $this->head.= "<script> $js </script>";

    }


    /**
     * @param string $url
     * @return void
     */
    public function appendJsUrl(string $url): void
    {
        $this->head .= "<script src=\"$url\"></script>";
    }


    /**
     * @param string $content
     * @return void
     */
    public function appendContent(string $content): void
    {
        $this->body.= $content;
    }


    /**
     * @return string
     */
    public function TOHTML(): string
    {
        $text = "<!doctype html>\n<html lang=\"fr\">\n";
        $text .= "<head>\n";
        $text .= "<meta charset='UTF-8' name='viewport'>\n";
        $text .= "<title>\n$this->title\n</title>";
        $text .= "\n$this->head\n</head>\n";
        $text .= "<body>\n$this->body\n</body>\n</html>";
        return $text;
    }


    /**
     * @param string $string
     * @return string
     */
    public function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES|ENT_HTML5);

    }

    /**
     * @return string
     */
    public static function getLastModification(): string

    {
        return date( "l jS \of F Y h:i:s A", getlastmod());
    }

}
