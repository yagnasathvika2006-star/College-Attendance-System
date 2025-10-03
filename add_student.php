<?php
session_start();
require 'db.php';
if(!isset($_SESSION['teacher'])){
    header("Location: index.php");
    exit;
}

if(isset($_POST['add'])){
    $roll_no = $_POST['roll_no'];
    $name    = $_POST['name'];
    $class   = $_POST['class'];

    $check = $conn->query("SELECT * FROM students WHERE roll_no='$roll_no'");
    if($check->num_rows>0){
        $error = "Roll number already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO students(roll_no,name,class) VALUES(?,?,?)");
        $stmt->bind_param("sss",$roll_no,$name,$class);
        if($stmt->execute()){
            $success = "Student added successfully!";
        } else {
            $error = "Error adding student!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Add Student</title>
</head>
<body>
<div class="container">
<h2>Add Student</h2>
<form method="POST">
    <input type="text" name="roll_no" placeholder="Roll Number" required>
    <input type="text" name="name" placeholder="Student Name" required>
    <input type="text" name="class" placeholder="Class" required>
    <button type="submit" name="add">Add Student</button>
</form>

<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
<?php if(isset($success)) echo "<p style='color:green'>$success</p>"; ?>

<p><a href="dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>
