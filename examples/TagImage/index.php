<?php

/*
 *  Header que será utilizado.
 */
header("Content-type:application/json");

/*
 * Obtendo o Path principal
 */
$MainPath = realpath(dirname(dirname(dirname(__FILE__))));

// Incluindo arquivo correspondente a classe.
require_once($MainPath . '\core\settings.php');
require_once($MainPath . '\core\TagImage.php');

// Localizações da requisição
$RequestLocation = CVA_API_LOCATION_ARRAY;

/*
 * Imagem que será utilizada.
 */
$imageUrl = 'http://www.freedigitalphotos.net/images/img/homepage/golf-1-top-82328.jpg';

// Usar header principal?
$useMainHeader = True;

// Instanciando classe...
$Analyze = new \rqdev\packages\ComputerVisionAPI\TagImage();


$Sucess = $Analyze
        ->setAPILocation($RequestLocation[2])
        ->Send($imageUrl, $useMainHeader);


if ($Sucess) {
    // Resposta
    $ResponseObject = $Analyze->getResponse();

    // Pretty-Print
    $prettyJson = true;

    // Json
    $JsonResponse = $ResponseObject->toJson($prettyJson);

    // Array
    $ArrayResponse = $ResponseObject->toArray();

    // Objeto
    $ObjectResponse = $ResponseObject->toObject();

    // Resposta JSON
    echo $JsonResponse;
} else {
    var_dump($Analyze->getError());
}



