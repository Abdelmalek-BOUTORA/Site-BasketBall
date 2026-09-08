<?php
session_start();
if (!isset($_SESSION["admin"])) {
header("Location: admin.php");
exit;
}
require_once "connexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$categorie = $_POST["categorie"];
$date = $_POST["date"];
$heure = $_POST["heure"];
$localisation = $_POST["localisation"];
$logo_adverse = $_POST["logo_adverse"];
$nom_adverse = $_POST["nom_adverse"];
$sql = "INSERT INTO calendrier_matchs
 (categorie, date, heure, localisation, logo_adverse, nom_adverse)
 VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(
"ssssss",
$categorie,
$date,
$heure,
$localisation,
$logo_adverse,
$nom_adverse
);
if ($stmt->execute()) {
echo "Match ajouté avec succès !";
} else {
echo "Erreur lors de l'ajout.";
}
$stmt->close();
}
$resultat = $conn->query(
"SELECT * FROM calendrier_matchs ORDER BY date, heure"
);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
 <meta charset="UTF-8">
 <title>Calendrier - Matchs</title>
</head>
<body>
 <h1>Matchs du calendrier complet</h1>
 <p>
 <a href="dashboard.php">← Retour au tableau de bord</a>
 </p>
 <h2>Ajouter un match</h2>
 <form method="POST">
 <label>Catégorie :</label>
 <input type="text" name="categorie" required>
 <br><br>
 <label>Date :</label>
 <input type="date" name="date" required>
 <br><br>
 <label>Heure :</label>
 <input type="time" name="heure" required>
 <br><br>
 <label>Localisation :</label>
 <input type="text" name="localisation" required>
 <br><br>
 <label>Nom de l'équipe adverse :</label>
 <input type="text" name="nom_adverse" required>
 <br><br>
 <label>Logo adverse :</label>
 <input type="text" name="logo_adverse">
 <br><br>
 <button type="submit">Ajouter le match</button>
 </form>
 <hr>
 <h2>Matchs existants</h2>
<?php while ($match = $resultat->fetch_assoc()): ?>
 <div>
 <p>
 <strong>Catégorie :</strong>
<?= htmlspecialchars($match["categorie"]) ?>
 </p>
 <p>
 <strong>Date :</strong>
<?= htmlspecialchars($match["date"]) ?>
 </p>
 <p>
 <strong>Heure :</strong>
<?= htmlspecialchars($match["heure"]) ?>
 </p>
 <p>
 <strong>Localisation :</strong>
<?= htmlspecialchars($match["localisation"]) ?>
 </p>
 <p>
 <strong>Équipe adverse :</strong>
<?= htmlspecialchars($match["nom_adverse"]) ?>
 </p>
 <p>
 <strong>Logo adverse :</strong>
<?= htmlspecialchars($match["logo_adverse"]) ?>
 </p>
 <a href="modifier_calendrier_match.php?id=<?= $match["id"] ?>">
 Modifier
 </a>
 <a href="supprimer_calendrier_match.php?id=<?= $match["id"] ?>"
   onclick="return confirm('Voulez-vous vraiment supprimer ce match ?')">
    Supprimer
</a>
 <hr>
 </div>
 <?php endwhile; ?>
</body>
</html>
