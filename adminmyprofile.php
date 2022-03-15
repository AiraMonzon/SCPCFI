<?php 
      session_start();

      if(isset($_SESSION['id']) && isset($_SESSION['username']))
      {
?>
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

            

            function getPosts()
            {
                  $posts= array();
                  $posts[0]= $_POST['id'];
                  $posts[1]= $_POST['first_name'];
                  $posts[2]= $_POST['middle_name'];
                  $posts[3]= $_POST['last_name'];
                  $posts[4]= $_POST['email'];
                  $posts[5]= $_POST['phone'];
                  $posts[6]= $_POST['housestreet'];
                  $posts[7]= $_POST['baranggay'];
                  $posts[8]= $_POST['city'];
                  $posts[9]= $_POST['province'];
                  $posts[10]= $_POST['zp'];
                  $posts[11]= $_POST['birthdate'];
                  
                  $posts[12]= $_POST['username'];
                  $posts[13]= $_POST['password'];

        
             
                  return $posts;
                  $gender = $_POST['gender'];
            }
                  
                  
                        
                        $data= getPosts();
                        $search_query= "SELECT * FROM admins WHERE id= '$_SESSION[id]'";
                        $search_result= mysqli_query($database_connection, $search_query);

                  
                        if($search_result)
                        {

                              
                              
                              if(mysqli_num_rows($search_result))
                              {
                                    while($row = mysqli_fetch_array($search_result))
                                    {
                                          $id= $row['id'];
                                          $first_name= $row['first_name'];
                                          $middle_name= $row['middle_name'];
                                          $last_name= $row['last_name'];
                                          $email= $row['email'];
                                          $phone= $row['phone'];
                                          $housestreet= $row['housestreet'];
                                          $baranggay= $row['baranggay'];
                                          $city= $row['city'];
                                          $province= $row['province'];
                                          $zp= $row['zp'];
                                          $birthdate= $row['birthdate'];
                                          $gender= $row['gender'];
                                          $username= $row['username'];

                                          $password= $row['password'];


                                                $viewid= $row['id'];
                                          $viewfirst_name= $row['first_name'];
                                          $viewmiddle_name= $row['middle_name'];
                                          $viewlast_name= $row['last_name'];
                                          $viewemail= $row['email'];
                                          $viewphone= $row['phone'];
                                          $viewhousestreet= $row['housestreet'];
                                          $viewbaranggay= $row['baranggay'];
                                          $viewcity= $row['city'];
                                          $viewprovince= $row['province'];
                                          $viewzp= $row['zp'];
                                          $viewbirthdate= $row['birthdate'];
                                          $viewgender= $row['gender'];
                                          $viewusername= $row['username'];

                                          $viewpassword= $row['password'];
                                
                                         
                                    }
                              }
                        

                        } 
                             


//TO UPDATE
if(isset($_POST['update']))
            {
              
                  if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['first_name']) && isset($_POST['middle_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['housestreet']) && isset($_POST['baranggay']) && isset($_POST['city']) && isset($_POST['province']) && isset($_POST['zp']) && isset($_POST['birthdate'])) {

                function validate($data){
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

            
                $user_data = 'username=' . $username. '&first_name=' . $first_name . '&middle_name=' . $middle_name . '&last_name=' . $last_name . '&email=' . $email . '&phone=' . $phone . '&housestreet=' . $housestreet . '&baranggay=' . $baranggay. '&city=' . $city. '&province=' . $province . '&zp=' . $zp. '&gender=' . $gender . '&birthdate=' . $birthdate . '&id=' . $id;
                
                if(empty($id)){
                        $id= $_SESSION['id'];
                }
                else if($id !== $_SESSION['id'] ){
                        $id= $_SESSION['id'];
                }
                else if(empty($first_name)){
                        header("Location: adminmyprofile.php?error=First Name is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z\s]+$/", $first_name)){
                        header("Location: adminmyprofile.php?error=First Name must contain letters&$user_data");
                        exit();
                }
                else if(strlen($first_name) <2){
                        header("Location: adminmyprofile.php?error=First Name is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($first_name) >35){
                        header("Location: adminmyprofile.php?error=First Name is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(empty($middle_name)){
                        header("Location: adminmyprofile.php?error=Middle Name is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z\s]+$/", $middle_name)){
                        header("Location: adminmyprofile.php?error=Middle Name must contain letters&$user_data");
                        exit();
                }
                else if(strlen($middle_name) <2){
                        header("Location: adminmyprofile.php?error=Middle Name is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($middle_name) >35){
                        header("Location: adminmyprofile.php?error=Middle Name is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(empty($last_name)){
                        header("Location: adminmyprofile.php?error=Last Name is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z\s]+$/", $last_name)){
                        header("Location: adminmyprofile.php?error=Last Name must contain letters&$user_data");
                        exit();
                }
                else if(strlen($last_name) <2){
                        header("Location: adminmyprofile.php?error=Last Name is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($last_name) >35){
                        header("Location: adminmyprofile.php?error=Last Name is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($first_name) + strlen($middle_name) + strlen($last_name)>70){
                        header("Location: adminmyprofile.php?error=Full Name is too long must be 70 characters length&$user_data");
                        exit();
                }
                else if(empty($email)){
                        header("Location: adminmyprofile.php?error=Email is required&$user_data");
                        exit();
                }
                else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        header("Location: adminmyprofile.php?error=Email is incorrect&$user_data");
                        exit();
                }              
                else if(empty($phone)){
                        header("Location: adminmyprofile.php?error=Phone Number is required&$user_data");
                        exit();
                }
                             
                else if(!preg_match("/^[0-9]+$/", $phone)){
                        header("Location: adminmyprofile.php?error=Phone Number must contain numbers&$user_data");
                        exit();
                }

                else if(strlen($phone) <11){
                        header("Location: adminmyprofile.php?error=Phone Number is too short must be 11 characters length&$user_data");
                        exit();
                }
                else if(strlen($phone) >11){
                        header("Location: adminmyprofile.php?error=Phone Number is too long must be 11 characters length&$user_data");
                        exit();
                }
                else if(empty($housestreet)){
                        header("Location: adminmyprofile.php?error=House No. or Street Name is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z0-9\s]+$/", $housestreet)){
                        header("Location: adminmyprofile.php?error=House No. and Street Name must contain letters or numbers&$user_data");
                        exit();
                }
                else if(strlen($housestreet) <2){
                        header("Location: adminmyprofile.php?error=House No. and Street Name is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($housestreet) >35){
                        header("Location: adminmyprofile.php?error=House No. and Street Name is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(empty($baranggay)){
                        header("Location: adminmyprofile.php?error=Baranggay is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z\s]+$/", $baranggay)){
                        header("Location: adminmyprofile.php?error=Baranggay must contain letters&$user_data");
                        exit();
                }
                else if(strlen($baranggay) <2){
                        header("Location: adminmyprofile.php?error=Baranggay is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($baranggay) >35){
                        header("Location: adminmyprofile.php?error=Baranggay is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(empty($city)){
                        header("Location: adminmyprofile.php?error=City is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z\s]+$/", $city)){
                        header("Location: adminmyprofile.php?error=City must contain letters&$user_data");
                        exit();
                }
                else if(strlen($city) <2){
                        header("Location: settings.php?error=City is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($city) >35){
                        header("Location: adminmyprofile.php?error=City is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(empty($province)){
                        header("Location: adminmyprofile.php?error=Province is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z\s]+$/", $province)){
                        header("Location: adminmyprofile.php?error=Province must contain letters&$user_data");
                        exit();
                }
                else if(strlen($province) <2){
                        header("Location: adminmyprofile.php?error=Province is too short must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(strlen($province) >35){
                        header("Location: adminmyprofile.php?error=Province is too long must be 2-35 characters length&$user_data");
                        exit();
                }
                else if(empty($zp)){
                        header("Location: adminmyprofile.php?error=ZIP or Postal Code is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[0-9]+$/", $zp)){
                        header("Location: adminmyprofile.php?error=ZIP or Postal Code must contain numbers&$user_data");
                        exit();
                }
                else if(strlen($zp) <4){
                        header("Location: adminmyprofile.php?error=ZIP or Postal Code is too short must be 4 characters length&$user_data");
                        exit();
                }
                else if(strlen($zp) >4){
                        header("Location: adminmyprofile.php?error=ZIP or Postal Code is too long must be 4 characters length&$user_data");
                        exit();
                }
                else if(empty($gender)){
                        header("Location: adminmyprofile.php?error=Gender is required&$user_data");
                        exit();
                }

                else if(empty($birthdate)){
                        header("Location: adminmyprofile.php?error=Birthday is required&$user_data");
                        exit();
                }
                  
                else if(empty($username)){
                        header("Location: adminmyprofile.php?error=Username is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z0-9\s\_\-]+$/", $username)){
                        header("Location: adminmyprofile.php?error=Username must contain letters, numbers or symbols only&$user_data");
                        exit();
                }
                else if(strlen($username) <6){
                        header("Location: adminmyprofile.php?error=Username is too short must be 6-30 characters length&$user_data");
                        exit();
                }
                else if(strlen($username) >30){
                        header("Location: adminmyprofile.php?error=Username is too long must be 6-30 characters length&$user_data");
                        exit();
                }
                else if(empty($password)){
                        header("Location: adminmyprofile.php?error=Password is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[a-zA-Z0-9\w\S]+$/", $password)){
                        header("Location: adminmyprofile.php?error=Password must contain letters, numbers or symbols only&$user_data");
                        exit();
                }
                else if(strlen($password) <8){
                        header("Location: adminmyprofile.php?error=Password is too short must be 8-32 characters length&$user_data");
                        exit();
                }
                else if(strlen($password) >32){
                        header("Location: adminmyprofile.php?error=Password is too long must be 8-32 characters length&$user_data");
                        exit();
                }
                else if(empty($repassword)){
                        header("Location: adminmyprofile.php?error=Confirm Password is required&$user_data");
                        exit();
                }
                
                
                
                else if($password !== $repassword){
                        header("Location: adminmyprofile.php?error=The confirmation password does not match&$user_data");
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
                        $password = md5($_POST['password']);
                        $sql= "SELECT * FROM admins WHERE id= '$id'";
                        $result= mysqli_query($database_connection, $sql);

                          
                       if (mysqli_num_rows($result) > 0) 
                       {
                       
                        
                        
                        $sql2= "UPDATE admins SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',email='$email',phone='$phone',housestreet='$housestreet',baranggay='$baranggay',city='$city',province='$province',zp='$zp',birthdate='$birthdate', gender='$gender',username='$username',password= '$password' WHERE id ='$id'";

                        $result2= mysqli_query($database_connection, $sql2);

                                        if($result2)
                                        {
                                                $log_username = $_SESSION['username'];
                                                $log_activity = "Update Admin Profile"; 
                                                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$username')";
                                                $result3= mysqli_query($database_connection, $sql3);
                                                header("Location: adminmyprofile.php?success=Account has been updated successfully");
                                        exit();
                                        }
                                        else
                                        {
                                                header("Location: adminmyprofile.php?error=Unknown error occurred&$user_data");
                                        exit();
                                        }                        
                       } 

                       else
                       {
                                        header("Location: adminmyprofile.php?error=The id is not existing&$user_data");
                        exit();
                       }
                     
                }

        }else{
                header("Location: adminmyprofile.php");
                exit();
        }
}

//TO DELETE
if(isset($_POST['delete']))
            {


                if(empty($id))
                {
                        $id= $_SESSION['id'];
                }

                else
                {
                        $sql= "SELECT * FROM admins WHERE id= '$_SESSION[id]'";
                        $result= mysqli_query($database_connection, $sql);

                       if (mysqli_num_rows($result) > 0) 
                       {
                                        $id = $_POST['id'];
                                        $sql2 = "DELETE FROM admins WHERE id ='$_SESSION[id]' ";
                                        $result2 = mysqli_query($database_connection, $sql2);

                                        if($result2)
                                        {
                                       header("Location: deleteleave.php");
                                         exit();
                                         }
                                        else
                                        {
                                        header("Location: adminmyprofile.php?error=Unknown error occurred&$user_data");
                                        exit();
                                        } 
                          }     
            
                        
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/adminmyprofileC.css"/>
        <title>Admin My Profile | SCPCFI</title>
</head> 
<body>
        <!-- HEADER NAVIGATION ------------------------------------------------------------------------------------------------------------------------->
      <header>

            <div class="wholenav fixed-top" id="fixmenu">

            <!-- FIRST HEADER NAVIGATION ------------------------------------------------------------------------------------------------------->
            <div class="row firstheader">
                  <div class="col-10 justify-content-left">
                  <img class ="logo" src="css/logo.png">
                  <a><b>Sanctuary of the Chosen People Christian Fellowship Inc.</b></a>
                  <a class ="system"><i>(Event Reservation and Management System)</i></a>        
                  </div>

                  <div class="col-2 d-flex justify-content-right hello"> 
                  <a><b>MY PROFILE</b></a>
                  </div>
            </div>
            <!-- FIRST HEADER NAVIGATION ------------------------------------------------------------------------------------------------------->  
            <!-- SECOND HEADER NAVIGATION ------------------------------------------------------------------------------------------------------>
            <nav class="navbar navbar-expand-lg navigation">
                <div class="container">
                  <a class="navbar-brand" ><?php echo "Date: ".date("m/d/y") ; echo " Time: ".date("h:i:s:a") ;?></a>
                        <ul class="navbar-nav collapse navbar-collapse" id="navbarResponsive">

                              <li class="nav-item">
                              <a class="nav-link" href="adminhome.php">Home</a>
                              </li>

                              <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Accounts</a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="settings.php">Administrator Accounts</a>
                              <a class="dropdown-item" href="members.php">Member Accounts</a>
                              </div>
                              </li>

                              <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="events.php">Administrator Events</a>
                              <a class="dropdown-item" href="memberevents.php">Member Events</a>
                              </div>
                              </li>

                              <li class="nav-item dropdown">
                                <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="adminmyprofile.php">My Profile</a>
                                <a class="dropdown-item" href="adminlogrecords.php">Log Records</a>
                                </li>

                              <li class="nav-item">
                              <a class="nav-link" href="adminmessage.php">Messages</a>
                              </li>
                        </ul>

                       <a class="navbar-brand ml-auto logout" href="logout.php">Logout</a>
                       <a><i>Hello, <?php echo $_SESSION['first_name']; ?></i></a>
                       <button class="btn btn-primary navbar-toggler menugler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        Menu
                        <i class="fa fa-bars"></i>
                        </button>
               </div>
            </nav>
            <!-- SECOND HEADER NAVIGATION ------------------------------------------------------------------------------------------------------>
            </div>

      </header>
<!-- HEADER NAVIGATION ------------------------------------------------------------------------------------------------------------------------->

<div class="main">
<section class="page-section" id="updateaccount">
            <div class="heading">
      <div class='row'>
      <div class='col-4'>
            <h1>MY PROFILE</h1>
      </div>
            <div class='col-4'>
            <button type="button" class="btn btn-primary actions" data-toggle="modal" data-target="#exampleModal">
                Delete
                </button>
      </div>
        <div class='col-4'>
            <button class="btn btn-primary dropdown-toggle actions" data-toggle="collapse" data-target="#addform" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">Edit </button>
      </div>

      </div>

      </div> </section>

      <?php  
    $sql = "SELECT * FROM admins WHERE id='$viewid'";
    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");    
    if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) 
    { 
      $idb= $row['id'];
      $usernameb= $row['username'];
$first_nameb= $row['first_name'];
                                                  $middle_nameb= $row['middle_name'];
                                                  $last_nameb= $row['last_name'];
                                                  $emailb= $row['email'];
                                                  $phoneb= $row['phone'];
                                                  $housestreetb= $row['housestreet'];
                                                  $baranggayb= $row['baranggay'];
                                                  $cityb= $row['city'];
                                                  $provinceb= $row['province'];
                                                  $zpb= $row['zp'];
                                                  $birthdateb= $row['birthdate'];
                                                  $genderb= $row['gender'];
?>
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-id-card"></i></center>
                </div>
                <div class="col-3">
                        ID
                </div>
                <div class="col-7">
                        <p class="datab"><?php echo $idb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-user-circle"></i></center>
                </div>
                <div class="col-3">
                        Username
                </div>
                <div class="col-7">
                        <p class="datab"><?php echo $usernameb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-user"></i></center>
                </div>
                <div class="col-3">
                        Name
                </div>
                <div class="col-7">
                        <p class="datab"><?php echo $first_nameb." ".$middle_nameb." ".$last_nameb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-male"><i class="fa fa-female"></i></i></center>
                </div>
                <div class="col-3">
                        Gender
                </div>
                <div class="col-7">
                        <p class="datab"><?php echo $genderb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-birthday-cake"></i></center>
                </div>
                <div class="col-3">
                        Birthdate
                </div>
                <div class="col-7">
                        <p class="datab"><?php echo $birthdateb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-map-marker"></i></center>
                </div>
                <div class="col-3">
                        Address
                </div>
                <div class="col-7">
                        <p class="datab"><?php echo $housestreetb." ".$baranggayb." ".$cityb." ".$provinceb." ".$zpb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-phone-square"></i></center>
                </div>
                <div class="col-3">
                        Phone No.
                </div>
                <div class="col-7">
                        <p class="datab"><?php echo $phoneb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-envelope"></i></center>
                </div>
                <div class="col-3">
                        E-mail
                </div>
                <div class="col-7">
                        <p class="datab"><?php echo $emailb; ?></p>
                </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a class='btn btn-primary' type='submit' name='delete' value='DELETE' href='deletemyaccount.php?id=<?php echo $idb; ?>&username=<?php echo $usernameb; ?>'>Yes</a>
      </div>
    </div>
  </div>
</div>  
<?php    
} }

?>
              <?php if (isset($_GET['error'])){ ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p class="error"><?php echo $_GET['error']; ?></p>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php } ?>

            <?php if (isset($_GET['success'])){ ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="success"><?php echo $_GET['success']; ?></p>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php } ?>
      <div class="container-fluid
       <?php if (isset($_GET['error'])){ ?> collapse.show<?php }else{ ?>collapse<?php } ?>" id="addform">
<form action="adminmyprofile.php" method="post">

            <div class="row text-left">
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
                        <input class="touppercase" type="text" 
                        name="first_name" 
                        placeholder="First Name"
                        value="<?php echo $_GET['first_name']; ?>"> 
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="first_name" 
                        placeholder="First Name"
                        value="<?php echo $first_name; ?>"> 
                        <?php }?> 
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['middle_name'])) { ?>
                        <input class="touppercase" type="text" 
                        name="middle_name" 
                        placeholder="Middle Name"
                        value="<?php echo $_GET['middle_name']; ?>"> 
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="middle_name" 
                        placeholder="Middle Name"
                        value="<?php echo $middle_name; ?>"> 
                        <?php }?>
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['last_name'])) { ?>
                        <input class="touppercase" type="text" 
                        name="last_name" 
                        placeholder="Last Name"
                        value="<?php echo $_GET['last_name']; ?>"> <br>
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="last_name" 
                        placeholder="Last Name"
                        value="<?php echo $last_name; ?>"> <br>
                        <?php }?>
                  </div>
            </div>

            <div class="row text-left">
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
                        <input class="touppercase" type="number" 
                        name="phone" 
                        placeholder="Phone Number"
                        value="<?php echo $_GET['phone']; ?>"> 
                        <?php }else{ ?>
                        <input class="touppercase" type="number" 
                        name="phone" 
                        placeholder="Phone Number"
                        value="<?php echo $phone; ?>"> 
                        <?php }?> 
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['housestreet'])) { ?>
                        <input class="touppercase" type="text" 
                        name="housestreet" 
                        placeholder="House No. / Street Name"
                        value="<?php echo $_GET['housestreet']; ?>"> <br>
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="housestreet" 
                        placeholder="House No. / Street Name"
                        value="<?php echo $housestreet; ?>"> <br>
                        <?php }?>
                  </div>
            </div>

            <div class="row text-left">
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
                        <input class="touppercase" type="text" 
                        name="baranggay" 
                        placeholder="Baranggay"
                        value="<?php echo $_GET['baranggay']; ?>"> 
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="baranggay" 
                        placeholder="Baranggay"
                        value="<?php echo $baranggay; ?>"> 
                        <?php }?>
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['city'])) { ?>
                        <input class="touppercase" type="text" 
                        name="city" 
                        placeholder="City"
                        value="<?php echo $_GET['city']; ?>"> 
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="city" 
                        placeholder="City"
                        value="<?php echo $city; ?>"> 
                        <?php }?>
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['province'])) { ?>
                        <input class="touppercase" type="text" 
                        name="province" 
                        placeholder="Province"
                        value="<?php echo $_GET['province']; ?>"> <br>
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="province" 
                        placeholder="Province"
                        value="<?php echo $province; ?>"> <br>
                        <?php }?>
                  </div>
            </div>

            <div class="row text-left">
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
                        <input class="touppercase" type="number" 
                        name="zp" 
                        placeholder="ZIP/Postal Code"
                        value="<?php echo $_GET['zp']; ?>"> 
                        <?php }else{ ?>
                        <input class="touppercase" type="number" 
                        name="zp" 
                        placeholder="ZIP/Postal Code"
                        value="<?php echo $zp; ?>"> 
                        <?php }?>
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['birthdate'])) { ?>
                        <input type="date" 
                        id="birthdate"
                        name="birthdate" 
                        value="<?php echo $_GET['birthdate']; ?>"> 
                        <?php }else{ ?>
                        <input type="date" 
                        name="birthdate" 
                        value="<?php echo $birthdate; ?>"> 
                        <?php }?>
                  </div>
                  <div class="col-4 gender">
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

                        <div class="row text-left">
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
                  <div class="col-6">
                        <input class="btn btn-primary btninput" type="submit" name="update" value="UPDATE">
                  </div>
                  <div class="col-6">
                        <input class="btn btn-primary btninput" type="submit" name="updaterefresh" action="adminmyprofile.php" value="REFRESH">
                  </div>
            </div>
