<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';
$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "UPDATE users SET avatar=NULL WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
        header("Location: profile.php");
    } else {
        echo "Error removing avatar: " . $conn->error;
    }
    $conn->close();
}
?>
