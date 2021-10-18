<?php 
error_reporting(0);
include("connection.php");
$fetch=mysqli_query($conn,"SELECT * FROM users ORDER BY created_at DESC;");

  if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['pass'];
    $pass1=$password;
    // check for empty field
    if(!empty($email) && !empty($password)){
      // check for user email
      if(mysqli_num_rows($fetch)>0){
        while($arr=mysqli_fetch_assoc($fetch)){
          if($arr['email']==$email || $arr['username']==$email){
            $pass=$arr['password'];
            $password=substr(sha1($password),0,10); // password decode
            if($pass==$password){
              // session variables for other pages
              session_start();
              $_SESSION['sid']=$arr['id'];
              $_SESSION['user']=$arr['username'];
              if(!empty($_POST['rememberme'])){
                // remember me concept
                setcookie("email",$email,time()+3600*24);
                setcookie("password",$pass1,time()+3600*24);
              }
              header("location:dashboard.php");
              break;
            }
            else {
              $erremail=$errpass="Enter correct email or password";
            }
          }
          else{
            $erremail=$errpass="user not found !";
          }
        }
      }
      else{
        $erremail=$errpass="No records found !";
      }
    }
    else {
      $erremail=$errpass="Plz fill the blank fields";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- include head tags and other scripts/links -->
<?php include('head.php')?>
<script>

  // cookies function to generate passsword.
  function cook(){
    if("<?php echo $_COOKIE['email'];?>"!=undefined){
      if("<?php echo $_COOKIE['email'];?>" == document.getElementById("email").value){
        document.getElementById("password").value = "<?php echo $_COOKIE['password'];?>";
      }
      else{
        document.getElementById("password").value = "";
      }
    }
  }

</script>
</head>
<body>
    <section class="container">
        <div class="jumbotron">
        <h1 class="display-4">Login Panel</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>

        </div>
           <!-- login form -->
            <form method="post">
              <!-- email id -->
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Email - ID | Username</span>
                <input type="text" class="form-control" name="email" id="email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" onchange="cook()">
            </div>
            <!-- error msg -->
                <span class="text-danger"><?php echo $erremail;?></span>
                <br>

                <!-- password -->
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Password</span>
                <input type="password" class="form-control" id="password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="pass">
            </div>
            <!-- error msg -->
                <span class="text-danger"><?php echo $errpass?></span>
                <br>

                <!-- remember option -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="rememberme" id="exampleCheck1">
                <label class="form-check-label"  for="exampleCheck1">Remember me</label>
            </div>
                <button type="submit" class="btn btn-success p-2" name="submit">Sign in</button>
                <a class="btn btn-primary " href="register.php"  role="button">New User</a>
            </form>
    </section>
    <section class="container-fluid">

    <!-- include script tags. -->
    <?php include('foot.php')?>
</body>
</html>
