<?php
session_start();
error_reporting(0);
require 'databaseconnection.php';
$random_code =$_SESSION['random'];
$email=$_SESSION['email'];
if(isset($_POST['reset_password'])){


        if (isset($_POST['new_password']) && isset($_POST['verify_password'])) 
        {
                function validate($data)
                {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }
                
                $new_password = validate ($_POST['new_password']);
                $verify_password = validate ($_POST['verify_password']);

        if(empty($new_password)){
                header("Location: userpasswordreset.php?error=New Password is required");
                exit();
        }
        else if(!preg_match("/^[a-zA-Z0-9\w\S]+$/", $new_password))
        {
                header("Location: userpasswordreset.php?error=Password must contain letters, numbers or symbols only&$user_data");
                exit();
        }
        else if(strlen($new_password) <8)
        {
                header("Location: userpasswordreset.php?error=Password is too short must be 8-32 characters length&$user_data");
                exit();
        }
        else if(strlen($new_password) >32){
                header("Location: userpasswordreset.php?error=Password is too long must be 8-32 characters length&$user_data");
                exit();
        }
        else if(empty($verify_password)){
                header("Location: userpasswordreset.php?error=Confirm Password is required");
                exit();
        }                
        else if($new_password !== $verify_password){
                header("Location: userpasswordreset.php?error=The confirmation password does not match");
                exit();
        }
        else
        {
                $new_password=md5($_POST['new_password']);
                $verify_password=md5($_POST['verify_password']);
                $sql= "SELECT * FROM users WHERE email= '$email'";
                $result= mysqli_query($database_connection, $sql);
                $sql2= "SELECT * FROM code WHERE verification_code= '$random_code'";
                $result2= mysqli_query($database_connection, $sql2);

                $adminsql= "SELECT * FROM admins WHERE email= '$email'";
                $adminresult= mysqli_query($database_connection, $adminsql);


                if (mysqli_num_rows($result) && mysqli_num_rows($result2) > 0) 
                {
                        $sql2="UPDATE users SET password='$new_password' WHERE email='$email'";
                        $result2=mysqli_query($database_connection, $sql2);

                        if($result2)
                        {

                                header("Location: userpasswordreset.php?successsend=Password was reset successfully");
                                exit();
                        }
                        else
                        {
                                header("Location: userpasswordreset.php?error=Unknown error occurred");
                                exit();
                        }
                }

                else if (mysqli_num_rows($adminresult) && mysqli_num_rows($result2) > 0) 
                {
                        $sql2="UPDATE admins SET password='$new_password' WHERE email='$email'";
                        $result2=mysqli_query($database_connection, $sql2);

                        if($result2)
                        {

                                header("Location: userpasswordreset.php?successsend=Password was reset successfully");
                                exit();
                        }
                        else
                        {
                                header("Location: userpasswordreset.php?error=Unknown error occurred");
                                exit();
                        }
                }
                else
                {
                        header("Location: userpasswordreset.php?error=The email/verification code is not existing in this site");
                        exit();
                }

        }
}else{
                header("Location: userpasswordreset.php");
                exit();
        }
        

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="css/passwordforgotB.css"/>
        <title>Sanctuary of the Chosen People Christian Fellowship Inc.</title>
</head>

<body>
        <header>
        <?php
        echo "Date: ".date("m/d/y") ;
        echo " Time: ".date("h:i:s:a") ;
        ?>
        </header>

                
        
        <div class="container-fluid  my-container">
        <form action="userpasswordreset.php" method="post">

        <img class="rounded mx-auto d-block" src="css/logoname.png" alt="SCPSF" width="200" height="200">
                <div class="row justify-content-center my-row-9">
        <h1>RESET PASSWORD</h1>
</div>
        <?php if (isset($_GET['error'])){ ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>         
        <?php if (isset($_GET['successsend'])){ ?>
                <p class="successsend"><?php echo $_GET['successsend']; ?></p>
        <?php } ?>        
        <input class="text" type="password" name="new_password" placeholder="New Password"/>
        <input class="text" type="password" name="verify_password" placeholder="Verify Password"/>
        <input class="btn btn-primary btn-lg" type="submit" name="reset_password" value="RESET"/>         
        </form>
</div>
      
<footer>
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">@SCPCFILaguna:
    <a href = "index.php">Sanctuary of the Chosen People Christian Fellowship Inc.</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer --> 
</body>
</html>