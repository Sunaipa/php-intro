<?php 

$filter = filter_input(INPUT_GET, "startWith");

// Lecture des données du fichier skills.json
$skillPath = 'data/skills.json';
$skills = file_get_contents($skillPath);

$skillsAsArray = json_decode($skills, true);

$skillsAsObjet = json_decode($skills);


// Le formulaire a-t-il été envoyé
$isPosted = isset($_POST["submit"]);
$isPosted = filter_has_var(INPUT_POST, "submit");

// Traitement des données du formulaire 
if($isPosted) {
    // Récupération des données
    $skillName = filter_input(INPUT_POST, "skill", FILTER_SANITIZE_STRING);
    // Validation de la saisie
    if (! empty($skillName)) {
        $skillsAsArray[] = ["code"=> uniqid(), "label"=>$skillName];
        file_put_contents($skillPath, json_encode($skillsAsArray));
        header("location:". getLinkToRoute("skills"));
    };
};

$skillsAsArray = array_map
    (function($item) {
        $item["label"] = strtoupper($item["label"]);
        return $item;
    },
    $skillsAsArray
);

//Lien vers les premières lettre des compétences
$letters = array_map (
    function($item){
        return substr($item, 0, 1);
    },    
    array_column($skillsAsArray, "label")
);
$letters = array_unique($letters);


//Filtrage des données
$skillsAsArray = array_filter($skillsAsArray,
    function($item) use ($filter) {
        return str_starts_with($item["label"],$filter);
});




echo render("skills", [
    "skills" => $skillsAsArray,
    "skillsObj" => $skillsAsObjet,
    "letters" => $letters
]); 