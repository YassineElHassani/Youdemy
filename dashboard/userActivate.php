<?php
require_once '../config/connection.php';

if(isset($_GET["id"])) {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("UPDATE users SET status = 'active' WHERE id = $_GET[id]");
    $stmt->execute();
}

header('Location: ./manageUsers.php');
?>