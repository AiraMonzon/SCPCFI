<?php 
    session_start();
    error_reporting(0);
    if(isset($_SESSION['id']) && isset($_SESSION['username']))
    {
$searchinput ="";
    require 'phpmailer/PHPMailerAutoload.php';
    require'phpmailer/constants.php';
    include "databaseconnection.php";

if(isset($_POST['send_message']))
{

            $i=0;
                $to_email =$selectedemail;
            
                $message =$_POST['message'];
                $subject =$_POST['subject'];
                $my_email = 'zacjohnsons2@gmail.com';

                $user_data = 'subject=' . $subject. '&message=' . $message . '&my_email=' . $my_email . '&to_email=' . $to_email.$size;

    if(empty($subject))
    {
            header("Location: adminmessage.php?error=Subject is required&$user_data");
            exit();
    }
    else if(empty($message))
    {
            header("Location: adminmessage.php?error=Message is required&$user_data");
            exit();
    }
    else if(!isset($_POST['selecttable']))
    {
            header("Location: adminmessage.php?error=Select your recipient below&$user_data");
            exit();          
    } 
    else 
    {
              $selectedarray= array();
        foreach($_POST['selecttable'] as $selectedemail){ 
            $to_email =$selectedemail;
        $selectedarray[] = $selectedemail;

        }
        $size = sizeof($selectedarray);

        foreach($_POST['selecttable'] as $selectedemail) 
        {
            $to_email =$selectedemail;
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
        $mail->SetFrom($my_email, 'SCPCFI');
        $mail->AddAddress($to_email);
        $mail->addReplyTo($my_email, 'SCPCFI');   
        $mail->Subject = $subject;
        $mail->Body="$message<br><a href=http://localhost/scpcficlean/index.php>CLICK LINK</a>";
        $mail->SMTPOptions = array(
            'ssl' => [
                'verify_peer' => false,
                'verify_depth' => false,
                'allow_self_signed' => false,
                'verify_peer_name' => false
            ]
        );


       if (!$mail->send()) {
            header("Location: adminmessage.php?error=Please enter valid email address&$my_email");
                                exit();
        } 


        
      
        }
           
    }
}

               if (isset($_POST['search'])) 
        {
                $searchinput = $_POST['searchinput'];

                if(!empty($searchinput))
                {

                $sql2log_record = "SELECT * FROM users WHERE email LIKE '%$searchinput%'";
                $result2log_record = mysqli_query($database_connection, $sql2log_record) or die("Bad Query: $sql");

                
                if(mysqli_num_rows($result2log_record)){

                        $searchsuccess = "Found ". mysqli_num_rows($result2log_record)." records successfully!";
                }
                 else{
                    $searchsuccess="";
                         header("Location: adminmessage.php?searcherror=The email is not existing&#searchemail");
                    exit();
                }
                }

                else{
                    $searchsuccess="";
                        header("Location: adminmessage.php?searcherror=Search bar is empty&#searchemail");
                    exit();
                }

        } 

          if(isset($_POST['selecttablebtn'])){
            $searchinput = $_POST['searchinput'];
          }

if(isset($_POST['done']))
{
    $upstatus = "Read"; 
    $sql2= "UPDATE messages SET status='$upstatus' WHERE id ='$_GET[id]'";
            $result2= mysqli_query($database_connection, $sql2);
                                                    if($result2)
                                        {
                                                        $log_username = $_SESSION['username'];
                                                        $log_activity = "Read"; 
                                                        $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$_GET[id]')";
                                                        $result3= mysqli_query($database_connection, $sql3);

                                                header("Location: adminmessage.php");
                                        exit();
                                        }
                                        else
                                        {
                                                header("Location: adminmessage.php?error=Unknown error occurred");
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/adminmessageD.css"/>
        <title>Admin Messages | SCPCFI</title>

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
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="adminmyprofile.php">My Profile</a>
                                <a class="dropdown-item" href="adminlogrecords.php">Log Records</a>
                                </li>

                              <li class="nav-item">
                              <a class="nav-link active" href="adminmessage.php">Messages</a>
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
      <div class='col-4'>
        <input class="btn btn-primary actions" type="submit" name="send_message" value="Send Email"/>
      </div>
      
      </div>
      </div> </section>
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
                value=""  maxlength="250"><?php echo $_GET['message']; ?></textarea>
                </div>
                <?php }else{ ?>
                <div class="form-group">

                <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="message" 
                placeholder="Enter message";
                value=""  maxlength="250"></textarea>
                </div>
                <?php }?>

                          <div class="headingb" id="searchemail">
                              <div class='row'>
                              <div class='col-7'>
                                <label>Send to:</label>
                                    <h1>EMAIL ADDRESS</h1>
                              </div>

                            <div class='col-5'>
                                <div class="float-right"><label>Search or select receivers</label></div>
                            <div class="input-group">
                                  <?php if (isset($_GET['searchinput'])) { ?>
                                  <input class="form-control" type="text" 
                                  name="searchinput" 
                                  placeholder="Enter email address . . .";
                                  value="<?php echo $_GET['searchinput']; ?>">
                                  <?php }else{ ?>
                                  <input class="form-control" type="text" 
                                  name="searchinput" 
                                  placeholder="Enter email address . . ."
                                  value="<?php echo $searchinput; ?>">
                                  <?php }?>

                                  <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" name="search" value="SEARCH">
                                          <i class="fa fa-search"></i>
                                        </button>
                                  </div>
                            </div>        
                            </div>
                              </div>
                              </div> 

                                      <?php if (isset($_GET['searcherror']) && empty($searchsuccess) && !isset($_POST['send_message'])){ ?>
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <p class="searcherror"><?php echo $_GET['searcherror']; ?></p>
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <?php } ?>
                                    <?php if (isset($searchsuccess)){ ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <p class="success"><?php echo $searchsuccess; ?></p>
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <?php } ?>  

                                                    
                              <?php
//TABLE
if (isset($_POST['search'])) 
{
        $searchinput = $_POST['searchinput'];
    if(!empty($searchinput))
    {

        $sql= "SELECT * FROM users WHERE email LIKE '%$searchinput%'";
        $result= mysqli_query($database_connection, $sql);

        if (mysqli_num_rows($result) > 0) 
        {
                echo "<div class='container-fluid table'><table>";
        echo "<thead><th>Username</th><th>Name</th><th>E-mail</th><th><button  class='btn btn-primary actions' type='submit' name='selecttablebtn'>Select All</button></th></thead>";

                while ($row = mysqli_fetch_assoc($result)) 
                {
                          echo "<tr class='infos'><td>{$row['username']}</td><td>{$row['first_name']} {$row['middle_name']} {$row['last_name']}</td><td>{$row['email']}</td><td class='checkboxtd'><div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' value='{$row['email']}' name='selecttable[]'"; 

        if(isset($_POST['selecttablebtn'])){
           echo "checked";  
        }else{
            echo "unchecked"; 
        }
        


        echo"></div></td></tr>";


        }

        echo "</table></div>";
        }
    }

}
else
{
        $sql = "SELECT * FROM users";
        $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

        echo "<div class='container-fluid table'><table>";
        echo "<thead><th>Username</th><th>Name</th><th>E-mail</th><th><button  class='btn btn-primary actions' type='submit' name='selecttablebtn'>Select All</button></th></thead>";

        while ($row = mysqli_fetch_assoc($result)) 
        {
        echo "<tr class='infos'><td>{$row['username']}</td><td>{$row['first_name']} {$row['middle_name']} {$row['last_name']}</td><td>{$row['email']}</td><td class='checkboxtd'><div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' value='{$row['email']}' name='selecttable[]'"; 

        if(isset($_POST['selecttablebtn'])){
           echo "checked";  
        }else{
            echo "unchecked"; 
        }
        


        echo"></div></td></tr>";


        }

        echo "</table></div>";
}
?>

                
          
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
    $sql = "SELECT * FROM messages WHERE sender='member'";
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
           onclick="window.location='adminmessageview.php?id=<?php echo $id; ?>'"><td class='col-3'><strong><?php if (strlen($subject) > 30){
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
    <center><p>You have no messages from members!</p></center>
        <?php
}
?>
    </table></div></div>

      <section class="page-section" id="addaccount">
          <div class="heading">
      <div class='row'>
      <div class='col-12'>
            <h1>SENT</h1>
      </div>
      
      </div>
      </div> </section>
      <div class='container-fluid table'><div class='container-fluid'><table>

<?php
    $session_username = $_SESSION['username'];
    $sql = "SELECT * FROM messages WHERE sender='SCPCFI' AND from_username='$session_username'";
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
           onclick="window.location='adminmessagesentview.php?id=<?php echo $id; ?>'"><td class='col-3'><strong><?php if (strlen($subject) > 30){
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


<!-- FOOTER ----------------------------------------------------------------------------------------------------------------------->       
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
      </footer><!-- Button trigger modal -->

<!-- END OF FOOTER -----------------------------------------------------------------------------------------------------------------> 
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