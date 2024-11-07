<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';
$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM users WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
        session_destroy();
        header("Location: signup.php");
        echo "succesfully deleted";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
$conn->close();
?>
