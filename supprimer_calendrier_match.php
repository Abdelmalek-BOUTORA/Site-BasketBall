<?php
session_start();
if (!isset($_SESSION["admin"])) {
header("Location: admin.php");
exit;
}
require_once "connexion.php";
if (isset($_GET["id"])) {
$id = $_GET["id"];
$sql = "DELETE FROM calendrier_matchs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();
}
header("Location: calendrier_matchs.php");
exit;
?>
