<!-- Connection to DB -->
<?php 
define("HOST","localhost");
define("USER","root");
define("PASS","");
define("DBNAME","myproject");
$conn = mysqli_connect(HOST,USER,PASS,DBNAME) or die("Connection Error");
?>