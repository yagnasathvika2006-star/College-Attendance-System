<?php
session_start();
require 'db.php';
if(!isset($_SESSION['teacher'])){
    header("Location: index.php");
    exit;
}

$attendance = $conn->query("
SELECT a.date, s.roll_no, s.name, a.status 
FROM attendance a 
JOIN students s ON a.student_id = s.id
ORDER BY a.date DESC, s.roll_no
");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>View Attendance</title>
</head>
<body>
<div class="container">
<h2>View Attendance</h2>
<table>
<tr><th>Date</th><th>Roll No</th><th>Name</th><th>Status</th></tr>
<?php while($row=$attendance->fetch_assoc()): ?>
<tr>
<td><?php echo $row['date']; ?></td>
<td><?php echo $row['roll_no']; ?></td>
<td><?php echo $row['name']; ?></td>
<td>
<span class="status-<?php echo strtolower($row['status']); ?>">
<?php echo $row['status']; ?>
</span>
</td>
</tr>
<?php endwhile; ?>
</table>
<p><a href="dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>
