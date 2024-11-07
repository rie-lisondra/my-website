<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            header("Location: profile.php");
            exit; // Ensure script stops executing after redirect
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with that email";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="hero">
    <nav>
        <img src="logo.png" class="logo">
        <ul>
            <li><a href="login.php">LOGIN</a></li>
            <li><a href="signup.php">SIGN UP</a></li>
            <li><a href="#">ABOUT</a></li>
        </ul>
    </nav>
        <div class="container">
            <div class="detail">
                <h1>Welcome!</h1>
                <p>This website is a basic CRUD that enables you to create user
                    <br> by signing up, log in, edit or update profile, and delete the account.
                </p>
                <a href="#">Login to the right</a>
            </div>
            <div class="wrapper">
                <div class="form-box login">
                    <h2>Login</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="input-box">
                            <input type="email" name="email" required>
                            <label>Email</label>
                        </div>
                        <div class="input-box">
                            <input type="password" name="password" required>
                            <label>Password</label>
                        </div>
                        <a href="home.php"><button type="submit" class="btn">Login</button></a>
                        <div class="login-register">
                            <p>Don't have an account? <a href="signup.php" class="signup-link">Sign up here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
