<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}

require_once "connexion.php";

$id = $_GET["id"];

$sql = "SELECT * FROM news WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$resultat = $stmt->get_result();
$news = $resultat->fetch_assoc();

$stmt->close();

if (!$news) {
    die("Actualité introuvable.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $date = $_POST["date"];

    if (!empty($_FILES["image_news"]["name"])) {

        $nom_fichier = basename($_FILES["image_news"]["name"]);
        $chemin = "uploads/" . $nom_fichier;

        move_uploaded_file($_FILES["image_news"]["tmp_name"], $chemin);

        $sql = "UPDATE news 
                SET image_news = ?, titre = ?, description = ?, date = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssi",
            $chemin,
            $titre,
            $description,
            $date,
            $id
        );

    } else {

        $sql = "UPDATE news 
                SET titre = ?, description = ?, date = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssi",
            $titre,
            $description,
            $date,
            $id
        );
    }

    if ($stmt->execute()) {
        header("Location: news.php");
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
    <title>Modifier une actualité</title>
</head>

<body>

<h1>Modifier l'actualité</h1>

<form method="POST" enctype="multipart/form-data">

    <label>Image :</label>
    <input type="file" name="image_news" accept=".jpg,.jpeg,.png">

    <br><br>

    <label>Titre :</label>
    <input type="text" name="titre"
           value="<?= htmlspecialchars($news["titre"]) ?>" required>

    <br><br>

    <label>Description :</label>
    <textarea name="description" required><?= htmlspecialchars($news["description"]) ?></textarea>

    <br><br>

    <label>Date :</label>
    <input type="date" name="date"
           value="<?= htmlspecialchars($news["date"]) ?>" required>

    <br><br>

    <button type="submit">Enregistrer les modifications</button>

</form>

<br>

<a href="news.php">Retour aux actualités</a>

</body>

</html>