<?php
require '../config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
        <h2>Connexion</h2>
        <form action="" method="post">
            <input type="text" name="nom" placeholder="Email" value="<?= htmlspecialchars($email ?? '') ?>">
            <br>
            <p class="error-message"><?php echo $errors['Email'] ?? '' ?></p>

            <input type="password" name="prenom" placeholder="Mot de passe" value="<?= htmlspecialchars($mot_de_passe ?? '') ?>">
            <br>
            <p class="error-message"><?php echo $errors['mot_de_passe'] ?? '' ?></p>

            <input type="checkbox" name="souvenir_de_moi" placeholder="Se souvenir de moi" value="<?= htmlspecialchars($souvenir ?? '') ?>">
            <br>
            <p class="error-message"><?php echo $errors['souvenir_de_moi'] ?? '' ?></p>

            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>