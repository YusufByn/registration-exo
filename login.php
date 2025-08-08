<?php

require_once "config/database.php";

session_start();
// créer un tableau vide errors au dessus du if psk ca fait une request POST, si ca arrive depuis le get il va pas capter
$errors = [];
$message = "";

// condition pour vérifier si on a recu une request en post (formulaire)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $loginEmail = htmlspecialchars(trim($_POST["email"] ?? ""));
    $loginPassword = trim(($_POST["password"] ?? ""));



    // validation du mail
if (empty($loginEmail)) {
        $errors[] = "l'email est obligatoire";
        // si le mail n'est pas indiqué donc vide tu dis ca
    }elseif (!filter_var($loginEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "votre adresse ne correspond au mail !";
        // ! psk > si la variable mail n'est pas filtré, alors tu dis ca
    }

    // validation du mot de passe
if (empty($loginPassword)) {
        $errors[] = "le mot de passe est obligatoire";
    }elseif (strlen($loginPassword) < 3) {
        $errors[] = "le mot de passe doit contenir au moins 3 caractères !";
        // si mdp est inférieur à 3 caract tu dis ca
    }

if (empty($errors)) {
    try {
        //appel de la fonction de connexion de la db
        $pdo = dbConnexion();

        //chercher l'utilisateur par son mail ainsi que son mdp, je peux pas faire email = variable psk niveau secu c nul
        // je veux faire une requête avec un paramètre (le ?) mais je ne donne pas encore la valeur
        $userEmailPassword = $pdo->prepare("SELECT * FROM users WHERE email = ?");

        // Exécute cette requête, et remplace le ? par ce que contient la variable login
        // en gros je vérifie l'email
        $userEmailPassword->execute([$loginEmail]);

        $user = $userEmailPassword->fetch(); 
        // ici tu récupères les infos utilisateur
    

    if ($user) {
                //verification
                    if (password_verify($loginPassword, $user["password"])) {
                        $_SESSION["user_id"] = $user['id'];
                        $_SESSION["name"] = $user["name"];
                        $_SESSION["lastname"] = $user["lastname"];
                        $_SESSION["email"] = $user["email"];
                        $_SESSION['loggin'] = true;

                        $message = "super vous etes connecté " . htmlspecialchars($user['name']);
                        header('location: home.php');
                        exit();
                    }else{
                        $errors[] = "mot de passe pas bon ma gueule";
                    }     
                }else{
                    $errors[] = "compte introuvable ma gueule";
                }  
            } catch (PDOException $e) {
                $errors[] = "nous avons des problemes ma gueule: " . $e->getMessage();
            }
        }
}
        
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>Login page</h1>
    </header>
    <main>
        <section class="formContainer">
            <form method="POST" action="">
                <label for="email">Email :</label>
                <input type="email" name="email" placeholder="Entrez votre mail">

                <label for="password">Mot de passe :</label>
                <input type="password" name="password" placeholder="Entrez votre mot de passe">

                <input type="submit" value="Se connecter">

                <a href=registration.php>Retourner sur la page d'enregistrement</a>
            </form>
        </section>
    </main>
    <footer>
        <h2>MERCI</h2>
    </footer>
</body>
</html>