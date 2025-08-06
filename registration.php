<?php
// condition pour vérifier si on a recu une request en post (formulaire)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formName = htmlspecialchars(trim($_POST["name"] ?? ""));
    $formLastName = htmlspecialchars(trim($_POST["lastname"] ?? ""));
    $formeEmail = htmlspecialchars(trim($_POST["email"] ?? ""));
    $formPassword = htmlspecialchars(trim($_POST["password"] ?? ""));
    $formConfirmPassword = htmlspecialchars(trim($_POST["confirm_password"] ?? ""));
}

var_dump($_POST);
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
    </main>
    <footer>
        <h2>End of Test</h2>
    </footer>
</body>
</html>