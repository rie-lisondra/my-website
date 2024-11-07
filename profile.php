<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';
$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if(isset($_GET['success']) && $_GET['success'] == 1){
    echo "<script>alert('Updated Successfully')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="hero">
        <nav>
            <img src="logo.png" class="logo" alt="Logo">
            <ul>
                <li><a href="home.php">HOME</a></li>
                <li><a href="profile.php">PROFILE</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
            </ul>
        </nav>
        <div class="profile-header">
            <div class="profile-pic">
                <?php if (!empty($user['avatar'])): ?>
                    <img src="<?php echo $user['avatar']; ?>" alt="Avatar">
                <?php else: ?>
                    <i class="fas fa-user-alt"></i>
                <?php endif; ?>
            </div>
            <div class="buttons">
                <div class="group-button">
                <form action="upload_avatar.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="avatar" accept="image/*" required>
                    <button type="submit" class="btn update-pic">Update new picture</button>
                </form>
                </div>
                <div class="group-button">
                <form action="remove_avatar.php" method="post">
                    <button type="submit" class="btn remove-pic">Remove</button>
                </form>
                </div>
            </div>
        </div>
        <div class="profile-container">
            <form class="edit-form" action="update.php" method="post">
                <h1>Edit Profile</h1>
                <div class="form-row">
                    <div class="form-group">
                        <label for="first-name">First Name *</label>
                        <input type="text" id="first-name" name="first_name" value="<?php echo $user['first_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name *</label>
                        <input type="text" id="last-name" name="last_name" value="<?php echo $user['last_name']; ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="username">Username *</label>
                        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="address">Address *</label>
                        <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password">
                    </div>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn update-btn">Update</button>
                    <button type="submit" class="btn delete-btn" name="delete" form="delete-form">Delete Account</button>
                </div>
            </form>
            <form id="delete-form" action="delete.php" method="post"></form>
        </div>
    </div>
</body>
</html>
