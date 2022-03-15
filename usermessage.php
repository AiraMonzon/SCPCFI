<?php 
    session_start();
    error_reporting(0);
    include 'databaseconnection.php';
    if(isset($_SESSION['id']) && isset($_SESSION['username']))
    {

        if(isset($_POST['send_message']))
            {

                function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }

                $subject = validate ($_POST['subject']);
                $message =$_POST['message'];

                $user_data = 'subject=' . $subject. '&message=' . $message;

                if(empty($subject)){
                        header("Location: usermessage.php?error=Subject is required&$user_data");
                        exit();
                }
                else if(empty($message)){
                        header("Location: usermessage.php?error=Message is required&$user_data");
                        exit();
                }
                else
                {
                    $status = "Unread";
                    $sender ="member";
                    $to_username = "SCPCFI";
                        $sql2= "INSERT INTO messages(subject, message, from_username, to_username, status, sender) VALUES('$subject', '$message', '$_SESSION[username]', '$to_username', '$status', '$sender')";

                        $result2= mysqli_query($database_connection, $sql2);

                        if($result2)
                        {
                                        $log_username = $_SESSION['username'];
                                        $log_activity = "Send Message"; 
                                        $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$subject')";
                                        $result3= mysqli_query($database_connection, $sql3);

                                header("Location: usermessage.php?addsuccess=Message has been sent successfully");
                        exit();
                        }
                        else
                        {
                                header("Location: usermessage.php?adderror=Unknown error occurred&$user_data");
                        exit();
                        }
                     
                }
            }

                        $search_query13= "SELECT * FROM admins WHERE username= '$updateinput'";
                                $search_result13= mysqli_query($database_connection, $search_query13);
                                                  if(mysqli_num_rows($search_result13))
                                      {
                                            while($row = mysqli_fetch_array($search_result13))
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
        <link rel="stylesheet" href="css/adminmessageD.css"/>
        <title>User Messages | SCPCFI</title>
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
                  <a><b>MESSAGES</b></a>
                  </div>
            </div>
            <!-- FIRST HEADER NAVIGATION ------------------------------------------------------------------------------------------------------->  
            <!-- SECOND HEADER NAVIGATION ------------------------------------------------------------------------------------------------------>
            <nav class="navbar navbar-expand-lg navigation">
                  <div class="container">
                  <a class="navbar-brand" ><?php echo "Date: ".date("m/d/y") ; echo " Time: ".date("h:i:s:a") ;?></a>


                        <ul class="navbar-nav collapse navbar-collapse" id="navbarResponsive">

                              <li class="nav-item">
                              <a class="nav-link" href="userhome.php">Home</a>
                              </li>

                              <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="userviewchurchevents.php">Church Events</a>
                              <a class="dropdown-item" href="userevents.php">My Events</a>
                              </div>
                              </li>

                              <li class="nav-item">
                                <a class="nav-link" href="usersettings.php">My Profile</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link active" href="usermessage.php">Messages</a>
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
<!-- MAIN -------------------------------------------------------------------------------------------------------------------------->
  <div class="main">
    <form method="post">
    <section class="page-section" id="addaccount">
          <div class="heading">
      <div class='row'>
      <div class='col-8'>
            <h1>MESSAGES</h1>
      </div>
      
      </div>
      </div> </section>
              <?php if (isset($_GET['adderror']) && empty($searchsuccess)  && !isset($_GET['success']) && empty($_POST['selecttable'])){ ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p class="error"><?php echo $_GET['adderror']; ?></p>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <?php } ?>
        <?php if (isset($_GET['addsuccess'])){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p class="success"><?php echo $_GET['addsuccess']; ?></p>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <?php } ?> 
              <?php if (isset($_GET['error']) && empty($searchsuccess)  && !isset($_GET['success']) && empty($_POST['selecttable'])){ ?>
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

                                <?php if(isset($_POST['send_message']))
                                {//to run PHP script on submit
                                    if(!empty($_POST['selecttable'])){// Loop to store and display values of individual checked checkbox.?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <p class="success"><?php   echo "Message sent to:"; foreach($_POST['selecttable'] as $checksuccess){ ?>
                                    
                                    <p class="success"><?php echo $checksuccess; ?>
                                    </p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    
                                    <?php } ?></p>
                                    </div>
                                    <?php } } ?>
  <div class="container-fluid">
          

                <label>Subject:</label>
                <?php if (isset($_GET['subject'])) { ?>
                    <input class="subject" type="text"
                            name="subject" 
                            placeholder="Enter subject";
                            value="<?php echo $_GET['subject']; ?>"> 
                <?php }else{ ?>
                    <input class="subject" type="text"
                            name="subject" 
                            placeholder="Enter subject"
                            value=""> 
                <?php }?>

                <label for="exampleFormControlTextarea2">Message:</label>
                <?php if (isset($_GET['message'])) { ?>
                <div class="form-group">

                <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="message" 
                placeholder="Enter message";
                value="" ><?php echo $_GET['message']; ?></textarea>
                </div>
                <?php }else{ ?>
                <div class="form-group">

                <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="message" 
                placeholder="Enter message";
                value="" ></textarea>
                </div>
                <?php }?>

                 <input class="btn btn-primary actions" type="submit" name="send_message" value="Send"/>         

                            
                
          
  </div>

<section class="page-section" id="addaccount">
          <div class="heading">
      <div class='row'>
      <div class='col-8'>
            <h1>INBOX</h1>
      </div>
      
      </div>
      </div> </section>
      <div class='container-fluid table'><div class='container-fluid'><table>

<?php
    $session_username = $_SESSION['username'];
    $sql = "SELECT * FROM messages WHERE sender='SCPCFI' AND to_username='$session_username'";
    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) 
{ 
      $id= $row['id'];
      $subject= $row['subject'];
      $message= $row['message'];
      $date= $row['date'];
      $time= $row['time'];
      $status= $row['status'];
      $from_username= $row['from_username'];
?>
 <tr class="clickable "
           onclick="window.location='usermessageview.php?id=<?php echo $id; ?>'"><td class='col-3'><strong><?php if (strlen($subject) > 30){
            $new_subject = substr($subject, 0, 30); echo $new_subject;
        }else{
            echo $subject;
        }
        ?></strong></td><td class='col-4'><?php  if (strlen($message) > 40){
        $new_message = substr($message, 0, 40) . ' ...'; echo $new_message;
       }else{
        echo $message;
       }
        ?></td><td class='col-2'><?php echo $from_username; ?></td><td class='col-2'><?php echo $date ." ". $time; ?></td><td class='col-1'><?php echo $status; ?></td></tr>



<?php    
} }else{ ?>
    <center><p>You have no messages from us!</p></center>
        <?php
}
?>
    </table></div></div>
      <section class="page-section" id="addaccount">
          <div class="heading">
      <div class='row'>
      <div class='col-8'>
            <h1>SENT</h1>
      </div>
      
      </div>
      </div> </section>

    <div class='container-fluid table'><div class='container-fluid'><table>

