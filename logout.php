<!-- end session -->
<?php 
 session_start();
 session_destroy();
 include("connection.php");
 mysqli_close($conn);
 header("location:index.php");
?>