
<?php
require '../config/database.php';
include_once '../includes/header.php';

$message="";
$errors=[];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $photo_profil = $_POST['photo_profil'];


    if(empty($email)){
        $errors['email']="l'email est obligatoire";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email']="l'email est invalide";
    }

    if(empty($mot_de_passe)){
        $errors['mot_de_passe']='le mot de passe est obligatoire';
    }elseif(strlen($mot_de_passe) < 8){
        $errors['mot_de_passe']='le mot de passe est trop court';
    }

    if(empty($nom)){
        $errors['nom']="le nom est obligatoire";
    }

    if(empty($prenom)){
        $errors['prenom']='le prénom est obligatoire';
    }


    if(empty($photo_profil)){
        $errors['photo_profil']='la photo de profile est obligatoire est obligatoire';
    }

    if (empty($errors)) {
        $message="Inscription validée";
        $sql="INSERT INTO utilisateur(email, mot_de_passe, nom, prenom, photo_profil, Role)
        VALUES (:email, :mot_de_passe, :nom, :prenom, :photo_profil, :Role)";
        $hash_mot_de_passe= password_hash($mot_de_passe,PASSWORD_DEFAULT);
        $stmt = $bdd->prepare($sql);
        $role = "user";
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':mot_de_passe',$hash_mot_de_passe,PDO::PARAM_STR);
        $stmt->bindParam(':nom',$nom,PDO::PARAM_STR);
        $stmt->bindParam(':prenom',$prenom,PDO::PARAM_STR);
        $stmt->bindParam(':photo_profil',$photo_profil,PDO::PARAM_STR);
        $stmt->bindParam(':Role',$role,PDO::PARAM_STR);
        if ($stmt->execute()){
            header("location:login.php");
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/CSS/register.css">
    <title>Document</title>
</head>
<body>
<h1>Inscrivez vous</h1>
<div class="container">
    <form action="" method="post">
        <input type="text" name="email" placeholder="email" value=<?php echo $email ?? ''?>>
        <small class="error-message">
            <?php echo $errors['email'] ?? '';?>
        </small>
        <br>
        <input type="text" name="mot_de_passe" placeholder="mot de passe" value=<?php echo $mot_de_passe ?? ''?>>
        <small class="error-message">
            <?php echo $errors['mot_de_passe'] ?? '';?>
        </small>
        <br>
        <input type="text" name="nom" placeholder="nom" value=<?php echo $nom ??''?>>
        <small class="error-message">
            <?php echo $errors['nom'] ?? '';?>
        </small>
        <br>
        <input type="text" name="prenom" placeholder="prenom" value=<?php echo $prenom ?? ''?>>
        <small class="error-message">
            <?php echo $errors['prenom'] ??'';?>
        </small>
        <br>
        <input type="file" name="photo_profil" placeholder="photo de profil">
        <small class="error-message">
            <?php echo $errors['photo_profil'] ?? '';?>
        </small>
        <br>
        <button type="submit">Inscription</button>
        <small class="validation">
            <?php echo $message ?? ''; ?>
        </small>
    </form>
</div>
</body>
</html>