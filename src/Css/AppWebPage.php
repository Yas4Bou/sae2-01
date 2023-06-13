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


}