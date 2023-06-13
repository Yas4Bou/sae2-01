<?php
declare(strict_types=1);

require_once '../vendor/autoload.php';

use Css\AppWebPage;
use Entity\movieCollectionRequete1;
use Entity\movieCollectionRequete2;

$moviePage = new AppWebPage();

if(isset($_GET["nombre"])){
    $Id = $_GET['nombre'];

   $requetes1 = new movieCollectionRequete1();
   $tableau1 = $requetes1 ->findAll($Id);


   foreach ($tableau1  as $key => $value) {
        $title = $moviePage->escapeString($value->getTitle());
        $originTitle = $moviePage->escapeString($value->getOriginaltitle());
        $tagline = $moviePage->escapeString($value->getTagline());
        $overview = $moviePage->escapeString($value->getOverview());
        $moviePage -> setTitle(" Films - $title");
        $releaseDate = $value->getReleaseDate();
        $moviePage->appendContent("<p> $title     date de sortie : $releaseDate <br> Titre d'origine : $originTitle <br> Slogan : $tagline <br> Resumer :  $overview </p>");
   }
   $requetes2 = new movieCollectionRequete2();
   $tableau2 = $requetes2->findAll($Id);


    foreach ($tableau2  as $key => $value) {
        $name = $moviePage->escapeString($value->getName());
        $role = $moviePage->escapeString($value->getRole());
        $id = $value->getId();
        $moviePage->appendContent("<a href='http://localhost:8000/actorPage.php?nombre=$id'>Role : $role <br> vrai nom : $name </a></p>\n");
   }


   $date = $moviePage ->getLastModification();
   $moviePage ->appendContent("<footer>$date</footer>");

}
else{
    header("Location : http://localhost:8000/homePage.php", true, 302);
    exit(1);
}
echo $moviePage->toHtml();
