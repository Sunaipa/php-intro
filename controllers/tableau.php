<?php 

$cities = [
    "Paris", "Berlin", "Madrid", "Dublin"
];

foreach($cities as $item) {
    echo $item."<br>";
}

foreach($cities as $key => $item) {
    echo $key." = ". $item."<br>";
}
// Choix aléatoire d'un ville
echo $cities[array_rand($cities)];

shuffle($cities);
var_dump($cities)


?>