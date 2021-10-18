<?php 
error_reporting(0);
// session values to get email and user name
$id=$_SESSION['sid'];
include("connection.php");
// fetch query from database
$fe=mysqli_query($conn,"SELECT * FROM users WHERE id=$id;");
$arr=mysqli_fetch_assoc($fe);
$email=$arr['email'];
$uname=$arr['username'];
$name=$arr['ename'];
$age=$arr['age'];
$gender=$arr['gender'];
$create=$arr['created_at'];

?>
    <!-- Details in tabular formate -->
    <table class="table table-dark border table-hover">
        <tr>
            <th colspan="2">
                Your Details .. 
            </th>
        </tr>
        <tr>
            <th>Unique Id</th>
            <td>: <?php echo $id;?></td>
        </tr> 
        <tr>
            <th>Mail Id</th>
            <td>: <?php echo $email;?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td>: <?php echo $uname;?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td>: <?php echo $name;?></td>
        </tr>
        <tr>
            <th>Age</th>
            <td>: <?php echo $age;?></td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>: <?php echo $gender;?></td>
        </tr>
        <tr>
            <th>Id Created on</th>
            <td>: <?php echo $create;?></td>
        </tr>
    </table>