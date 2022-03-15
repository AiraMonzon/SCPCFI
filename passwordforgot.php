<?php
session_start();
include "databaseconnection.php";
if(isset($_POST['send_code']))
{

require 'phpmailer/PHPMailerAutoload.php';
require'phpmailer/constants.php';

        $email=$_POST['email'];
        $random_code=mt_rand(0,999999);
        $_SESSION['random']=$random_code;
        $message="Your reset code is " .$random_code;
        $subject="Reset Code";
        $_SESSION['email']= $email;

//mail send sample code
$mail = new PHPMailer();
//$mail->SMTPDebug = 3;
$mail->isSMTP();
$mail->SMTPAuth =true;
$mail->SMTPSecure='tls';  //tls ssl
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;    // 587 465
$mail->IsHTML(true);
$mail->CharSet='UTF-8';
$mail->Username='zacjohnsons2@gmail.com';
$mail->Password=PASSWORD;
$mail->SetFrom('zacjohnsons2@gmail.com', 'SCPCFI');
$mail->AddAddress($email);
$mail->addReplyTo('zacjohnsons2@gmail.com', 'SCPCFI');   
$mail->Subject = $subject;
$mail->Body="<h1>$message </h1><a href=http://localhost/scpcficlean/passwordforgot.php>VERIFY NOW</a>";
$mail->SMTPOptions = array(
    'ssl' => [
        'verify_peer' => false,
        'verify_depth' => false,
        'allow_self_signed' => false,
        'verify_peer_name' => false
    ]
);

if (!$mail->send()) {
    header("Location: passwordforgot.php?error=Please enter valid email address");
                        exit();
} else {


    header("Location: passwordforgot.php?successsend=Verification code was sent to your email successfully!");
                        exit();
}
}
if(isset($_POST['verify_code'])){
        $code=$_POST['verification_code'];
        if($code==$_SESSION['random']){
                $sql= "INSERT INTO code (verification_code) VALUES('$code')";
$result= mysqli_query($database_connection, $sql);
                header('Location:passwordreset.php');
        }
        else{
                header("Location: passwordforgot.php?error=Please enter valid verification code!");
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
        <form method="post">

<img class="rounded mx-auto d-block" src="css/logoname.png" alt="SCPSF" width="200" height="200">
                <div class="row justify-content-center my-row-9">
        <h1>REQUEST CODE</h1>
</div>
<div class="row justify-content-center my-row-1"> 
                <p>Verify the code from your e-mail address</p>
                </div>
        <?php if (isset($_GET['error'])){ ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>         
        <?php if (isset($_GET['successsend'])){ ?>
                <p class="successsend"><?php echo $_GET['successsend']; ?></p>
        <?php } ?>

        <input class="text" type="text" name="email" placeholder="Enter your e-mail address"/>
        <input class="btn btn-primary btn-lg" type="submit" name="send_code" value="SEND"/>
        <input class="text" type="text" name="verification_code" placeholder="Enter your verification code"/>
        <input class="btn btn-primary btn-lg" type="submit" name="verify_code" value="VERIFY"/>         
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