<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="css/loginB.css"/>
      <title>User Login | SCPCFI</title>
</head>
<body>

<!-- HEADER --------------------------------------------------------------------------------------------------------------------------->
      <header>
      <?php echo "Date: ".date("m/d/y") ; echo " Time: ".date("h:i:s:a") ; ?>
      </header>
<!-- END OF HEADER -------------------------------------------------------------------------------------------------------------------->

<!-- MAIN ----------------------------------------------------------------------------------------------------------------------------->
        <div class="container-fluid  main">

        <!-- FORM LOGIN --------------------------------------------------------------------------------------------------------------->
        <form action="userlogin2.php" method="post">
                
                <!-- LOGO ------------------------------------------------------------------------------------------------------------->
                <img class="rounded mx-auto d-block" src="css/logoname.png" alt="SCPCFI">
                <!-- LOGO ------------------------------------------------------------------------------------------------------------->

                <div class="row justify-content-center loginhere"> 
                <p class="loginaccount">Log in your account here:</p>
                </div>

                <!-- ERROR MESSAGE ---------------------------------------------------------------------------------------------------->
                <?php if (isset($_GET['error'])){ ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <!-- ERROR MESSAGE ---------------------------------------------------------------------------------------------------->

                <!-- USERNAME INPUT --------------------------------------------------------------------------------------------------->
                <input class="text" type="text" name="username" placeholder="Username" 
                value="<?php if(isset($_COOKIE["scpcfiusername"])) { echo $_COOKIE["scpcfiusername"]; } ?>" id="username"/>
                <!-- USERNAME INPUT --------------------------------------------------------------------------------------------------->

                <!-- PASSWORD INPUT --------------------------------------------------------------------------------------------------->
                <input class="text" type="password" name="password"  placeholder="Password" 
                value="<?php if(isset($_COOKIE["scpcfipassword"])) { echo $_COOKIE["scpcfipassword"]; } ?>" id="password"/>
                <!-- PASSWORD INPUT --------------------------------------------------------------------------------------------------->

                <div class="row justify-content-center">
                <!-- REMEMBER ME ------------------------------------------------------------------------------------------------------>
                <input class="checkbox" type="checkbox" name="rememberme" id="rememberme" 
                <?php if(isset($_COOKIE["username"])) { ?> checked <?php } ?>><label>Remember Me</label>
                <!-- REMEMBER ME ------------------------------------------------------------------------------------------------------>

                <!-- SHOW PASSWORD ---------------------------------------------------------------------------------------------------->
                <input class="checkbox" type="checkbox" onclick="myFunction()"><label>Show Password</label>
                <script>
                function myFunction(){ 
                  var x = document.getElementById("password");
                  if (x.type === "password") {
                    x.type = "text";
                  } else {
                    x.type = "password";
                  }
                }
                </script>
                <!-- SHOW PASSWORD ---------------------------------------------------------------------------------------------------->
                </div>


                <!-- LOGIN BUTTON ----------------------------------------------------------------------------------------------------->
                <div class="row justify-content-center adminbuttonlogin">
                <button class="btn btn-primary btn-lg">LOGIN</button>
                </div>
                <!-- LOGIN BUTTON ----------------------------------------------------------------------------------------------------->


                <!-- FORGOT PASSWORD -------------------------------------------------------------------------------------------------->
                <div class="row justify-content-center">
                <a class="forgotpassword" href="userpasswordforgot.php">Forgot Password?</a>
                </div>
                <!-- FORGOT PASSWORD -------------------------------------------------------------------------------------------------->

                <!-- REGISTER --------------------------------------------------------------------------------------------------------->
                <div class="row justify-content-center">
                <a class="forgotpassword" href="registeruser.php">Not registered? Create an account</a>
                </div>
                <!-- REGISTER --------------------------------------------------------------------------------------------------------->
                
        </form>
         <!-- END OF FORM LOGIN -------------------------------------------------------------------------------------------------------->

      </div>
<!-- END OF MAIN ---------------------------------------------------------------------------------------------------------------------->

<!-- FOOTER ------------------------------------------------------------------------------------------------------------------------ -->
<div class="wrapper">
        <footer>
            <div class="footer text-center">@SCPCFILaguna:
            <a href = "index.php">Sanctuary of the Chosen People Christian Fellowship Inc.</a>
            </div>
        </footer>
</div>
<!-- END OF FOOTER ----------------------------------------------------------------------------------------------------------------- -->
</body>
</html>




        
       

      

