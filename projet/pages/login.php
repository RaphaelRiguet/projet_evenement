<?php
ob_start();
session_start();
include_once '../includes/header.php';
?>

<!-- Structure HTML pour les formulaires de connexion -->
<div class="login-container">
    <!-- Formulaire de connexion utilisateur -->
    <div class="login-box">
        <h3>Connexion Utilisateur</h3>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Votre mail" required>
            <br>
            <input type="password" name="mdp" placeholder="Votre mot de passe" required>
            <br><br>
            <input type="checkbox" name="souvenir_de_moi" placeholder="Se souvenir de moi" required>

            <input type="submit" name="envoie" value="Se connecter" class="submit">
        </form>
    </div>
</body>
</html>