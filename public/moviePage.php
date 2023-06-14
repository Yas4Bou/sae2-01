<?php
declare(strict_types=1);

require_once '../vendor/autoload.php';

use Css\AppWebPage;
use Entity\movie; 
use Entity\movie_cast;

$moviePage = new AppWebPage();

if(isset($_GET["nombre"])){
    $Id = $_GET['nombre'];

    $value1 = movie::findAll($Id);


    $title = $moviePage->escapeString($value1->getTitle());
    $originTitle = $moviePage->escapeString($value1->getOriginaltitle());
    $tagline = $moviePage->escapeString($value1->getTagline());
    $overview = $moviePage->escapeString($value1->getOverview());
    $moviePage -> setTitle(" Film - $title");
    $releaseDate = $value1->getReleaseDate();
    $posterId = $value1->getPosterId();
    $moviePage->appendContent("<nav> 
                               <div class='info'>
                                 <img src= 'image.php?imageID=$posterId' width='100px' height='150px'>
                                 <article class='info__item'> $title </article>    
                                 <article class='info__item'> Date de sortie : $releaseDate </article> 
                                 <article class='info__item'> Titre d'origine : $originTitle </article>  
                                 <article class='info__item'> Slogan : $tagline </article> 
                                 <article class='info__item'> Résumer :  $overview </article> 
                                    </div>
                                   </nav>");

   $value = movie_cast::findAll($Id);



   $name = $moviePage->escapeString($value->getName());
   $role = $moviePage->escapeString($value->getRole());
   $avatarId = $value ->getAvatarId();
   $id = $value->getId();
   $moviePage->appendContent("<div class='main'>
                               <img src= 'image.php?imageID=$avatarId' width='100px' height='150px'>
                               <article class='main__item'><a href='http://localhost:8000/actorPage.php?nombre=$id'>Role : $role</a></article>
                               <article class='main__item'><a href='http://localhost:8000/actorPage.php?nombre=$id'>Vrai nom : $name</a></article>
                           </div>");



   $date = $moviePage ->getLastModification();
   $moviePage ->appendContent("<footer>$date</footer>");

}
else{
    header("Location : http://localhost:8000/homePage.php", true, 302);
    exit(1);
}



$moviePage->appendCssUrl("css/MovieCss.css");


echo $moviePage->toHtml();
