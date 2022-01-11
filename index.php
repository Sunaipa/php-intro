<?php
//Récupération du nom du contrôleur. Par defaut "intro
$page = filter_input(INPUT_GET, "page")?? "intro";

//Table de routage
$routes = [
    "telechargement" => "upload",
    "contact" => "formulaire",
    "test-lib" => "include-tools"
];

//Résolution du routage
if (array_key_exists($page, $routes)) {
    $controller = $routes[$page];
} else {
    $controller = $page;
}

//Gestion d'un controleur dont le fichier n'existe pas
$controllerPath = "controllers/$controller.php";
if (!file_exists($controllerPath)) {
    $controllerPath = "controllers/not_found.php";
};

require $controllerPath;