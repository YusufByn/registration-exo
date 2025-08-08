<?php

require_once "config/database.php";

// créer un tableau vide errors au dessus du if psk ca fait une request POST, si ca arrive depuis le get il va pas capter
$errors = [];
$message = "";

// condition pour vérifier si on a recu une request en post (formulaire)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formName = htmlspecialchars(trim($_POST["name"] ?? ""));
    $formLastName = htmlspecialchars(trim($_POST["lastname"] ?? ""));
    $formEmail = htmlspecialchars(trim($_POST["email"] ?? ""));
    $formPassword = trim($_POST["password"] ?? "");
    $formConfirmPassword = trim($_POST["confirm_password"] ?? "");

    // validation du prénom
if (empty($formName)) {
        $errors[] = "Le prénom est obligatoire.";
        // si le prénom est vide tu dis ca
    }elseif (strlen($formName) < 2) {
        $errors[] = "Le prénom doit avoir minimum 2 caractères !";
        // si le prénom fait moins de 2 carac tu dis ca
    }elseif (strlen($formName) > 255) {
        $errors[] = "Le prénom doit avoir maximum 255 caractères !";
        // si le prénom fait plus que 255 tu dis ca
    }

    // validation du nom
if (empty($formLastName)) {
        $errors[] = "le nom est obligatoire";
        // si nom est vide
    }elseif (strlen($formLastName) < 2) {
        $errors[] = "Le nom doit avoir minimum 2 caractères !";
        // si nom a moins de 2 caract tu dis ca
    }elseif (strlen($formLastName) > 255) {
        $errors[] = "Le nom doit avoir maximum 255 caractères !";
        // si nom a plus de 255 caract tu dis ca
    }

    // validation du mail
if (empty($formEmail)) {
        $errors[] = "l'email est obligatoire";
        // si le mail n'est pas indiqué donc vide tu dis ca
    }elseif (!filter_var($formEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "votre adresse ne correspond pas au format mail classique !";
        // ! psk > si la variable mail n'est pas filtré, alors tu dis ca
    }

    // validation du mot de passe
if (empty($formPassword)) {
        $errors[] = "le mot de passe est obligatoire";
    }elseif (strlen($formPassword) < 3) {
        $errors[] = "le mot de passe doit contenir au moins 3 caractères !";
        // si mdp est inférieur à 3 caract tu dis ca
    }elseif ($formPassword !== $formConfirmPassword) {
        $errors[] = "les mots de passe doivent être identiques !";
        // si mot de passe est strictement pas égal à confirm mdp, tu dis que ca doit etre identique!
    }

if (empty($errors)) {
    //logique de traitement en db
    $pdo = dbConnexion();

    //verifier si l'adresse mail est utilisé ou non
    $checkEmail = $pdo->prepare("SELECT id FROM users WHERE email = ?");

    // la méthode execute de mon objet pdo execute la request préparée
    $checkEmail->execute([$formEmail]);
     
    //une condition pour vérifier si je recupere quelque chose
    if ($checkEmail->rowCount() > 0) {
        $errors[] = "email déja utilisé";
        } else {
        //dans le cas ou tout va bien ! email pas utilisé

        //hashage du mdp
        $hashPassword = password_hash($formPassword, PASSWORD_DEFAULT);

        // insertion des données en db
        $insertUser = $pdo->prepare("INSERT INTO users (name, lastname, email, password) 
        VALUES (?, ?, ?, ?)");

        $insertUser->execute([$formName, $formLastName, $formEmail, $hashPassword]);

        $message = "$formName $formLastName vous êtes enregistré avec succès";
        }
    }
};
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Test</h1>
    </header>
    <main>
        <section class="formContainer">
            <form action="" method="POST">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter your name">

                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" id="lastname" placeholder="Enter your lastname">

                <label for="email">email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email, ex : yusuf@gmail.com">

                <label for="password">password</label>
                <input type="password" name="password" id="password" placeholder="Enter password">

                <label for="confirm_password">Confirm password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">

                <input type="submit" value="Submit">

                <a href=login.php>Déjà inscrit ?</a>
            </form>
        </section>
        <section class="messagesContainer">
            <div>
                <h3>Test</h3>
                <?php
                
                foreach ($errors as $error) {
                    echo $error;
                }
                if (!empty($message)) {
                    echo $message;
                }

                ?>
            </div>
        </section>
    </main>
    <footer>
        <h2>End of Test</h2>
    </footer>
</body>
</html>