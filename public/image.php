<?php
declare(strict_types=1);

use Entity\cover;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

try {
    ///////////////////////
    // À vous de jouer ! //
    ///////////////////////
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
if(isset($_GET['imageID'])){
    $Id = $_GET['imageID'];
    if ($Id === 0 ){
        echo file_get_contents("Image\actor.jpeg");
    }
    $image= new cover();
    $image = cover::findById($Id);
    header("Content-Type : image/jpeg");
    echo $image->getJpeg();
    }
else {
    throw new \Entity\Excpetion\ParameterException();
}

