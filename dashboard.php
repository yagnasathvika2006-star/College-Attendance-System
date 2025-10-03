<?php
session_start();
if(!isset($_SESSION['teacher'])){
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Dashboard</title>
</head>
<body>
<div class="container">
<h2>Teacher Dashboard</h2>
<div style="display:flex; justify-content: space-around; margin-top:30px; flex-wrap:wrap;">
    <a href="add_student.php"><button>Add Student</button></a>
    <a href="mark_attendance.php"><button>Mark Attendance</button></a>
    <a href="view_attendance.php"><button>View Attendance</button></a>
    <a href="logout.php"><button>Logout</button></a>
</div>
</div>
</body>
</html>
