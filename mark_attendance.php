<?php
session_start();
require 'db.php';
if(!isset($_SESSION['teacher'])){
    header("Location: index.php");
    exit;
}

$students = $conn->query("SELECT * FROM students");

if(isset($_POST['submit'])){
    $date = date("Y-m-d");
    foreach($_POST['attendance'] as $student_id => $status){
        $check = $conn->query("SELECT * FROM attendance WHERE student_id=$student_id AND date='$date'");
        if($check->num_rows == 0){
            $stmt = $conn->prepare("INSERT INTO attendance(student_id,date,status) VALUES(?,?,?)");
            $stmt->bind_param("iss",$student_id,$date,$status);
            $stmt->execute();
        }
    }
    $success = "Attendance marked for $date";
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Mark Attendance</title>
</head>
<body>
<div class="container">
<h2>Mark Attendance - <?php echo date("d-m-Y"); ?></h2>
<form method="POST">
<table>
<tr><th>Roll No</th><th>Name</th><th>Status</th></tr>
<?php while($row=$students->fetch_assoc()): ?>
<tr>
<td><?php echo $row['roll_no']; ?></td>
<td><?php echo $row['name']; ?></td>
<td>
<select name="attendance[<?php echo $row['id']; ?>]">
<option value="Present">Present</option>
<option value="Absent">Absent</option>
</select>
</td>
</tr>
<?php endwhile; ?>
</table>
<br>
<button type="submit" name="submit">Submit Attendance</button>
</form>
<?php if(isset($success)) echo "<p style='color:green'>$success</p>"; ?>
<p><a href="dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>