</form>            
      </div>

<div class="container-fluid">
        <div class="row">
                <div class="col-1">
                        <h4><center><i class="fa fa-id-card"></i></center></h4>
                </div>
                <div class="col-3">
                        <h4>ID</h4>
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $viewid; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <h4><center><i class="fa fa-user-circle"></i></center></h4>
                </div>
                <div class="col-3">
                        <h4>Username </h4>
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $viewusername; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <h4><center><i class="fa fa-user"></i></center></h4>
                </div>
                <div class="col-3">
                        <h4>Name </h4>
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $viewfirst_name." ".$viewmiddle_name." ".$viewlast_name; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <h4><center><i class="fa fa-male"><i class="fa fa-female"></i></i></center></h4>
                </div>
                <div class="col-3">
                        <h4>Gender </h4>
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $viewgender; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <h4><center><i class="fa fa-birthday-cake"></i></center></h4>
                </div>
                <div class="col-3">
                        <h4>Birthdate </h4>
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $viewbirthdate; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <h4><center><i class="fa fa-map-marker"></i></center></h4>
                </div>
                <div class="col-3">
                        <h4>Address </h4>
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $viewhousestreet." ".$viewbaranggay." ".$viewcity." ".$viewprovince." ".$viewzp; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <h4><center><i class="fa fa-phone-square"></i></center></h4>
                </div>
                <div class="col-3">
                        <h4>Phone No. </h4>
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $viewphone; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <h4><center><i class="fa fa-envelope"></i></center></h4>
                </div>
                <div class="col-3">
                        <h4>E-mail </h4>
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $viewemail; ?></p>
                </div>
        </div>


