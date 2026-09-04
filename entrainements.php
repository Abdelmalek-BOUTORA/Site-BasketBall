<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}

require_once "connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = $_POST["date"];
    $heure = $_POST["heure"];
    $equipes = $_POST["equipes"];

    $sql = "INSERT INTO entrainements (date, heure, equipes)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $date, $heure, $equipes);

    if ($stmt->execute()) {
        echo "Entraînement ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout.";
    }

    $stmt->close();
}

$resultat = $conn->query("SELECT * FROM entrainements ORDER BY date, heure");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des entraînements</title>
</head>

<body>

<h1>Gestion des entraînements</h1>
<p><a href="dashboard.php">← Retour au tableau de bord</a></p>
<h2>Ajouter un entraînement</h2>

<form method="POST">

    <label>Date :</label>
    <input type="date" name="date" required>

    <br><br>

    <label>Heure :</label>
    <input type="time" name="heure" required>

    <br><br>

    <label>Équipe :</label>
    <input type="text" name="equipes" required>

    <br><br>

    <button type="submit">Ajouter l'entraînement</button>

</form>

<hr>

<h2>Entraînements existants</h2>

<?php while ($entrainement = $resultat->fetch_assoc()) { ?>

    <div>

        <p>
            <strong>Date :</strong>
            <?= htmlspecialchars($entrainement["date"]) ?>
        </p>

        <p>
            <strong>Heure :</strong>
            <?= htmlspecialchars($entrainement["heure"]) ?>
        </p>

        <p>
            <strong>Équipe :</strong>
            <?= htmlspecialchars($entrainement["equipes"]) ?>
        </p>

        <a href="modifier_entrainement.php?id=<?= $entrainement["id"] ?>">
            Modifier
        </a>

        |

        <a href="supprimer_entrainement.php?id=<?= $entrainement["id"] ?>"
           onclick="return confirm('Voulez-vous vraiment supprimer cet entraînement ?');">
            Supprimer
        </a>

        <hr>

    </div>

<?php } ?>

</body>

</html>