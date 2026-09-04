<?php
session_start();
require_once "connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_utilisateur = $_POST["nom_utilisateur"];
    $mot_de_passe = $_POST["mot_de_passe"];

    $sql = "SELECT * FROM admin WHERE nom_utilisateur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nom_utilisateur);
    $stmt->execute();

    $resultat = $stmt->get_result();

    if ($resultat->num_rows == 1) {

        $admin = $resultat->fetch_assoc();

        if (password_verify($mot_de_passe, $admin["mot_de_passe"])) {

            $_SESSION["admin"] = $admin["nom_utilisateur"];

            header("Location: dashboard.php");
            exit;

        } else {
            echo "Mot de passe incorrect.";
        }

    } else {
        echo "Nom d'utilisateur incorrect.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
</head>

<body>

<h1>Connexion administrateur</h1>

<form method="POST">

    <label>Nom d'utilisateur :</label>
    <input type="text" name="nom_utilisateur" required>

    <br><br>

    <label>Mot de passe :</label>
    <input type="password" name="mot_de_passe" required>

    <br><br>

    <button type="submit">Se connecter</button>

</form>

</body>
</html>