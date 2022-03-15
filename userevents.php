<?php 
      session_start();

      if(isset($_SESSION['id']) && isset($_SESSION['username']))
      {
?>
<?php

            include 'databaseconnection.php';

            $id= "";
            $event_name = "";
            $event_date = "";
            $event_start_time = "";
            $event_end_time = "";  
            $event_slot = "";   
            $description_purpose = "";     
            $addid= "";
            $addevent_name = "";
            $addevent_date = "";
            $addevent_start_time = "";
            $addevent_end_time = "";  
            $addevent_slot = "";   
            $adddescription_purpose = "";
                        $updateid= "";
            $updateevent_name = "";
            $updateevent_date = "";
            $updateevent_start_time = "";
            $updateevent_end_time = "";  
            $updateevent_slot = "";   
            $updatedescription_purpose = ""; 
            

            function getPosts()
            {
                  $posts= array();
                  $posts[0]= $_POST['id'];
                  $posts[1]= $_POST['event_name'];
                  $posts[2]= $_POST['event_date'];
                  $posts[3]= $_POST['event_start_time'];
                  $posts[4]= $_POST['event_end_time'];
                  $posts[5]= $_POST['event_slot'];
                  $posts[6]= $_POST['description_purpose'];
             
                  return $posts;
            }

$searchinput="";
if (isset($_POST['search'])) 
{
                $searchinput = $_POST['searchinput'];

                if(!empty($searchinput))
                {
                        $log_activity = "Search My Event"; 
                              $log_username = $_SESSION['username'];
                $sqlusername= "SELECT * FROM user_event WHERE username='$_SESSION[username]'";
                $resultusername= mysqli_query($database_connection, $sqlusername);
                $sqlevent_name ="SELECT * FROM user_event WHERE event_name LIKE '%$searchinput%' AND username='$_SESSION[username]'";
                $resultevent_name = mysqli_query($database_connection, $sqlevent_name) or die("Bad Query: $sql");

                $sqlid ="SELECT * FROM user_event WHERE id LIKE '$searchinput' AND username='$_SESSION[username]'";
                $resultid = mysqli_query($database_connection, $sqlid) or die("Bad Query: $sql");
                if (mysqli_num_rows($resultevent_name) > 0) {
                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$searchinput')";
                $result3= mysqli_query($database_connection, $sql3);
                
                if(mysqli_num_rows($resultevent_name) ==1)
                {
                   
                    $searchsuccess = "Found ". mysqli_num_rows($resultevent_name)." record successfully!";
                }
                else
                {
                    
                    $searchsuccess = "Found ". mysqli_num_rows($resultevent_name)." records successfully!";
                }
                }
                else if (mysqli_num_rows($resultid) > 0) {
                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$searchinput')";
                $result3= mysqli_query($database_connection, $sql3);
                
                if(mysqli_num_rows($resultid) ==1)
                {
                   
                    $searchsuccess = "Found ". mysqli_num_rows($resultid)." record successfully!";
                }
                else
                {
                    
                    $searchsuccess = "Found ". mysqli_num_rows($resultid)." records successfully!";
                }
                }
                else
                {

                header("Location: userevents.php?searcherror=The data is not existing&#listevent");
                exit();
                }
                 
                }

                else
                {

               header("Location: userevents.php?searcherror=Search bar is empty&#listevent");
            exit();
                }   
                 
                }


//TO ADD
            if(isset($_POST['add']))
            {
                 
                  
                        if (isset($_POST['event_name']) && isset($_POST['event_date']) && isset($_POST['event_start_time']) && isset($_POST['event_end_time']) && isset($_POST['event_slot']) && isset($_POST['description_purpose'])) {

                function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }
                
                $addevent_name = validate ($_POST['event_name']);
                $addevent_date = validate ($_POST['event_date']);
                $addevent_start_time= validate ($_POST['event_start_time']);
                $addevent_end_time= validate ($_POST['event_end_time']);
                $addevent_slot= validate ($_POST['event_slot']);
                $adddescription_purpose= validate ($_POST['description_purpose']);

                
                $user_data = 'addevent_name=' . $addevent_name. '&addevent_date=' . $addevent_date . '&addevent_start_time=' . $addevent_start_time . '&addevent_end_time=' . $addevent_end_time . '&addevent_slot=' . $addevent_slot . '&adddescription_purpose=' . $adddescription_purpose;

                if(empty($addevent_name)){
                        header("Location: userevents.php?adderror=Event Name is required&$user_data");
                        exit();
                }
                else if(empty($addevent_date)){
                        header("Location: userevents.php?adderror=Event Date is required&$user_data");
                        exit();
                }
                else if(empty($addevent_start_time)){
                        header("Location: userevents.php?adderror=Event Start Time is required&$user_data");
                        exit();
                }
                else if(empty($addevent_end_time)){
                        header("Location: userevents.php?adderror=Event End Time is required&$user_data");
                        exit();
                }
                else if(empty($addevent_slot)){
                        header("Location: userevents.php?adderror=Event Slot is required&$user_data");
                        exit();
                }
                


                else
                {
                                $sql2= "INSERT INTO user_event(event_name, event_date, event_start_time, event_end_time, event_slot , description_purpose, username) VALUES('$addevent_name', '$addevent_date', '$addevent_start_time','$addevent_end_time','$addevent_slot','$adddescription_purpose','$_SESSION[username]')";

                                $result2= mysqli_query($database_connection, $sql2);

                                if($result2)
                                {
                                        header("Location: userevents.php?addsuccess=Event has been created successfully");
                                exit();
                                }
                                else
                                {
                                        header("Location: userevents.php?adderror=Unknown error occurred&$user_data");
                                exit();
                                }
                               
                        
                       
                }

        }else{
                header("Location: userevents.php");
                exit();
        }
            }
        if(isset($_POST['addrefresh']))
        {
              header("Location: events.php?#addevent");
              exit();
        }  

        //TO SEARCH AND UPDATE
            if(isset($_POST['searchtoupdate']))
            {
                        $updateid = $_POST['updateid'];
                $sqlid ="SELECT * FROM user_event WHERE id LIKE '$updateid' AND username='$_SESSION[username]'";
                $resultid = mysqli_query($database_connection, $sqlid) or die("Bad Query: $sql");
                              
                              if(mysqli_num_rows($resultid))
                              {
                                    while($row = mysqli_fetch_array($resultid))
                                    {
                                          $updateid= $row['id'];
                                          $updateevent_name= $row['event_name'];
                                          $updateevent_date= $row['event_date'];
                                        $updateevent_start_time= $row['event_start_time'];
                                        $updateevent_end_time= $row['event_end_time'];
                                          $updateevent_slot= $row['event_slot'];
                                        $updatedescription_purpose= $row['description_purpose'];   
                                    }
                              }

                              else
                              {
                                    header("Location: userevents.php?updateerror=The ID is not existing&updateid=$updateid");
                                        exit();
                              }

                         
                             
            }

