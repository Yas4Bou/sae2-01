<?php
declare(strict_types=1);

namespace Css;

use Html\WebPage;

class AppWebPage extends WebPage
{
    /**
     * @param string $title
     */
    public function __construct(string $title = "")
    {
        \Html\WebPage::__construct($title);
        $this->appendCssUrl("/css/style.css");
    }

    public function toHtml(): string
    {
        $text = "<!doctype html>\n<html lang=\"fr\">\n";
        $text .= "<head>\n";
        $text .= "<meta charset='UTF-8' name='viewport'>\n";
        $text .= "<title>\n" . $this->escapeString($this->getTitle()) . "\n</title>";
        $text .= "\n" . $this->getHead() . "\n</head>\n";
        $text .= "<body>\n";
        $text .= "<header>" . "<h1>" . $this->escapeString($this->getTitle()) . "</h1>" . "</header>";
        $text .= $this->getBody() . "\n";
        $text .= "</body>\n</html>";
        return $text;
    }
}