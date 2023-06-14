<?php
declare(strict_types=1);

trait StringEscaper
{
    public function escapeString(?string $string): string
    {
        if ($string === null) {
            return '';
        } else {
            return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5);
        }
    }

    public function stripTagsAndTrim(?string $string): string
    {
        if ($string === null) {
            return '';
        } else {
            return trim(strip_tags($string));
        }
    }
}