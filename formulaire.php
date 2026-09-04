<?php
require_once "connexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $date_de_naissance = $_POST["date_de_naissance"];
    $telephone = $_POST["telephone"];
    $certificat = $_FILES["certificat_medical"];
    $nom_fichier = basename($certificat["name"]);
    $chemin = "uploads/" . $nom_fichier;
    move_uploaded_file($certificat["tmp_name"], $chemin);
    $sql = "INSERT INTO formulaire 
            (nom, prenom, date_de_naissance, telephone, certificat_medical)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssss",
        $nom,
        $prenom,
        $date_de_naissance,
        $telephone,
        $chemin
    );
    if ($stmt->execute()) {
        echo "Inscription envoyée avec succès !";
    } else {
        echo "Erreur lors de l'inscription.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rejoindre le club</title>
</head>
<body>
<h1>Rejoindre le club</h1>
<form method="POST" enctype="multipart/form-data">
    <label>Nom :</label>
    <input type="text" name="nom" required>
    <br><br>
    <label>Prénom :</label>
    <input type="text" name="prenom" required>
    <br><br>
    <label>Date de naissance :</label>
    <input type="date" name="date_de_naissance" required>
    <br><br>
    <label>Téléphone :</label>
    <input type="tel" name="telephone" required>
    <br><br>
    <label>Certificat médical :</label>
    <input type="file" name="certificat_medical" accept=".pdf,.jpg,.jpeg" required>
    <br><br>
    <button type="submit">Envoyer l'inscription</button>
</form>
</body>
</html>