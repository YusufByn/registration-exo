<?php 
// demarre la session
session_start();

// condition pour veirifier si dans la session de l'utilisateur se trouve les infos qui nous montre qu'il est co
if (!isset($_SESSION['loggin']) || $_SESSION['loggin'] !== true ) {
    // si il est co je le redirige grace a location qui dans le header de ma request
    header('location: login.php');
    // je lui dis du coup d'arreter le code ici fin de s'executer
    exit();
}

// condition qui me permet de verifier si en get j'ai une key logout ET si cette key contient la value 1
if(isset($_GET["logout"]) && $_GET["logout"] === "1") {
    $_SESSION = [];
    session_destroy();

    // supprime les cookies

    // si il est deco on le renvoie sur la page de login 
    header("location: login.php");
    // je lui dis d'arreter d'executer le code
    exit();
}


$user_id = $_SESSION['user_id'] ?? 'inconnu';
$formName = $_SESSION['name'] ?? 'non renseigné';
$formLastName = $_SESSION['lastname'] ?? 'non renseigné';
$userEmail = $_SESSION['email'] ?? "pas d'email";


?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    <header>
        <h1>Bienvenue !</h1>
        <nav>
            <ul>
                <li>
                    <a href="home.php">Lien vers notre home page</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="">Lien vers une page</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="">Lien vers une page</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="home.php?logout=1">Deconnexion</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <span><?= "welcome $formName sur mon site. Vous êtes co avec l'adresse mail $userEmail"; ?></span>
    </main>
</body>
</html>