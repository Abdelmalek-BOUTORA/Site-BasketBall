<?php
$conn = new mysqli("localhost", "root", "", "cba_basketball");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
echo "connexion reussie !";
?>