<?php

    //var_dump($_POST);

    // Le formulaire a-t-il été envoyé
    $isPosted = isset($_POST["submit"]);
    $isPosted = filter_has_var(INPUT_POST, "submit");

    $errors ="";

    // Traitement des données du formulaire 
    if($isPosted) {
        // Récupération des données
        $name = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_STRING);
        $age = filter_input(INPUT_POST, "userAge", FILTER_SANITIZE_NUMBER_INT);
        $skills = filter_input(INPUT_POST, "skills", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
        $address = filter_input(INPUT_POST, "address", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        var_dump($address);

        $agreed = isset($_POST["agreed"]);
        var_dump($skills);

        // Validation de la saisie
        if(empty($name)) {
            $errors .= "<li> Vous devez saisir le nom </li>";
        }
        if (empty($age)) {
            $errors .= "<li> Vous devez saisir l'age </li>";
        }
    }
    

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php if(! empty($errors)): ?>
        <ul>
            <?= $errors ?>
        </ul>
<?php endif ?>

    <form method="post" > 
        <div>
            <label>Nom</label>
            <input type="text" name="userName" value="<?=$name ?? '' ?>" >
        </div>
        <div>
            <label>Age</label>
            <input type="number" name="userAge" value="<?=$age ?? '' ?>" >
        </div>

        <div>
            <input type="checkbox" name="agreed" value="ok">
            <label>J'accepte de vendre mon âme</label>
        </div>

        <div>
            <h3>Compétences</h3>
            <div>
                <input type="checkbox" name="skills[]" value="javadcript">
                <label>Javascript</label>
            </div>
            <div>
                <input type="checkbox" name="skills[]" value="php">
                <label>PHP</label>
            </div>
            <div>
                <input type="checkbox" name="skills[]" value="angular">
                <label>Angular</label>
            </div>
        </div>

        <fieldset>
            <legend>Adresse</legend>
            <div>
                <label>Rue</label>
                <input type="text" name="address[street]">
            </div>
            <div>
                <label>Code postal</label>
                <input type="text" name="address[zipcode]">
            </div>
            <div>
                <label>Vilee</label>
                <input type="text" name="address[city]">
            </div>
        </fieldset>
        
        <button type="submit" name="submit">Valider</button>
    </form>

    <!-- Affichage du résultat -->
    <?php if (empty($errors) && $isPosted): ?>
        <?= "Hello $name, vous avez $age ans</p>"?>
        <?php if($agreed): ?>
            <p>Vous avez tout accepté</p>
        <?php endif ?>       
    <?php endif ?>

</body>
</html>