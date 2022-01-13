<?php 

$db = new PDO(
    "mysql:host=127.0.0.1;dbname=formation_cda_2022;charset=utf8",
    "root",
    ""
);

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
