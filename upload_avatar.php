<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';
$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['avatar'])) {
    $target_dir = "uploads/";
    
    // Ensure target directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);

    if ($check !== false) {
        // Try to move the uploaded file
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            $sql = "UPDATE users SET avatar='$target_file' WHERE username='$username'";
            if ($conn->query($sql) === TRUE) {
                header("Location: profile.php?success=1");
            } else {
                echo "Error updating avatar: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
} else {
    echo "No file was uploaded or invalid request.";
}
$conn->close();
?>
