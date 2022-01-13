<?php


/**
 * Récupération des infos de la route
 *
 * @param string $page
 * @param array $routes
 * @return array un tableau contenant le nom de la route et son chemin
 */
function getRouteInfos(string $page, array $routes, string $notFound = "not_found"): array {
	// Résolution du routage
	if(array_key_exists($page, $routes)){
		$controller = $routes[$page];
	} else {
		$controller = $page;
	}

	// Gestion d'un contrôleur dont le fichier n'existe pas
	$controllerPath = "controllers/$controller.php";
	if(! file_exists($controllerPath)){
		$controllerPath = "controllers/$notFound.php";
	}
	return [
		"controller" => $controller,
		"controllerPath" => $controllerPath
	];

}

/**
 * function de calcul du rendu d'un modèle et retourne ce contenu sous la forme d'une chaine de caractere
 *
 * @param string $template
 * @param array $params
 * @return string  Resultat
 */
function getTemplateContent(string $template, array $params = []): string {
	ob_start();
	$templatePath = "views/$template.php";
	$content = "Impossible de charger le modèle";
	if(file_exists($templatePath)) {
		extract($params, EXTR_OVERWRITE);
		include $templatePath;
		$content = ob_get_clean();
	}

	return $content;
}



function render(string $template, 
				array $params = [], 
				string $layout = "gabarit"): string 
{
	$params["content"] = getTemplateContent($template, $params);
	return getTemplateContent($layout, $params);
}


/**
 * Obtient le lien vers une route 
 *
 * @param string $route
 * @param array $query
 * @return string
 */
function getLinkToRoute(string $route, array $query = [null]): string {
	$queryString = "";
	foreach ($query as $key => $value) {
		$queryString .= "&$key=$value";
	}
	return "/index.php?page=$route$queryString";
}


/**
 * Fonction pour la mise en place de la base de donnée et
 * facilité son exploitation
 *
 * @return PDO
 */

function getPDO(): PDO {
	return new PDO(DSN, DB_USER, DB_PASS, [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
	]);
}