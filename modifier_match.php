<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}

require_once "connexion.php";

$id = $_GET["id"];

$sql = "SELECT * FROM matchs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$resultat = $stmt->get_result();
$match = $resultat->fetch_assoc();

$stmt->close();

if (!$match) {
    die("Match introuvable.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $categorie = $_POST["categorie"];
    $date = $_POST["date"];
    $heure = $_POST["heure"];
    $localisation = $_POST["localisation"];
    $logo_adverse = $_POST["logo_adverse"];
    $nom_adverse = $_POST["nom_adverse"];

    $sql = "UPDATE matchs
            SET categorie = ?, date = ?, heure = ?, localisation = ?,
                logo_adverse = ?, nom_adverse = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssssi",
        $categorie,
        $date,
        $heure,
        $localisation,
        $logo_adverse,
        $nom_adverse,
        $id
    );

    if ($stmt->execute()) {
        header("Location: matchs.php");
        exit;
    }

    echo "Erreur lors de la modification.";

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un match</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<h1>Modifier le match</h1>

<form method="POST">

    <label>Catégorie :</label>
    <input type="text"
           name="categorie"
           value="<?= htmlspecialchars($match["categorie"]) ?>"
           required>

    <br><br>

    <label>Date :</label>
    <input type="date"
           name="date"
           value="<?= htmlspecialchars($match["date"]) ?>"
           required>

    <br><br>

    <label>Heure :</label>
    <input type="time"
           name="heure"
           value="<?= htmlspecialchars($match["heure"]) ?>"
           required>

    <br><br>

    <label>Localisation :</label>
    <input type="text"
           name="localisation"
           value="<?= htmlspecialchars($match["localisation"]) ?>"
           required>

    <br><br>

    <label>Logo adverse :</label>
    <input type="text"
           name="logo_adverse"
           value="<?= htmlspecialchars($match["logo_adverse"]) ?>"
           required>

    <br><br>

    <label>Nom adverse :</label>
    <input type="text"
           name="nom_adverse"
           value="<?= htmlspecialchars($match["nom_adverse"]) ?>"
           required>

    <br><br>

    <button type="submit">Enregistrer les modifications</button>

</form>

<br>

<a href="matchs.php">Retour aux matchs</a>

</body>

</html>