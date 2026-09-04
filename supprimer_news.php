<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}

require_once "connexion.php";

$id = $_GET["id"];

$sql = "DELETE FROM news WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: news.php");
    exit;
}

echo "Erreur lors de la suppression.";

$stmt->close();
?>