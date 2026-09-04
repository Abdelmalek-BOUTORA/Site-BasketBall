<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
</head>

<body>

<h1>Tableau de bord administrateur</h1>

<p>Bienvenue <?= htmlspecialchars($_SESSION["admin"]) ?> !</p>

<hr>

<h2>Gestion du club</h2>

<p>
    <a href="liste_inscriptions.php">
        Gérer les inscriptions
    </a>
</p>

<p>
    <a href="news.php">
        Gérer les actualités
    </a>
</p>

<p>
    <a href="entrainements.php">
        Gérer les entraînements
    </a>
</p>

<p>
    <a href="matchs.php">
        Gérer les matchs
    </a>
</p>

<hr>

<a href="deconnexion.php">
    Se déconnecter
</a>

</body>

</html>