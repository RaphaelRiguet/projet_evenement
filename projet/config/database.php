<?php
session_start();
// Connexion à la base de données MySQL avec PDO
$bdd = new PDO('mysql:host=localhost;dbname=evenement;charset=utf8;', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activation du mode erreur pour PDO

// Traitement du premier formulaire (connexion utilisateur)
if (isset($_POST['envoi'])) {
    // Vérifie si les champs pseudo et mot de passe ne sont pas vides
    if (!empty($_POST['pseudo']) AND !empty($_POST['mdp'])) {
        // Sécurise l'entrée du pseudo pour éviter les attaques XSS
        $pseudo = htmlspecialchars($_POST['pseudo']);
        // Récupère le mot de passe
        $mdp = $_POST['mdp'];

        // Prépare la requête pour récupérer l'utilisateur par pseudo
        $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE email = ?');
        $recupUser->execute(array($email));

        // Vérifie si l'utilisateur existe dans la base de données
        if ($recupUser->rowCount() > 0) {
            $user = $recupUser->fetch();
            // Vérification du mot de passe avec la fonction password_verify
            if (password_verify($mdp, $user['password'])) {
                // Si le mot de passe est correct, on initialise la session
                $_SESSION['pseudo'] = $pseudo;
                $username = $pseudo;
                $_SESSION['id'] = $user['id'];
                // Redirige vers la page d'accueil après la connexion
                header('Location: index.php');
                exit();
            } else {
                // Si le mot de passe est incorrect, affiche un message d'erreur avec le même style que pour l'admin
                echo "<p style='color:red; font-weight: bold;'>Votre mot de passe ou pseudo est incorrect</p>";
            }
        } else {
            // Si le pseudo n'existe pas dans la base de données, affiche un message d'erreur avec le même style que pour l'admin
            echo "<p style='color:red; font-weight: bold;'>Votre mot de passe ou pseudo est incorrect</p>";
        } 
    } else {
        // Si les champs ne sont pas remplis, affiche un message d'erreur avec le même style que pour l'admin
        echo "<p style='color:red; font-weight: bold;'>Veuillez compléter tous les champs...</p>";
    }
}
?>