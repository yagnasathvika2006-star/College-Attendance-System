<?php
session_start();
require 'db.php';

// Auto-login via cookie
if(isset($_COOKIE['teacher_id']) && !isset($_SESSION['teacher'])){
    $_SESSION['teacher'] = $_COOKIE['teacher_id'];
    header("Location: dashboard.php");
    exit;
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    $stmt = $conn->prepare("SELECT * FROM teachers WHERE username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if($result && password_verify($password,$result['password'])){
        $_SESSION['teacher'] = $result['id'];
        if($remember){
            setcookie("teacher_id",$result['id'],time()+(86400*30),"/"); // 30 days
        }
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid Credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Teacher Login</title>
</head>
<body>
<div class="container">
<h2>Teacher Login</h2>
<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<label><input type="checkbox" name="remember"> Remember Me</label>
<button type="submit" name="login">Login</button>
</form>
<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
<p>Don't have an account? <a href="register.php">Register here</a></p>
</div>
</body>
</html>
