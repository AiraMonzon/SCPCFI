<?php 
    session_start();
    error_reporting(0);
    include 'databaseconnection.php';
    if(isset($_SESSION['id']) && isset($_SESSION['username']))
    {




$id = $_GET['id'];
$sql = "SELECT * FROM messages WHERE id='$id'";
$result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");
                                      if(mysqli_num_rows($result))
                                      {
                                            while($row = mysqli_fetch_array($result))
                                            {
$id= $row['id'];
      $subject= $row['subject'];
      $message= $row['message'];
      $date= $row['date'];
      $time= $row['time'];
      $status= $row['status'];
      $from_username= $row['from_username'];


                                                  
                                                 
                                            }
                                      }


         if(isset($_POST['send_message']))
            {

                function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }

                $replymessage =$_POST['replymessage'];

                $user_data = 'replymessage=' . $replymessage;

                if(empty($replymessage)){
                        header("Location: usermessagesentview.php?error=Message is required&id=$id&$user_data");
                        exit();
                }
                else
                {
                    $status = "Unread";
                    $sender = "SCPCFI";
                    $replyfrom_username = $_SESSION['username'];
                        $sql2= "INSERT INTO messages(reply_id, subject, message, from_username, to_username, status, sender) VALUES('$id','$subject', '$replymessage', '$replyfrom_username', '$from_username', '$status', '$sender')";

                        $result2= mysqli_query($database_connection, $sql2);

                        if($result2)
                        {
                                        $log_username = $_SESSION['username'];
                                        $log_activity = "Send Message"; 
                                        $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$subject')";
                                        $result3= mysqli_query($database_connection, $sql3);

                                header("Location: usermessagesentview.php?id=$id&addsuccess=Message has been sent successfully");
                        exit();
                        }
                        else
                        {
                                header("Location: usermessagesentview.php?id=$id&adderror=Unknown error occurred&$user_data");
                        exit();
                        }
                     
                }
            }       
if(isset($_POST['delete']))
            {
                $sql= "SELECT * FROM messages WHERE id= '$id'";
                              $result= mysqli_query($database_connection, $sql);

                             if (mysqli_num_rows($result) > 0) 
                             {
                                              
                                              $sql2 = "DELETE FROM messages WHERE id ='$id' ";
                                              $result2 = mysqli_query($database_connection, $sql2);

                                              if($result2)
                                              {
                                                $log_username = $_SESSION['username'];
                                                $log_activity = "Delete Message"; 
                                                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$username')";
                                                $result3= mysqli_query($database_connection, $sql3);
                                                header("Location: usermessage.php?success=Delete successfully");
                                        exit();
                                               }
                                              else
                                              {
                                              header("Location: usermessagesentview.php?error=Unknown error occurred&$user_data");
                                        exit();
                                              } 
                                }     
                                else
                                     {


                              header("Location: usermessagesentview.php?error=The ID is not existing&$user_data");
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
                              <a class="dropdown-item" href="userviewmemberevents.php">Member Events</a>
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
      <div class='col-10'>
            <h1><?php echo $subject; ?></h1>
      </div>
      <div class='col-2'>
        <button class="btn btn-primary float-right" type="button" onclick="window.print();">
         <i class="fa fa-print" aria-hidden="true"></i>
        </button><button class="btn btn-primary float-right"  type="button" data-toggle="modal" data-target="#deletemodal">
           <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
      </div>
      </div>
      </div> </section>
      <!-- Modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <strong><?php echo $subject; ?></strong> Sent by: <?php echo $from_username." on ".$date." ".$time; ?> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary" name="delete">Yes</button>
      </div>
    </div>
  </div>
</div>
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



  <div class="container-fluid">
      <div class="container collapse" id="reply">
          
                          <div class="headingb" id="replyheadb">
                              <div class='row'>
                              <div class='col-8'>
                                    <h1>REPLY</h1>
                              </div>
                              <div class='col-4'>
                                <input class="btn btn-primary actions" type="submit" name="send_message" value="Send"/> 
                              </div>
                              </div>
                              </div> 


                
                <?php if (isset($_GET['replymessage'])) { ?>
                <div class="form-group">

                <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="replymessage" 
                placeholder="Enter message";
                value="" ><?php echo $_GET['replymessage']; ?></textarea>
                </div>
                <?php }else{ ?>
                <div class="form-group">

                <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="replymessage" 
                placeholder="Enter message";
                value="" ></textarea>
                </div>
                <?php }?>       
  </div>
  <div class='container'>
      <div class="row">
        <strong><p class="replydatetime"><i class="fa fa-envelope" aria-hidden="true"></i> Sent by: <?php echo $from_username." ".$date." ".$time." ".$status; ?></p></strong>
    </div>
    <div class="row">
        <p><?php echo $message; ?></p>
    </div>
       </div>
  </div>
    <section class="page-section" id="addaccount">

<div class="heading" id="replylist">
                              <div class='row'>
                              <div class='col-9'>
                                    <h1>REPLIES</h1>
                              </div>

                              </div>
                              </div> </section><div class='container-fluid'>
<?php
    $session_username = $_SESSION['username'];
    $sql = "SELECT * FROM messages WHERE reply_id= '$_GET[id]'";
    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) 
{ 
      $replyid= $row['reply_id'];
      $replysubject= $row['subject'];
      $replymessage= $row['message'];
      $replydate= $row['date'];
      $replytime= $row['time'];
      $replystatus= $row['status'];
      $replyfrom_usernameb= $row['from_username'];
?>


<div class='container'>
    <div class="row">
        <strong><p class="replydatetime"><i class="fa fa-reply" aria-hidden="true"></i> Replied by: <?php echo "(".$replyfrom_usernameb.") ".$replydate." ".$replytime." ".$replystatus; ?></p></strong>
    </div>
    <div class="row">
        <p><?php echo $replymessage; ?></p>
    </div>
</div>

<?php    
} }else{ ?>
    <div class='container'><center><p>You have no sent messages!</p></center></div>
        <?php
}
?>

</div>
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
                    <a class="dropdown-item" href="userviewmemberevents.php">Member Events</a>
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