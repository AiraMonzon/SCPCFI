<?php
        error_reporting(0);
        include 'databaseconnection.php';

        $id= "";
        $first_name = "";
        $middle_name = "";
        $last_name = "";
        $email = "";
        $phone = "";
        $housestreet = "";
        $baranggay = "";
        $city = "";
        $province = "";
        $zp = "";
        $birthdate = "";
        $gender = "";  
        $username = "";
        $password = "";
        $repassword = "";            
            
        if(isset($_POST['register']))
        {
                if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['first_name']) && isset($_POST['middle_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['housestreet']) && isset($_POST['baranggay']) && isset($_POST['city']) && isset($_POST['province']) && isset($_POST['zp']) && isset($_POST['birthdate'])) 
                {

                function validate($data)
                {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }
                
                $username = validate ($_POST['username']);
                $password = validate ($_POST['password']);
                $repassword = validate ($_POST['repassword']);
                $first_name = validate ($_POST['first_name']);
                $middle_name = validate ($_POST['middle_name']);
                $last_name = validate ($_POST['last_name']);
                $email = validate ($_POST['email']);
                $phone = validate ($_POST['phone']);
                $housestreet = validate ($_POST['housestreet']);
                $baranggay = validate ($_POST['baranggay']);
                $city = validate ($_POST['city']);
                $province = validate ($_POST['province']);
                $zp = validate ($_POST['zp']);
                $gender = validate ($_POST['gender']);              
                $birthdate = validate ($_POST['birthdate']);

                if(!empty($phone)){
                  $phone = str_replace([' ', '.', '-', '(', ')'], '', $phone);
                $phone = str_replace(['+63'], '0', $phone);
                $phone = substr_replace($phone, "09", 0, 2);

                        
                }
                
                $user_data = 'username=' . $username. '&first_name=' . $first_name . '&middle_name=' . $middle_name . '&last_name=' . $last_name . '&email=' . $email . '&phone=' . $phone . '&housestreet=' . $housestreet . '&baranggay=' . $baranggay. '&city=' . $city. '&province=' . $province . '&zp=' . $zp. '&gender=' . $gender . '&birthdate=' . $birthdate;

                if(empty($first_name)){
                        header("Location: registeruser.php?error=First Name is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z\s]+$/", $first_name)){
                        header("Location: registeruser.php?error=First Name must contain letters&$user_data");
                        exit();
                }
                else if(strlen($first_name) <2){
                        header("Location: registeruser.php?error=First Name is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($first_name) >35){
                        header("Location: registeruser.php?error=First Name is too long must be 2-35 characters length&$user_data");
                        exit();
                }

                else if(!empty($middle_name) && !preg_match("/^[a-zA-Z\s]+$/", $middle_name)){
                        header("Location: registeruser.php?error=Middle Name must contain letters&$user_data");
                        exit();
                }
                else if(!empty($middle_name) && strlen($middle_name) <2){
                        header("Location: registeruser.php?error=Middle Name is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(!empty($middle_name) && strlen($middle_name) >35){
                        header("Location: registeruser.php?error=Middle Name is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(empty($last_name)){
                        header("Location: registeruser.php?error=Last Name is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z\s]+$/", $last_name)){
                        header("Location: registeruser.php?error=Last Name must contain letters&$user_data");
                        exit();
                }
                else if(strlen($last_name) <2){
                        header("Location: registeruser.php?error=Last Name is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($last_name) >35){
                        header("Location: registeruser.php?error=Last Name is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($first_name) + strlen($middle_name) + strlen($last_name)>70){
                        header("Location: registeruser.php?error=Full Name is too long must be 70 characters length&$user_data");
                        exit();
                }
                else if(empty($email)){
                        header("Location: registeruser.php?error=Email is required&$user_data");
                        exit();
                }
                else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        header("Location: registeruser.php?error=Email is incorrect&$user_data");
                        exit();
                }                
                else if(empty($phone)){
                        header("Location: registeruser.php?error=Phone Number is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[0-9]+$/", $phone)){
                        header("Location: registeruser.php?error=Phone Number must contain numbers&$user_data");
                        exit();
                }
                else if(strlen($phone) <11){
                        header("Location: registeruser.php?error=Phone Number is too short must be 11 characters length&$user_data");
                        exit();
                }
                else if(strlen($phone) >11){
                        header("Location: registeruser.php?error=Phone Number is too long must be 11 characters length&$user_data");
                        exit();
                }
                else if(empty($housestreet)){
                        header("Location: registeruser.php?error=House No. or Street Name is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z0-9\s]+$/", $housestreet)){
                        header("Location: registeruser.php?error=House No. and Street Name must contain letters or numbers&$user_data");
                        exit();
                }
                else if(strlen($housestreet) <2){
                        header("Location: registeruser.php?error=House No. and Street Name is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($housestreet) >35){
                        header("Location: registeruser.php?error=House No. and Street Name is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(empty($baranggay)){
                        header("Location: registeruser.php?error=Baranggay is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z\s]+$/", $baranggay)){
                        header("Location: registeruser.php?error=Baranggay must contain letters&$user_data");
                        exit();
                }
                else if(strlen($baranggay) <2){
                        header("Location: registeruser.php?error=Baranggay is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($baranggay) >35){
                        header("Location: registeruser.php?error=Baranggay is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(empty($city)){
                        header("Location: registeruser.php?error=City is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z\s]+$/", $city)){
                        header("Location: registeruser.php?error=City must contain letters&$user_data");
                        exit();
                }
                else if(strlen($city) <2){
                        header("Location: registeruser.php?error=City is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($city) >35){
                        header("Location: registeruser.php?error=City is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(empty($province)){
                        header("Location: registeruser.php?error=Province is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z\s]+$/", $province)){
                        header("Location: registeruser.php?error=Province must contain letters&$user_data");
                        exit();
                }
                else if(strlen($province) <2){
                        header("Location: registeruser.php?error=Province is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($province) >35){
                        header("Location: registeruser.php?error=Province is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(empty($zp)){
                        header("Location: registeruser.php?error=ZIP or Postal Code is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[0-9]+$/", $zp)){
                        header("Location: registeruser.php?error=ZIP or Postal Code must contain numbers&$user_data");
                        exit();
                }
                else if(strlen($zp) <4){
                        header("Location: registeruser.php?error=ZIP or Postal Code is too short must be 4 characters length&$user_data");
                        exit();
                }
                else if(strlen($zp) >4){
                        header("Location: registeruser.php?error=ZIP or Postal Code is too long must be 4 characters length&$user_data");
                        exit();
                }
                else if(empty($birthdate)){
                        header("Location: registeruser.php?error=Birthday is required&$user_data");
                        exit();
                }
                else if(empty($gender)){
                        header("Location: registeruser.php?error=Gender is required&$user_data");
                        exit();
                }  
                else if(empty($username)){
                        header("Location: registeruser.php?error=Username is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z0-9\s\_\-]+$/", $username)){
                        header("Location: registeruser.php?error=Username must contain letters, numbers or symbols only&$user_data");
                        exit();
                }
                else if(strlen($username) <6){
                        header("Location: registeruser.php?error=Username is too short must be 6-30 characters length&$user_data");
                        exit();
                }
                else if(strlen($username) >30){
                        header("Location: registeruser.php?error=Username is too long must be 6-30 characters length&$user_data");
                        exit();
                }
                else if(empty($password)){
                        header("Location: registeruser.php?error=Password is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z0-9\w\S]+$/", $password)){
                        header("Location: registeruser.php?error=Password must contain letters, numbers or symbols only&$user_data");
                        exit();
                }
                else if(strlen($password) <8){
                        header("Location: registeruser.php?error=Password is too short must be 8-32 characters length&$user_data");
                        exit();
                }
                else if(strlen($password) >32){
                        header("Location: registeruser.php?error=Password is too long must be 8-32 characters length&$user_data");
                        exit();
                }
                else if(empty($repassword)){
                        header("Location: registeruser.php?error=Confirm Password is required&$user_data");
                        exit();
                } 
                else if($password !== $repassword){
                        header("Location: registeruser.php?error=The confirmation password does not match&$user_data");
                        exit();
                }


                else
                {
                  
                        $first_name = strtoupper($first_name);
                        $middle_name = strtoupper($middle_name);
                        $last_name = strtoupper($last_name);
                        $housestreet = strtoupper($housestreet);
                        $baranggay = strtoupper($baranggay);
                        $city = strtoupper($city);
                        $province = strtoupper($province);
                        $password = md5($password); 
                        $sql= "SELECT * FROM users WHERE username= '$username'";
                        $result= mysqli_query($database_connection, $sql);

                        if (isset($_POST['username']))
                        {
                          
                                if (mysqli_num_rows($result) > 0) 
                               {
                                header("Location: registeruser.php?error=The username is already taken&$user_data");
                                exit();
                               } 
                               
                               else
                               {
                                        $sql2= "INSERT INTO users(first_name, middle_name, last_name, email, phone, housestreet, baranggay, city, province, zp, gender, birthdate, username, password) VALUES('$first_name', '$middle_name', '$last_name','$email','$phone','$housestreet','$baranggay','$city','$province','$zp','$gender','$birthdate', '$username', '$password')";

                                        $result2= mysqli_query($database_connection, $sql2);

                                        if($result2)
                                        {
                                                header("Location: registeruser.php?success=Account has been created successfully");
                                        exit();
                                        }
                                        else
                                        {
                                                header("Location: registeruser.php?error=Unknown error occurred&$user_data");
                                        exit();
                                        }
                               }
                        }  
                }

        }
        
        else
        {
                header("Location: registeruser.php");
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
      <link rel="stylesheet" href="css/registeruserB.css"/>
      <title>SCPCFI Admin Login</title>
</head>
<body>
        <header>
        <?php
        echo "Date: ".date("m/d/y") ;
        echo " Time: ".date("h:i:s:a") ;
        ?>
        </header>
 
        <div class="container-fluid  my-container">
        <form action="registeruser.php" method="post">

                <div class="row">
                <img src="css/logo.png" alt="SCPSF" width="200" height="200">
                <h1>Member Account Registration</h1>
                </div>

                <?php if (isset($_GET['error'])){ ?>
                  <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <?php if (isset($_GET['success'])){ ?>
                  <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>  

                <div class="row text-center">
                        <div class="col-4">
                <label>First Name</label>
        </div>
                                <div class="col-4">
                <label>Middle Name</label>
        </div>
                                <div class="col-4">
                <label>Last Name</label>
        </div>
        <div class="col-4">
                <?php if (isset($_GET['first_name'])) { ?>
                  <input type="text" 
                          name="first_name" 
                          placeholder="First Name"
                          value="<?php echo $_GET['first_name']; ?>">
                <?php }else{ ?>
                  <input type="text" 
                          name="first_name" 
                          placeholder="First Name"
                          value="<?php echo $first_name; ?>">
                <?php }?> 
        </div>
                <div class="col-4">
                <?php if (isset($_GET['middle_name'])) { ?>
                  <input type="text" 
                          name="middle_name" 
                          placeholder="Middle Name"
                          value="<?php echo $_GET['middle_name']; ?>"> 
                <?php }else{ ?>
                  <input type="text" 
                          name="middle_name" 
                          placeholder="Middle Name"
                          value="<?php echo $middle_name; ?>"> 
                <?php }?>
                </div>

                <div class="col-4">
                <?php if (isset($_GET['last_name'])) { ?>
                  <input type="text" 
                          name="last_name" 
                          placeholder="Last Name"
                          value="<?php echo $_GET['last_name']; ?>"> <br>
                <?php }else{ ?>
                  <input type="text" 
                          name="last_name" 
                          placeholder="Last Name"
                          value="<?php echo $last_name; ?>"> <br>
                <?php }?>
        </div>
        </div>
                <div class="row text-center">
                        <div class="col-4">
                <label>E-mail</label>
        </div>
        <div class="col-4">
                <label>Phone Number</label>
        </div>
        <div class="col-4">
                <label>House No. / Street Name</label>
        </div>
        <div class="col-4">
                <?php if (isset($_GET['email'])) { ?>
                  <input type="email" 
                          name="email" 
                          placeholder="E-mail"
                          value="<?php echo $_GET['email']; ?>"> 
                <?php }else{ ?>
                  <input type="email" 
                          name="email" 
                          placeholder="E-mail"
                          value="<?php echo $email; ?>"> 
                <?php }?>
        </div>
<div class="col-4">
                
                <?php if (isset($_GET['phone'])) { ?>
                  <input type="text"
                          name="phone" 
                          placeholder="Phone Number"
                          value="<?php echo $_GET['phone']; ?>" > 
                <?php }else{ ?>
                  <input type="text" 
                          name="phone" 
                          placeholder="Phone Number"
                          value="<?php echo $phone; ?>" >
                <?php }?> 
</div>
<div class="col-4">
               
                <?php if (isset($_GET['housestreet'])) { ?>
                  <input type="text" 
                          name="housestreet" 
                          placeholder="House No. / Street Name"
                          value="<?php echo $_GET['housestreet']; ?>"> <br>
                <?php }else{ ?>
                  <input type="text" 
                          name="housestreet" 
                          placeholder="House No. / Street Name"
                          value="<?php echo $housestreet; ?>"> <br>
                <?php }?>
        </div>
        </div>

<div class="row text-center">
                        <div class="col-4">
                <label>Baranggay</label>
        </div>
        <div class="col-4">
                <label>City</label>
        </div>
        <div class="col-4">
                <label>Province</label>
        </div>
   <div class="col-4">
                <?php if (isset($_GET['baranggay'])) { ?>
                  <input type="text" 
                          name="baranggay" 
                          placeholder="Baranggay"
                          value="<?php echo $_GET['baranggay']; ?>"> 
                <?php }else{ ?>
                  <input type="text" 
                          name="baranggay" 
                          placeholder="Baranggay"
                          value="<?php echo $baranggay; ?>"> 
                <?php }?>
</div>
<div class="col-4">
                <?php if (isset($_GET['city'])) { ?>
                  <input type="text" 
                          name="city" 
                          placeholder="City"
                          value="<?php echo $_GET['city']; ?>">
                <?php }else{ ?>
                  <input type="text" 
                          name="city" 
                          placeholder="City"
                          value="<?php echo $city; ?>">
                <?php }?>

</div>
<div class="col-4">
                <?php if (isset($_GET['province'])) { ?>
                  <input type="text" 
                          name="province" 
                          placeholder="Province"
                          value="<?php echo $_GET['province']; ?>"> <br>
                <?php }else{ ?>
                  <input type="text" 
                          name="province" 
                          placeholder="Province"
                          value="<?php echo $province; ?>"> <br>
                <?php }?>
        </div>
</div>

<div class="row text-center">
                        <div class="col-4">
                <label>Zip / Postal Code</label>
        </div>
        <div class="col-4">
                <label>Birthdate</label>
        </div>
        <div class="col-4">
                <label>Gender</label>
        </div>

                <div class="col-4">
                <?php if (isset($_GET['zp'])) { ?>
                  <input type="text" 
                          name="zp" 
                          placeholder="ZIP/Postal Code"
                          value="<?php echo $_GET['zp']; ?>"> 
                <?php }else{ ?>
                  <input type="text" 
                          name="zp" 
                          placeholder="ZIP/Postal Code"
                          value="<?php echo $zp; ?>"> 
                <?php }?>
</div>
<div class="col-4">
                
                <?php if (isset($_GET['birthdate'])) { ?>
                  <input class="date" type="date" 
                          id="birthdate"
                          name="birthdate" 
                          value="<?php echo $_GET['birthdate']; ?>"> 
                <?php }else{ ?>
                  <input type="date" 
                          name="birthdate" 
                          value="<?php echo $birthdate; ?>">
                <?php }?>

        </div>
        <div class="col-4 column">
                <?php if (isset($_GET['gender'])) { ?>
                  <input class="radio" type="radio" 
                          id="male"
                          name="gender" 
                          value="MALE"

                          <?php 
                          if($_GET['gender'] == "MALE")
                          {
                            echo "checked";
                          }
                          ?>
                          ><span>Male</span>
                  <input class="radio" type="radio" 
                          id="female"
                          name="gender" 
                          value="FEMALE"
                          
                          <?php 
                          if($_GET['gender'] == "FEMALE")
                          {
                            echo "checked";
                          }
                          ?>
                          ><span>Female</span><br>
                <?php }else{ ?>
                  <input class="radio" type="radio"
                          id="male" 
                          name="gender"
                          value="MALE"
                          
                          <?php 
                          if($gender == "MALE")
                          {
                            echo "checked";
                          }
                          ?>
                          ><span>Male</span>
                  <input class="radio" type="radio" 
                          id="female"
                          name="gender" 
                          value="FEMALE"
                          
                          <?php 
                          if($gender == "FEMALE")
                          {
                            echo "checked";
                          }
                          ?>
                          ><span>Female</span><br>       
                <?php }?> 

                </div>
</div>
<div class="row text-center">
                        <div class="col-4">
                <label>Username</label>
        </div>
        <div class="col-4">
                <label>Password</label>
        </div>
        <div class="col-4">
                <label>Confirm Password</label>
        </div>
                <div class="col-4">
                <?php if (isset($_GET['username'])) { ?>
                  <input type="text" 
                          name="username" 
                          placeholder="Username"
                          value="<?php echo $_GET['username']; ?>">
                <?php }else{ ?>
                  <input type="text" 
                          name="username" 
                          placeholder="Username"
                          value="<?php echo $username; ?>"> 
                <?php }?> 

                </div>
                <div class="col-4">
                <?php if (isset($_GET['password'])) { ?>
                  <input type="password" 
                          name="password" 
                          placeholder="Password"
                          value="<?php echo ($_GET['password']); ?>"> 
                <?php }else{ ?>
                  <input type="password" 
                          name="password" 
                          placeholder="Password"
                          value=""> 
                <?php }?>     
</div>
<div class="col-4">
                
                <?php if (isset($_GET['repassword'])) { ?>
                  <input type="password" 
                          name="repassword" 
                          placeholder="Confirm Password"
                          value="<?php echo ($_GET['repassword']); ?>"> <br>
                <?php }else{ ?>
                  <input type="password" 
                          name="repassword" 
                          placeholder="Confirm Password"
                          value=""> <br>
                <?php }?>
</div>
</div>
<div class="row">
                        <div class="col-12">
               <input class="btn btn-primary" type="submit" name="register" value="REGISTER">
               <input class="btn btn-primary" type="submit" name="refresh" action="registeruser.php" value="REFRESH"><br>
</div>
</div>
                <div class="col-12">
               <p>Already have an account? <a href="userlogin.php">Login</a></p>   </div>
        </form> 
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