//TO UPDATE
if(isset($_POST['update']))
            {
              
                  
                    

                function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }
                $id = validate ($_POST['updateid']);
                $event_name = validate ($_POST['event_name']);
                $event_date = validate ($_POST['event_date']);
                $event_start_time= validate ($_POST['event_start_time']);
                $event_end_time= validate ($_POST['event_end_time']);
                $event_slot= validate ($_POST['event_slot']);
                $description_purpose= validate ($_POST['description_purpose']);

                
                $user_data = 'event_name=' . $event_name. '&event_date=' . $event_date . '&event_start_time=' . $event_start_time . '&event_end_time=' . $event_end_time . '&event_slot=' . $event_slot . '&description_purpose=' . $description_purpose;
                if(empty($event_name)){
                        header("Location: userevents.php?updateerror=Event Name is required&$user_data");
                        exit();
                }
                else if(empty($event_date)){
                        header("Location: userevents.php?updateerror=Event Date is required&$user_data");
                        exit();
                }
                else if(empty($event_start_time)){
                        header("Location: userevents.php?updateerror=Event Start Time is required&$user_data");
                        exit();
                }
                else if(empty($event_end_time)){
                        header("Location: userevents.php?updateerror=Event End Time is required&$user_data");
                        exit();
                }
                else if(empty($event_slot)){
                        header("Location: userevents.php?updateerror=Event Slot is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[0-9]+$/", $event_slot)){
                        header("Location: userevents.php?updateerror=Event Slot must contain numbers from 1-250&$user_data");
                        exit();
                }
                else if($event_slot <1){
                        header("Location: userevents.php?updateerror=Event Slot is not less than 1 &$user_data");
                        exit();
                }
                else if($event_slot >250){
                        header("Location: userevents.php?updateerror=Event Slot is not more than 250&$user_data");
                        exit();
                }
                


                else{
                        
                        
                        $sql= "SELECT * FROM user_event WHERE id= '$_POST[updateid]'";
                        $result= mysqli_query($database_connection, $sql);

                          
                       if (mysqli_num_rows($result) > 0) 
                       {
                       
                        $sql2= "UPDATE user_event SET event_name='$_POST[event_name]',event_date='$_POST[event_date]',event_start_time='$_POST[event_start_time]',event_end_time='$_POST[event_end_time]',event_slot='$_POST[event_slot]',description_purpose='$_POST[description_purpose]' WHERE id ='$_POST[updateid]'";

                        $result2= mysqli_query($database_connection, $sql2);

                                        if($result2)
                                        {

                                                header("Location: userevents.php?updatesuccess=Event has been updated successfully");
                                        exit();
                                        }
                                        else
                                        {
                                                header("Location: userevents.php?updateerror=Unknown error occurred&$user_data");
                                        exit();
                                        }                        
                       } 

                       else
                       {
                                        header("Location: userevents.php?updateerror=The id is not existing&$user_data");
                        exit();
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
      <link rel="stylesheet" href="css/userchurcheventsB.css">
      <title>Member My Events | SCPCFI</title>
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
                  <a><b>EVENTS</b></a>
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
                              <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="userviewchurchevents.php">Church Events</a>
                              <a class="dropdown-item" href="userevents.php">My Events</a>
                              </div>
                              </li>

                              <li class="nav-item">
                                <a class="nav-link" href="usersettings.php">My Profile</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="usermessage.php">Messages</a>
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

<!-- MAIN -------------------------------------------------------------------------------------------------------------------------------------->
<div class="main">
        <section class="page-section" id="addevent">
        <div class="heading">
                <div class='row'>
                <div class='col-8'>
                    <h1>ADD NEW EVENT</h1>
                </div>
                <div class='col-4'>
                    <button class="btn btn-primary dropdown-toggle actions" data-toggle="collapse" data-target="#addform" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">Open Form</button>
                </div>

                </div>
        </div> </section>

        <?php if (isset($_GET['adderror'])){ ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p class="adderror"><?php echo $_GET['adderror']; ?></p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
        <?php } ?>
        <?php if (isset($_GET['addsuccess'])){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p class="addsuccess"><?php echo $_GET['addsuccess']; ?></p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
        <?php } ?>  
     
         <div class="container-fluid <?php if (isset($_GET['adderror'])){ ?> collapse.show<?php }else{ ?>collapse<?php } ?>" id="addform">
        <form action="userevents.php" method="post">

              <label>Event Name</label>
                <?php if (isset($_GET['addevent_name'])) { ?>
              <select id="event_name" name="event_name">    
               <option value="<?php echo $_GET['addevent_name']; ?>"><?php echo $_GET['addevent_name']; ?></option>
               <option value="BAPTISM">BAPTISM</option>
               <option value="CONFIRMATION">CONFIRMATION</option>
               <option value="RECONCILIATION">RECONCILIATION</option>
               <option value="ANOINTING OF THE SICK">ANOINTING OF THE SICK</option>
               <option value="MARRIAGE">MARRIAGE</option>
               <option value="ORDINATION">ORDINATION</option>
               </select>
               <?php }else{ ?>
              <select id="event_name" name="event_name" >
               <option value="<?php echo $addevent_name; ?>"><?php echo $addevent_name; ?></option>
               <option value="BAPTISM">BAPTISM</option>
               <option value="CONFIRMATION">CONFIRMATION</option>
               <option value="RECONCILIATION">RECONCILIATION</option>
               <option value="ANOINTING OF THE SICK">ANOINTING OF THE SICK</option>
               <option value="MARRIAGE">MARRIAGE</option>
               <option value="ORDINATION">ORDINATION</option>
               </select>
               <?php }?>
              
              
              <label>Event Date</label>
              <?php if (isset($_GET['addevent_date'])) { ?>
                  <input type="date" 
                          id="event_date"
                          name="event_date" 
                          value="<?php echo $_GET['addevent_date']; ?>"> <br>
              <?php }else{ ?>
                  <input type="date" 
                          name="event_date" 
                          value="<?php echo $addevent_date; ?>"> <br>
              <?php }?>
              
              <label>Event Start Time</label>
            
              <?php if (isset($_GET['addevent_start_time'])) { ?>
                  <input type="time" 
                          name="event_start_time" 
                          placeholder="Event time"
                          value="<?php echo $_GET['addevent_start_time']; ?>"> 
              <?php }else{ ?>
                  <input type="time" 
                          name="event_start_time" 
                          placeholder="Event time"
                          value="<?php echo $addevent_start_time; ?>"> 
              <?php }?> 
              <label>Event End Time</label>
              <?php if (isset($_GET['addevent_end_time'])) { ?>
                  <input type="time" 
                          name="event_end_time" 
                          placeholder="Event time"
                          value="<?php echo $_GET['addevent_end_time']; ?>"> <br>
              <?php }else{ ?>
                  <input type="time" 
                          name="event_end_time" 
                          placeholder="Event time"
                          value="<?php echo $addevent_end_time; ?>"> <br> 
              <?php }?> 

              <label>Event Slot</label>
              <?php if (isset($_GET['addevent_slot'])) { ?>
                  <input type="number" 
                          name="event_slot" 
                          placeholder="Event slot"
                          value="<?php echo ($_GET['addevent_slot']); ?>"> 
              <?php }else{ ?>
                  <input type="number" 
                          name="event_slot" 
                          placeholder="Event slot"
                          value="<?php echo $addevent_slot; ?>"> 
              <?php }?> 

              <label>Event Description/Purpose</label>
                <?php if (isset($_GET['adddescription_purpose'])) { ?>
                  <input class="desc" type="text" 
                          name="description_purpose" 
                          placeholder="Description/Purpose"
                          value="<?php echo ($_GET['adddescription_purpose']); ?>"> 
              <?php }else{ ?>
                  <input class="desc" type="text" 
                          name="description_purpose" 
                          placeholder="Description/Purpose"
                          value="<?php echo $adddescription_purpose; ?>"> 
              <?php }?>    

                <div class="row">
                        <div class="col-6">
                                <input class="btn btn-primary btninput" type="submit" name="add" value="ADD">
                        </div>
                        <div class="col-6">
                                <input class="btn btn-primary btninput" type="submit" name="addrefresh" action="userevents.php" value="REFRESH">
                        </div>
                </div>
        </form> 
        </div>
<form action="userevents.php" method="post">
                <section class="page-section" id="updateevent">
                <div class="heading">
                        <div class='row'>
                                <div class='col-7'>
                                <h1>UPDATE EVENT</h1>
                                </div>
                                <div class='col-5'>
                                <div class="input-group">
                                <?php if (isset($_GET['updateid'])) { ?>
                                <input class="form-control" type="number" 
                                name="updateid" 
                                placeholder="Enter event id . . .";
                                value="<?php echo $_GET['updateid']; ?>">
                                <?php }else{ ?>
                                <input class="form-control" type="number" 
                                name="updateid" 
                                placeholder="Enter event id . . ."
                                value="<?php echo $updateid; ?>">
                                <?php }?>

                                <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="searchtoupdate" value="SEARCHTOUPDATE">
                                <i class="fa fa-search"></i>
                                </button>
                                </div>
                                </div>        
                                </div>
                        </div>
                </div> </section>

                <?php if (isset($_GET['updateerror'])){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="updateerror"><?php echo $_GET['updateerror']; ?></p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                <?php } ?>
                <?php if (isset($_GET['updatesuccess'])){ ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p class="updatesuccess"><?php echo $_GET['updatesuccess']; ?></p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                <?php } ?>  

<div class="container-fluid">
   

              <label>Event Name</label>
                <?php if (isset($_GET['event_name'])) { ?>
              <select id="event_name" name="event_name">    
               <option value="<?php echo $_GET['event_name']; ?>"><?php echo $_GET['event_name']; ?></option>
               <option value="BAPTISM">BAPTISM</option>
               <option value="CONFIRMATION">CONFIRMATION</option>
               <option value="RECONCILIATION">RECONCILIATION</option>
               <option value="ANOINTING OF THE SICK">ANOINTING OF THE SICK</option>
               <option value="MARRIAGE">MARRIAGE</option>
               <option value="ORDINATION">ORDINATION</option>
               </select>
               <?php }else{ ?>
              <select id="event_name" name="event_name" >
               <option value="<?php echo $updateevent_name; ?>"><?php echo $updateevent_name; ?></option>
               <option value="BAPTISM">BAPTISM</option>
               <option value="CONFIRMATION">CONFIRMATION</option>
               <option value="RECONCILIATION">RECONCILIATION</option>
               <option value="ANOINTING OF THE SICK">ANOINTING OF THE SICK</option>
               <option value="MARRIAGE">MARRIAGE</option>
               <option value="ORDINATION">ORDINATION</option>
               </select>
               <?php }?>
              
              
              <label>Event Date</label>
              <?php if (isset($_GET['event_date'])) { ?>
                  <input type="date" 
                          id="event_date"
                          name="event_date" 
                          value="<?php echo $_GET['event_date']; ?>"> <br>
              <?php }else{ ?>
                  <input type="date" 
                          name="event_date" 
                          value="<?php echo $updateevent_date; ?>"> <br>
              <?php }?>
              
              <label>Event Start Time</label>
            
              <?php if (isset($_GET['event_start_time'])) { ?>
                  <input type="time" 
                          name="event_start_time" 
                          placeholder="Event time"
                          value="<?php echo $_GET['event_start_time']; ?>"> 
              <?php }else{ ?>
                  <input type="time" 
                          name="event_start_time" 
                          placeholder="Event time"
                          value="<?php echo $updateevent_start_time; ?>"> 
              <?php }?> 
              <label>Event End Time</label>
              <?php if (isset($_GET['event_end_time'])) { ?>
                  <input type="time" 
                          name="event_end_time" 
                          placeholder="Event time"
                          value="<?php echo $_GET['event_end_time']; ?>"> <br>
              <?php }else{ ?>
                  <input type="time" 
                          name="event_end_time" 
                          placeholder="Event time"
                          value="<?php echo $updateevent_end_time; ?>"> <br> 
              <?php }?> 

              <label>Event Slot</label>
              <?php if (isset($_GET['event_slot'])) { ?>
                  <input type="number" 
                          name="event_slot" 
                          placeholder="Event slot"
                          value="<?php echo ($_GET['event_slot']); ?>"> 
              <?php }else{ ?>
                  <input type="number" 
                          name="event_slot" 
                          placeholder="Event slot"
                          value="<?php echo $updateevent_slot; ?>"> 
              <?php }?> 

              <label>Event Description/Purpose</label>
                <?php if (isset($_GET['description_purpose'])) { ?>
                  <input class="desc" type="text" 
                          name="description_purpose" 
                          placeholder="Description/Purpose"
                          value="<?php echo ($_GET['description_purpose']); ?>"> 
              <?php }else{ ?>
                  <input class="desc" type="text" 
                          name="description_purpose" 
                          placeholder="Description/Purpose"
                          value="<?php echo $updatedescription_purpose; ?>"> 
              <?php }?>    

                <div class="row">
                        <div class="col-6">
                                <input class="btn btn-primary btninput" type="submit" name="update" value="UPDATE">
                        </div>
                        <div class="col-6">
                                <input class="btn btn-primary btninput" type="submit" name="updaterefresh" action="userevents.php" value="REFRESH">
                        </div>
                </div>
            </div>

        </form>
        
<form action="userevents.php" method="post">
        <section class="page-section" id="listevent">        
        <div class="heading">
                <div class='row'>
                <div class='col-4'>
                <h1>LIST OF EVENTS</h1>
                </div>
                <div class='col-5'>
                <div class="input-group">
                      <?php if (isset($_GET['searchinput'])) { ?>
                      <input class="form-control" type="text" 
                      name="searchinput" 
                      placeholder="Enter event data . . .";
                      value="<?php echo $_GET['searchinput']; ?>">
                      <?php }else{ ?>
                      <input class="form-control" type="text" 
                      name="searchinput" 
                      placeholder="Enter event data . . ."
                      value="<?php echo $searchinput; ?>">
                      <?php }?>

                      <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="search" value="SEARCH">
                              <i class="fa fa-search"></i>
                            </button>
                      </div>
                </div>        
                </div>
                <div class='col-3'>
                      <button class="btn btn-primary dropdown-toggle actions" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" onclick="window.print();" >Print</a>
                      <a class="dropdown-item" href="userevents.php?#listevent">Refresh</a>
                      </div>
                </div>      
                </div>
        </div> </section>

                <?php if (isset($_GET['searcherror'])){ ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p class="searcherror"><?php echo $_GET['searcherror']; ?></p>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php } ?>
                <?php if (isset($_GET['deletesuccess'])){ ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p class="deletesuccess"><?php echo $_GET['deletesuccess']; ?></p>
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
<div class="container-fluid table">
        <?php
        //TABLE
        
if (isset($_POST['search'])) 
{
                $searchinput = $_POST['searchinput'];

                if(!empty($searchinput))
                {
                $sqlusername= "SELECT * FROM user_event WHERE username='$_SESSION[username]'";
                $resultusername= mysqli_query($database_connection, $sqlusername);
                $sqlevent_name ="SELECT * FROM user_event WHERE event_name LIKE '%$searchinput%' AND username='$_SESSION[username]'";
                $resultevent_name = mysqli_query($database_connection, $sqlevent_name) or die("Bad Query: $sql");

                $sqlid ="SELECT * FROM user_event WHERE id LIKE '$searchinput' AND username='$_SESSION[username]'";
                $resultid = mysqli_query($database_connection, $sqlid) or die("Bad Query: $sql");
                if (mysqli_num_rows($resultevent_name) > 0) {
                        echo "<table>";

                        echo "<thead><tr><th>Id</th><th>Event Name</th><th>Event Date</th><th>Event Start Time</th><th>Event End Time</th><th>No. of slots available</th><th>Description Purpose</th></tr></thead>";

                        while ($row = mysqli_fetch_assoc($resultevent_name)) 
                        {
                        echo "<tr><td>{$row['id']}</td><td>{$row['event_name']}</td><td>{$row['event_date']}</td><td>{$row['event_start_time']}</td><td>{$row['event_end_time']}</td><td>{$row['event_slot']}</td><td>{$row['description_purpose']}</td></tr>";
                        }

                        echo "</table>";
                }
                else if (mysqli_num_rows($resultid) > 0) {
                        echo "<table>";

                        echo "<thead><tr><th>Id</th><th>Event Name</th><th>Event Date</th><th>Event Start Time</th><th>Event End Time</th><th>No. of slots available</th><th>Description Purpose</th></tr></thead>";

                        while ($row = mysqli_fetch_assoc($resultid)) 
                        {
                        echo "<tr><td>{$row['id']}</td><td>{$row['event_name']}</td><td>{$row['event_date']}</td><td>{$row['event_start_time']}</td><td>{$row['event_end_time']}</td><td>{$row['event_slot']}</td><td>{$row['description_purpose']}</td></tr>";
                        }

                        echo "</table>";
                }
                else
                {

                $sql2= "SELECT * FROM user_event WHERE username='$_SESSION[username]'";
                $result2= mysqli_query($database_connection, $sql2);

                echo "<table>";

                echo "<thead><tr><th>Id</th><th>Event Name</th><th>Event Date</th><th>Event Start Time</th><th>Event End Time</th><th>No. of slots available</th><th>Description Purpose</th></tr></thead>";

                while ($row = mysqli_fetch_assoc($result2)) 
                {
                echo "<tr><td>{$row['id']}</td><td>{$row['event_name']}</td><td>{$row['event_date']}</td><td>{$row['event_start_time']}</td><td>{$row['event_end_time']}</td><td>{$row['event_slot']}</td><td>{$row['description_purpose']}</td></tr>";
                }

                echo "</table>";
                }
                 
                }

                else
                {

                $sql2= "SELECT * FROM user_event WHERE username='$_SESSION[username]'";
                $result2= mysqli_query($database_connection, $sql2);

                echo "<table>";

                echo "<thead><tr><th>Id</th><th>Event Name</th><th>Event Date</th><th>Event Start Time</th><th>Event End Time</th><th>No. of slots available</th><th>Description Purpose</th></tr></thead>";

                while ($row = mysqli_fetch_assoc($result2)) 
                {
                echo "<tr><td>{$row['id']}</td><td>{$row['event_name']}</td><td>{$row['event_date']}</td><td>{$row['event_start_time']}</td><td>{$row['event_end_time']}</td><td>{$row['event_slot']}</td><td>{$row['description_purpose']}</td></tr>";
                }

                echo "</table>";
                }   
                 
                }



else
{

$sql2= "SELECT * FROM user_event WHERE username='$_SESSION[username]'";
$result2= mysqli_query($database_connection, $sql2);

echo "<table>";

echo "<thead><tr><th>Id</th><th>Event Name</th><th>Event Date</th><th>Event Start Time</th><th>Event End Time</th><th>No. of slots available</th><th>Description Purpose</th></tr></thead>";

while ($row = mysqli_fetch_assoc($result2)) 
{
echo "<tr><td>{$row['id']}</td><td>{$row['event_name']}</td><td>{$row['event_date']}</td><td>{$row['event_start_time']}</td><td>{$row['event_end_time']}</td><td>{$row['event_slot']}</td><td>{$row['description_purpose']}</td></tr>";
}

echo "</table>";
} 

   
?>
</div>
</form>
</div>
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
