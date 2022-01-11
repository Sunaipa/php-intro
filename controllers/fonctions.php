<?php

function hello($name = "world")
{
    echo "Hello " . $name . '<br>';
    echo "Hello $name <br>";
};

$hola = function ($name) {
    echo "Hello $name <br>";
};

$f = "hola";

$f2 = "hello";


hello("andre");
$hola("Jen");

$$f("Paul");

$f2("Jon");

hello();

/**
 * Fait la some d'une liste d'entiers
 * et retourne cette somme avec un préfixe
 * 
 * @param string $message le préfixe
 * @param integer ...$numbers la liste des nombres
 * @return string
 */
function add(string $message, int ...$numbers): string
{
    $total = 0;
    foreach ($numbers as $n) {
        $total += $n;
    }
    return $message . $total;
}
echo add("Le résultat est : ", 5, 8, 2, 8);


function addString(string &$str)
{
    $str .= " dans un pays fort lointain";
}
$str = "Il était une fois";
addString($str);
echo $str;
