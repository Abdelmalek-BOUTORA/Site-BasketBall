<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}

require_once "connexion.php";
require_once "connexion.php";

$resultat = $conn->query("SELECT * FROM formulaire");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscriptions</title>
</head>

<body>

<h1>Inscriptions reçues</h1>
<p><a href="dashboard.php">← Retour au tableau de bord</a></p>
<a href="deconnexion.php">Se déconnecter</a>
<?php while ($inscription = $resultat->fetch_assoc()) { ?>
    <div>
        <p><strong>Nom :</strong> <?= htmlspecialchars($inscription["nom"]) ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($inscription["prenom"]) ?></p>
        <p><strong>Date de naissance :</strong> <?= htmlspecialchars($inscription["date_de_naissance"]) ?></p>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($inscription["telephone"]) ?></p>
        <p><strong>Certificat :</strong>
            <a href="<?= htmlspecialchars($inscription["certificat_medical"]) ?>" target="_blank">
                Voir le certificat <br><br>
                <a href="supprimer.php?id=<?= $inscription["id"] ?>"
                onclick="return confirm('Voulez-vous vraiment supprimer cette inscription ?');">
                Supprimer
</a>
            </a>
        </p>
        <hr>
    </div>
<?php
}
?>
</body>
</html>