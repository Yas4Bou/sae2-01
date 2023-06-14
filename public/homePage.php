<?php

declare(strict_types=1);
require_once '../vendor/autoload.php';

use Css\AppWebPage;
use Entity\homeCollection;

$homePage = new AppWebPage('Film');
$requete = new homeCollection();
$tableau = $requete ->findAll();


foreach ($tableau  as $key => $value) {
    $l = $homePage->escapeString($value ->getTitle());
    $id = $value ->getId();
    $homePage->appendContent("<a href='http://localhost:8000/moviePage.php?nombre=$id'>$l</a></div>");
}


$date = $homePage ->getLastModification();
$homePage ->appendContent("<footer>$date</footer>");

$css = "
body {
  display: flex;
  flex-direction: column;
  justify-content: stretch;
  gap: 0.5em 2em;
  background-color: black;
  color:white;
}

header {
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid white;
    padding: 10px;
    margin-bottom: 20px;
    color: red;
}


footer {
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid white;
    padding: 10px;
    

}
";
$homePage -> appendCss($css);


echo $homePage->TOHTML();