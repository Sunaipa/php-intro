<?php
$sujet = [
    "cadavre exquis", "troupe de singe", "killa", "un chien"
];
$verbe = [
    "mange", "bois", "marche", "vole", "est"
];
$complement = [
    "une courgette", "une app", "là", "dans un parc"
];


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
    <form method="post">
        <button type="submit" name="submit">GO</button>
    </form>
    <p>
        <?php echo $sujet[array_rand($sujet)] . ' ' . $verbe[array_rand($verbe)] . ' ' . $complement[array_rand($complement)] ?>
    </p>
</body>
</html>