<?php

// logique de connexion à la database

// information pour se connecter
// l'endroit ou est ma database
$host = "localhost";
// nom de la db
$dbname = "user";
// identifiant de connexion
$username = "root";
// mdp de connexion
$password = "";
// port
$port = 3306;
// encodage
$charset = "utf8mb4";

// function qui crée et renvoi une connexion a la db
function dbConnexion() {
    // transforme mes variable en global (accessible partout)
    global $host, $dbname, $username, $password, $port, $charset;

    try {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port";
        $pdo = new PDO($dsn, $username, $password);
        // comment recuperer les exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // comment me renvoyer les données
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;

    } catch (PDOExecption $e) {
        die("Erreur durant la connexion à la dataBase" . $e->getMessage());
    }
}

?>