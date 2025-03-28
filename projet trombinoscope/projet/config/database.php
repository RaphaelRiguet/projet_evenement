<?php
$conn = new mysqli('localhost', 'root', '', 'evenement');

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['Email'];
    $classe = $_POST['rôle'];
    $password = $_POST['mot_de_passe'];

    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE email = ? AND rôle = ? AND mot_de_passe = ?");
    $stmt->bind_param("sssss", $email, $rôle, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Connexion réussie ! Bienvenue.";
    } else {
        echo "Toutes les informations sont nécessaires et doivent être correctes.";
    }
    $stmt->close();
}

$conn->close();
?>