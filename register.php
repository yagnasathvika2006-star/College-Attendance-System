<?php
require 'db.php';
session_start();

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if($password !== $confirm){
        $error = "Passwords do not match!";
    } else {
        $stmt = $conn->prepare("SELECT * FROM teachers WHERE username=?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows>0){
            $error = "Username already exists!";
        } else {
            $hashed = password_hash($password,PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO teachers(username,password) VALUES(?,?)");
            $stmt->bind_param("ss",$username,$hashed);
            if($stmt->execute()){
                $success = "Account created successfully. <a href='index.php'>Login Here</a>";
            } else {
                $error = "Error creating account!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Teacher Registration</title>
</head>
<body>
<div class="container">
<h2>Register Teacher Account</h2>
<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<input type="password" name="confirm" placeholder="Confirm Password" required>
<button type="submit" name="register">Register</button>
</form>
<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
<?php if(isset($success)) echo "<p style='color:green'>$success</p>"; ?>
<p>Already have an account? <a href="index.php">Login</a></p>
</div>
</body>
</html>