<?php
    $session_username = $_SESSION['username'];
    $sql = "SELECT * FROM messages WHERE from_username= '$session_username' AND sender='member'";
    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) 
{ 
      $id= $row['id'];
      $subject= $row['subject'];
      $message= $row['message'];
      $date= $row['date'];
      $time= $row['time'];
      $status= $row['status'];
      $from_username= $row['from_username'];
?>
        <tr class="clickable "
           onclick="window.location='usermessagesentview.php?id=<?php echo $id; ?>'"><td class='col-3'><strong><?php if (strlen($subject) > 30){
            $new_subject = substr($subject, 0, 30); echo $new_subject;
        }else{
            echo $subject;
        }
        ?></strong></td><td class='col-4'><?php  if (strlen($message) > 40){
        $new_message = substr($message, 0, 40) . ' ...'; echo $new_message;
       }else{
        echo $message;
       }
        ?></td><td class='col-2'><?php echo $from_username; ?></td><td class='col-2'><?php echo $date ." ". $time; ?></td><td class='col-1'><?php echo $status; ?></td></tr>

<?php    
} }else{ ?>
    <center><p>You have no sent messages!</p></center>
        <?php
}
?>
    </table></div></div>

</form>
</div>

<!-- END OF MAIN ------------------------------------------------------------------------------------------------------------------->
  <!-- FOOTER --------------------------------------------------------------------------------------------------------------------------->       
<footer>
      @SCPCFILaguna:<a class="index" href = "index.php"> Sanctuary of the Chosen People Christian Fellowship Inc.</a><br>
      <nav class="navbar2 navbar-expand-sm">
            <ul class="navbar-nav centering">
                    <li class="nav-item">
                    <a class="nav-link footlink" href="userhome.php">Home</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle footlink" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="userviewchurchevents.php">Church Events</a>
                    <a class="dropdown-item" href="userevents.php">My Events</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link footlink" href="usersettings.php">My Profile</a>
                    </li>
                    
                    <li class="nav-item">
                    <a class="nav-link footlink" href="usermessage.php">Messages</a>
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