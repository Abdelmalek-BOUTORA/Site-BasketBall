<?php

session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}

require_once "connexion.php";

if (!isset($_GET["id"])) {
    header("Location: calendrier_entrainements.php");
    exit;
}

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = $_POST["date"];
    $heure = $_POST["heure"];
    $equipes = $_POST["equipes"];

    $sql = "UPDATE calendrier_entrainements
            SET date = ?, heure = ?, equipes = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssi",
        $date,
        $heure,
        $equipes,
        $id
    );

    if ($stmt->execute()) {

        $stmt->close();

        header("Location: calendrier_entrainements.php");
        exit;

    } else {

        echo "Erreur lors de la modification.";

    }

    $stmt->close();
}

$sql = "SELECT * FROM calendrier_entrainements WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$resultat = $stmt->get_result();

$entrainement = $resultat->fetch_assoc();

$stmt->close();

if (!$entrainement) {
    header("Location: calendrier_entrainements.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Modifier un entraînement</title>

</head>

<body>

    <h1>Modifier l'entraînement</h1>

    <p>
        <a href="calendrier_entrainements.php">
            ← Retour aux entraînements
        </a>
    </p>

    <form method="POST">

        <label>Date :</label>

        <input
            type="date"
            name="date"
            value="<?= htmlspecialchars($entrainement["date"]) ?>"
            required
        >

        <br><br>

        <label>Heure :</label>

        <input
            type="time"
            name="heure"
            value="<?= htmlspecialchars($entrainement["heure"]) ?>"
            required
        >

        <br><br>

        <label>Équipe :</label>

        <input
            type="text"
            name="equipes"
            value="<?= htmlspecialchars($entrainement["equipes"]) ?>"
            required
        >

        <br><br>

        <button type="submit">
            Enregistrer les modifications
        </button>

    </form>

</body>

</html>