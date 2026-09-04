<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}

require_once "connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $date = $_POST["date"];

    $image = $_FILES["image_news"];
    $nom_fichier = basename($image["name"]);
    $chemin = "uploads/" . $nom_fichier;

    move_uploaded_file($image["tmp_name"], $chemin);

    $sql = "INSERT INTO news (image_news, titre, description, date)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $chemin, $titre, $description, $date);

    if ($stmt->execute()) {
        echo "Actualité ajoutée avec succès !";
    } else {
        echo "Erreur lors de l'ajout.";
    }

    $stmt->close();
}

$resultat = $conn->query("SELECT * FROM news ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des actualités</title>
</head>

<body>

<h1>Gestion des actualités</h1>
<p><a href="dashboard.php">← Retour au tableau de bord</a></p>
<h2>Ajouter une actualité</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Image :</label>
    <input type="file" name="image_news" accept=".jpg,.jpeg,.png" required>

    <br><br>

    <label>Titre :</label>
    <input type="text" name="titre" required>

    <br><br>

    <label>Description :</label>
    <textarea name="description" required></textarea>

    <br><br>

    <label>Date :</label>
    <input type="date" name="date" required>

    <br><br>

    <button type="submit">Ajouter l'actualité</button>

</form>

<hr>

<h2>Actualités existantes</h2>

<?php while ($news = $resultat->fetch_assoc()) { ?>

    <div>

        <img src="<?= htmlspecialchars($news["image_news"]) ?>" width="200">

        <h3><?= htmlspecialchars($news["titre"]) ?></h3>

        <p><?= htmlspecialchars($news["description"]) ?></p>

        <p><?= htmlspecialchars($news["date"]) ?></p>

        <a href="modifier_news.php?id=<?= $news["id"] ?>">
            Modifier
        </a>

        |

        <a href="supprimer_news.php?id=<?= $news["id"] ?>"
           onclick="return confirm('Voulez-vous vraiment supprimer cette actualité ?');">
            Supprimer
        </a>

        <hr>

    </div>

<?php } ?>

</body>

</html>