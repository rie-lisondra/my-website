<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, username, email, password) VALUES ('$first_name', '$last_name', '$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="hero">
    <nav>
        <img src="logo.png" class="logo">
        <ul>
            <li><a href="signup.php">SIGNUP</a></li>
            <li><a href="login.php">LOGIN</a></li>
            <li><a href="#">ABOUT</a></li>
        </ul>
    </nav>
        <div class="container">
            <div class="detail">
                <h1>Welcome!</h1>
                <p>This website is a basic CRUD that enables you to create user
                    <br> by signing up, log in, edit or update profile, and delete the account.
                </p>
                <a href="#">Signup to the right</a>
            </div>
            <div class="wrapper">
                <div class="form-box-signup">
                    <h2>Signup</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="input-box">
                            <span class="icon"></span>
                            <input type="text" name="first_name" required>
                            <label>First Name</label>
                        </div>
                        <div class="input-box">
                            <span class="icon"></span>
                            <input type="text" name="last_name" required>
                            <label>Last Name</label>
                        </div>
                        <div class="input-box">
                            <span class="icon"></span>
                            <input type="text" name="username" required>
                            <label>Username</label>
                        </div>
                        <div class="input-box">
                            <span class="icon"></span>
                            <input type="email" name="email" required>
                            <label>Email</label>
                        </div>
                        <div class="input-box">
                            <span class="icon"></span>
                            <input type="password" name="password" required>
                            <label>Password</label>
                        </div>
                        <button type="submit" class="btn">Signup</button>
                        <div class="login-register">
                            <p>Already have an account? <a href="login.php" class="login-link">Login here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

