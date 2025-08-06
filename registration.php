<?php
// créer un tableau vide errors au dessus du if psk ca fait une request POST, si ca arrive depuis le get il va pas capter
$errors = [];

// condition pour vérifier si on a recu une request en post (formulaire)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formName = htmlspecialchars(trim($_POST["name"] ?? ""));
    $formLastName = htmlspecialchars(trim($_POST["lastname"] ?? ""));
    $formEmail = htmlspecialchars(trim($_POST["email"] ?? ""));
    $formPassword = htmlspecialchars(trim($_POST["password"] ?? ""));
    $formConfirmPassword = htmlspecialchars(trim($_POST["confirm_password"] ?? ""));

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

if (empty($formEmail)) {
        $errors[] = "l'email est obligatoire";
        // si le mail n'est pas indiqué donc vide tu dis ca
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "votre adresse ne correspond pas au format mail classique !";
        // ! psk > si la variable mail n'est pas filtré, alors tu dis ca
    }

if (empty($formPassword)) {
    $errors[] = "le mot de passe est obligatoire";
}
if (empty($formConfirmPassword)) {
    $errors[] = "la confirmation est obligatoire";
}


}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
            </form>
        </section>
        <section class="messagesContainer">
            <h3>Test</h3>
            <div>
            </div>
        </section>
    </main>
    <footer>
        <h2>End of Test</h2>
    </footer>
</body>
</html>