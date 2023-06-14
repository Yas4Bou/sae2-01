<?php
declare(strict_types=1);

use Entity\afficheCollection;

if(isset($_GET["nombre"])){
    $Id = $_GET['nombre'];
    $idCover = new afficheCollection();
    $idCover ->findAll($Id);


