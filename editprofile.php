<?php 

error_reporting(0);
// include database
include("connection.php");
// include captcha 
include("cap.php");

// Fetch data from database.
$id=$_SESSION['sid'];

$fe=mysqli_query($conn,"SELECT * FROM users WHERE id=$id;");
$arr=mysqli_fetch_assoc($fe);
$email1=$arr['email'];
$user1=$arr['username'];
$name1=$arr['ename'];
$age1=$arr['age'];
$gender1=$arr['gender'];
$imgpath=$arr['profileimg'];


if(isset($_POST['sub'])){
    $temp=$_FILES['att']['tmp_name'];//read tmp name
    $fn=$_FILES['att']['name'];//orginal name
    $email=$_POST['email'];
    $uname=$_POST['uname'];
    $name=$_POST['name'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];

   
    // check for empty
    if(!empty($temp) && !empty($email) && !empty($uname) && !empty($name) && !empty($age) && !empty($gender) && !empty($_POST['captcha'])){
        // check for email
        if(preg_match("/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i",$email)){
            // check for valid captcha
            if($_POST['captcha']==$_POST['captchasum']){
                // check for username
                if(preg_match("/^[a-zA-Z0-9\-\_]+$/",$uname)){
                    $ext=pathinfo($fn,PATHINFO_EXTENSION);
                    $fname="$uname.$ext";
                    // check for image extension
                    if($ext=="jpg" || $ext=="png" || $ext=="jpeg"){
                        $dest = "uploads/$fname";  
                        if(move_uploaded_file($temp,"uploads/$fname")){
                            mysqli_query($conn,"UPDATE users SET username='$uname',ename='$name',age=$age,gender='$gender',profileimg='$dest' WHERE id=$id;");
                            header("location:dashboard.php");
                        } 
                        else{
                            $status3="uploading error !";
                        }                               
                    }
                    else{
                        $errimage = "is-invalid";
                        $status3 = "only jpg/png file formate allowed !";
                    }
                }
                else{
                    $erruname = "is-invalid";
                }
            }
            else{
                $errcap = "is-invalid";
            }
        }
        else{
            $erremail = "is-invalid";
        }
    }
    else{
        $erremail=$erruname=$errpass=$errname=$errage=$errgender=$errimage=$errcap=$errcpass="is-invalid";
    }
}

?>
<section class="mt-4"></section>
    <!-- Profile form -->
<form method="post" enctype="multipart/form-data" class="row g-3">

    <div class="col-md-4">
    <!-- Email Id -->
    <label for="validationServer02" class="form-label">Email ID</label>
    <input type="email" class="form-control <?php echo $erremail; ?>" id="validationServer02" name="email" value="<?php echo $email1;?>" readonly>
    
    <!-- error msg -->
    <div class="valid-feedback">
        Looks good!
    </div>
    <div class="invalid-feedback">
        Invalid Email Id !
    </div>
    <section class="text-danger"><?php echo $status?></section>
    </div>
    
    
    <div class="col-md-4">

        <!-- User name -->
        <label for="validationServerUsername" class="form-label">Username</label>
        <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend3">@</span>
        <input type="text" class="form-control <?php echo $erruname; ?>" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" name="uname" value="<?php echo $user1;?>">
        
        <!-- error msg -->
        <div id="validationServerUsernameFeedback" class="invalid-feedback">
        Please choose a username.
        </div>
        <div id="validationServerUsernameFeedback" class="valid-feedback">
        Welcome <?php echo $uname; ?> !.
        </div>
        <section class="text-danger"><?php echo $status2?></section>
    </div>
    </div>
    
    
    
    <div class="col-md-4">
        <!-- Name -->
    <label for="validationServer03" class="form-label">Name</label>
    <input type="text" class="form-control <?php echo $errname; ?>" id="validationServer03" aria-describedby="validationServer03Feedback" name="name" value="<?php echo $name1;?>">
    
    <!-- error msg -->
    <div id="validationServer03Feedback" class="invalid-feedback">
        Please provide your name.
    </div>
    <div id="validationServer03Feedback" class="valid-feedback">
        welcome <?php echo $name; ?> !.
    </div>
    </div>
    
    <div class="col-md-3">
        <!-- Age -->
        <label for="validationServer05" class="form-label">Age</label>
        <input type="text" class="form-control <?php echo $errage; ?>" id="validationServer05" aria-describedby="validationServer05Feedback" name="age" value="<?php echo $age1;?>">
        
        <!-- error msg -->
        <div id="validationServer05Feedback" class="invalid-feedback">
        Please provide your age.
        </div>
        <div id="validationServer05Feedback" class="valid-feedback">
        welcome.
        </div>
    </div>

    <div class="col-md-3">
        <!-- gender -->
    <label for="validationServer04" class="form-label">Gender</label>
    <select class="form-select <?php echo $errgender; ?>" id="validationServer04" aria-describedby="validationServer04Feedback" name="gender" >
        <option selected value="<?php echo $gender1;?>"><?php echo $gender1;?></option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
        
    </select>

    <!-- error msg -->
    <div id="validationServer04Feedback" class="invalid-feedback">
        Please select gender.
    </div>
    </div>

    <div class="col-md-6">
        <!-- file image  -->
        <label for="validationServer01" class="form-label">Upload Image</label>
        <input type="file"  name="att"  class="form-control <?php echo $errimage; ?>" id="validationServer01" value="<?php echo $imgpath;?>">
        
        <!-- error msg -->
        <div class="valid-feedback">
            Looks good !
        </div>
        <div class="invalid-feedback">
            Invalid !
        </div>
        <section class="text-danger"><?php echo $status3?></section>
    </div>

    <div class="col-md-5">
        <!-- Captcha -->
        <label for="validationServer01" class="form-label">Captcha <b><?php echo $val;?></b></label>
        <input type="text"  name="captcha"  class="form-control <?php echo $errcap; ?>" id="validationServer01"  >
        <input type="hidden"  name="captchasum" id="validationServer01" value="<?php echo $capsum;?>" >
        
        <!-- error msg -->
        <div class="valid-feedback">
            Looks good !
        </div>
        <div class="invalid-feedback">
            Invalid Captcha !
        </div>
    </div>

    <div class="col-12">
    <button class="btn btn-success p-2" type="submit" name="sub">Change</button>
    <button class="btn btn-danger p-2" type="reset"> Clear </button>
    </div>

</form>
</section>
