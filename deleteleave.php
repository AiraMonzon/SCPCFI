<?php
	session_start();
	session_unset();
	session_destroy();
	echo '<script>alert("Your account has been deleted successfully. You cannot use this account to login again!")</script>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/index.css"/>
        <title>Sanctuary of the Chosen People Christian Fellowship Inc.</title>
</head>

<body>
        <header>
        <?php
        echo "Date: ".date("m/d/y") ;
        echo " Time: ".date("h:i:s:a") ;
        ?>
        </header>

        <img class="rounded mx-auto d-block" src="img/logo.png" alt="SCPCFI">


        <div class="container-fluid  my-container">
        <div class="row justify-content-center my-row-1">        
        <h1>Hi, Welcome!</h1>
        </div>
        <div class="row justify-content-center my-row-2">
        <p>Please click your destination</p>
        </div>
        <div class="row justify-content-center my-row-3">
        <form action="adminlogin.php">
        <button class="btn btn-primary btn-lg" type="submit">ADMIN</button>
        </form>
        </div>
        <div class="row justify-content-center my-row-4">
        <form action="userlogin.php">
        <button class="btn btn-primary btn-lg" type="submit">USER</button>
        </form>
        </div>
        </div>


        <!-- Footer -->
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