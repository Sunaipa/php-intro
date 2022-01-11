<?php

$sujet = [
    "cadavre exquis", "troupe de singe", "killa", "un chien"
];

$verbe = [
    "mange", "boix", "marche", "vole", "est"
];

$complement = [
    "une courgette", "une app", "là", "dans un parc"
];

shuffle($sujet);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadavre exqui</title>
</head>
<body>
    <h2>Cadavre exquis</h2>
    <p>>
        <php echo $sujet[rand] ?>
    </p>
</body>
</html>