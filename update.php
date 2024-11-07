<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';
$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username= $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', username='$username', email='$email', address='$address'";
    
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql .= ", password='$password_hash'";
    }

    $sql .= " WHERE username='$username'";

    if ($conn->query($sql) === TRUE) {
        header("Location: profile.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
