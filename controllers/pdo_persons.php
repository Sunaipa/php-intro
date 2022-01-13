<?php 

$db = new PDO(
    "mysql:host=127.0.0.1;dbname=formation_cda_2022;charset=utf8",
    "root",
    ""
);

//Récupération des paramètre du script transmis dans l'url
$id = (int) filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

//Gestion de la suppression
if ($id && $action === "delete") {
    $sql = "DELETE FROM persons WHERE id=$id";
    $db->exec($sql);
    header("location: ". getLinkToRoute("pdo_persons"));
    exit;
}

//Requete pour lister toutes les personnnes
$result = $db->query("SELECT * FROM persons");

$data = $result->fetchAll(PDO::FETCH_OBJ);

//Affichage de la vue
echo render("persons", ["personList" => $data]);





/*
Récupération des résultats dans une boucle while
while ( ($row = $result->fetch(PDO::FETCH_OBJ)) !== false) {
    echo "<p>{$row->first_name} {$row->last_name} </p>";
};
*/

/*
Récupération des résultats un à un

$row = $result->fetch(PDO::FETCH_ASSOC);
var_dump($row);
echo "<p> {$row['first_name']} {$row['last_name']} </p>";

$row = $result->fetch(PDO::FETCH_NUM);
var_dump($row);
echo "<p>{$row[2]} {$row[1]} </p>";
*/