</div>
</div>



<!-- FOOTER --------------------------------------------------------------------------------------------------------------------------->       
      <footer>
            @SCPCFILaguna:<a class="index" href = "index.php"> Sanctuary of the Chosen People Christian Fellowship Inc.</a><br>
            <nav class="navbar2 navbar-expand-sm">
                  <ul class="navbar-nav centering">

                          <li class="nav-item">
                          <a class="nav-link footlink" href="adminhome.php">Home</a>
                          </li>
                          
                          <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle footlink" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Accounts</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="settings.php">Administrator Accounts</a>
                          <a class="dropdown-item" href="members.php">Member Accounts</a>
                          </li>

                          <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle footlink" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="events.php">Administrator Events</a>
                          <a class="dropdown-item" href="memberevents.php">Member Events</a>
                          </li>

                          <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle footlink" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="adminmyprofile.php">My Profile</a>
                          <a class="dropdown-item" href="adminlogrecords.php">Log Records</a>
                          </li>
                          
                          <li class="nav-item">
                          <a class="nav-link footlink" href="adminmessage.php">Messages</a>
                          </li>

                          <li class="nav-item">
                          <a class="nav-link footlink" href="logout.php">Logout</a>
                          </li>
                  </ul>
            </nav>
      </footer>
<!-- END OF FOOTER ---------------------------------------------------------------------------------------------------------------------------> 
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                     
</body>
</html>
<?php
      
      }
            else
            {
                  header("Location: logout.php");
                  exit();
            }
?>