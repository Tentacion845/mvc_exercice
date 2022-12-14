<?php

    // fonction pour analyser l'en-tête http auth

    $bdd = array("addr"=>'localhost', 'bdd'=> 'test', 'user'=>'root', 'pwd'=>'');

    require 'lib/Request.php';
    require 'lib/DataBase.php';

    $getcontroller = $_GET['controller'] ?? 'Default';
    $getaction = $_GET['action'] ?? 'index';

    $controller = $getcontroller.'Controller';
    $action = $getaction.'Action';
    $view = $getaction.'View';

    $request = new Request($_GET, $_POST, $_SERVER, $_FILES);

    $dataBase = new DataBase($bdd['addr'], $bdd['bdd'], $bdd['user'], $bdd['pwd']);

    // try {
        require 'Controller/'.$controller.'.php';
        $controller = new $controller($dataBase);
        $params = $controller->$action($request);

        include './Views/'.$getcontroller.'/'.$view.'.php';
    // } catch (\Throwable $throwable) {
    //     die('Une erreur est survenue durant le traitement');
    // }
