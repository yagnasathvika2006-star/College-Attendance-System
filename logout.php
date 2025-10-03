<?php
session_start();
session_destroy();
setcookie("teacher_id","",time()-3600,"/"); // delete cookie
header("Location: index.php");
exit;
?>
