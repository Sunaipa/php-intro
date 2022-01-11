<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginView</title>
</head>
<body>

    <?php if($hasErrors): ?>
        <ul>
            <?php foreach($errors as $message): ?>
                <li><?= $message ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Identifiant :</label>
            <input type="text" name="login" class="form-controle"> 
        </div>
        <div>
            <label class="form-label">Password :</label>
            <input type="password" name="password" class="form-controle"> 
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-primary">Go</button>
        </div>
    </form>
</body>
</html>