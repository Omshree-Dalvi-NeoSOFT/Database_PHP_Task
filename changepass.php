<?php 
error_reporting(0);
// get email and user
$id=$_SESSION['sid'];

include("connection.php");
$fe=mysqli_query($conn,"SELECT * FROM users WHERE id=$id;");
$arr=mysqli_fetch_assoc($fe);
$password=$arr['password'];

$oldpass=$_POST['oldpass'];
$newpass=$_POST['newpass'];
$cnewpass=$_POST['cnewpass'];


if(isset($_POST['sub'])){
    $pass=substr(sha1($oldpass),0,10); // encode password
    if($pass == $password){
        // password validation
        if(preg_match("/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/",$newpass)){
            // check wether new password is provided.
            if($newpass != $oldpass){
                if($newpass==$cnewpass){
                    $errcnewpass=$errpass=$errnewpass= "is-valid";
                    $npass=substr(sha1($newpass),0,10);
                    if(mysqli_query($conn,"UPDATE users SET password='$npass' WHERE id=$id")){
                        setcookie("password","",time()+3600*24);
                        $status='<div class="alert alert-success" role="alert">
                        Password Changed Successfully ! 
                        </div>';
                    }
                    else{
                        $status = '<div class="alert alert-danger" role="alert"> Error to update password....</div>';
                    }
                }
                else{
                    $errcnewpass="is-invalid";
                }
            }
            else{
                $errcnewpass= $errpass=$errnewpass="is-invalid";
                $status='<div class="alert alert-danger" role="alert">
                Old password and new password cannot be same  ! 
                </div>';
            }
        }
        else{
            $errnewpass = "is-invalid";
        }
    }
    else{
        $errpass="is-invalid";
    }   
}
?>

<div class="row">
    <section class="col-md-10 mt-5">
        <form  method="post" enctype="multipart/form-data">
            <section class="mt-4"></section>
             
            <div class="col-md-12">
            <section class="text-danger"><?php echo $status?></section>
                <!-- password -->
                <label for="validationServer02" class="form-label">Current Password</label>
                <input type="password" class="form-control <?php echo $errpass; ?>" id="validationServer02" name="oldpass" >
                
                <!-- error msg -->
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Invalid Password ! 
                    enter correct password !.
                </div>
            </div>
            <div class="col-md-12">

                <!-- password -->
                <label for="validationServer02" class="form-label">New Password</label>
                <input type="password" class="form-control <?php echo $errnewpass; ?>" id="validationServer02" name="newpass" >
                
                <!-- error msg -->
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Invalid Password ! 
                    use min 8 letter password, with at least a symbol, upper and lower case letters and a number
                </div>
            </div>

        <div class="col-md-12">

            <!-- confirm password -->
            <label for="validationServer02" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control <?php echo $errcnewpass; ?>" id="validationServer02" name="cnewpass" >
            
                <!-- error msg -->
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter correct password !
                </div>
            </div>
            <br>
            <button class="btn btn-success p-2" type="submit" name="sub">Change</button>
            <button class="btn btn-danger p-2" type="reset"> Clear </button>
        </form>
    </section>
</div>

