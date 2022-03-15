<?php 
      session_start();

      if(isset($_SESSION['id']) && isset($_SESSION['username']))
      {
?>
<?php

            include 'databaseconnection.php';

            $updateid= "";
            $addevent_name = "";
            $addevent_date = "";
            $addevent_start_time = "";
            $addevent_end_time = "";  
            $addevent_slot = "";   
            $adddescription_purpose = "";  

            $updateevent_name = "";
            $updateevent_date = "";
            $updateevent_start_time = "";
            $updateevent_end_time = "";  
            $updateevent_slot = "";   
            $updatedescription_purpose = "";
            $searchinput ="";

            






//TO SEARCH

             //TO SEARCH
if(isset($_POST['search']))
{         
        $searchinput = $_POST['searchinput']; 

        if(!empty($searchinput))
        {
            
            $log_activity = "Search Member Event"; 
                              $log_username = $_SESSION['username'];
            $sql= "SELECT * FROM user_event WHERE id= '$searchinput' OR event_name LIKE '%$searchinput%'";
                $result= mysqli_query($database_connection, $sql);                      
                                  
            if(mysqli_num_rows($result))
            {
                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$searchinput')";
                $result3= mysqli_query($database_connection, $sql3);
                
                if(mysqli_num_rows($result) ==1)
                {
                   
                    $searchsuccess = "Found ". mysqli_num_rows($result)." record successfully!";
                }
                else
                {
                    
                    $searchsuccess = "Found ". mysqli_num_rows($result)." records successfully!";
                }
            }
            else
            {
                header("Location: memberevents.php?searcherror=The data is not existing&#listevent");
                exit();
            }
        } 
        else
        {
            header("Location: memberevents.php?searcherror=Search bar is empty&#listevent");
            exit();
        }
}


//TO ADD
            if(isset($_POST['add']))
            {
                 
                  
                        if (isset($_POST['addevent_name']) && isset($_POST['addevent_date']) && isset($_POST['addevent_start_time']) && isset($_POST['addevent_end_time']) && isset($_POST['addevent_slot']) && isset($_POST['adddescription_purpose'])) {

                function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }
                
                $addevent_name = validate ($_POST['addevent_name']);
                $addevent_date = validate ($_POST['addevent_date']);
                $addevent_start_time= validate ($_POST['addevent_start_time']);
                $addevent_end_time= validate ($_POST['addevent_end_time']);
                $addevent_slot= validate ($_POST['addevent_slot']);
                $adddescription_purpose= validate ($_POST['adddescription_purpose']);

                
                $user_data = 'addevent_name=' . $addevent_name. '&addevent_date=' . $addevent_date . '&addevent_start_time=' . $addevent_start_time . '&addevent_end_time=' . $addevent_end_time . '&addevent_slot=' . $addevent_slot . '&adddescription_purpose=' . $adddescription_purpose;

                if(empty($addevent_name)){
                        header("Location: memberevents.php?adderror=Event Name is required&$user_data");
                        exit();
                }
                else if(empty($addevent_date)){
                        header("Location: memberevents.php?adderror=Event Date is required&$user_data");
                        exit();
                }
                else if(empty($addevent_start_time)){
                        header("Location: memberevents.php?adderror=Event Start Time is required&$user_data");
                        exit();
                }
                else if(empty($addevent_end_time)){
                        header("Location: memberevents.php?adderror=Event End Time is required&$user_data");
                        exit();
                }
                else if(empty($addevent_slot)){
                        header("Location: memberevents.php?adderror=Event Slot is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[0-9]+$/", $addevent_slot)){
                        header("Location: memberevents.php?adderror=Event Slot must contain numbers only&$user_data");
                        exit();
                }


                else
                {
                               
                                $sql2= "INSERT INTO user_event(event_name, event_date, event_start_time, event_end_time, event_slot , description_purpose, username) VALUES('$addevent_name', '$addevent_date', '$addevent_start_time','$addevent_end_time','$addevent_slot','$adddescription_purpose','$_SESSION[username]')";

                                $result2= mysqli_query($database_connection, $sql2);

                                if($result2)
                                {
                                        $log_username = $_SESSION['username'];
                                                                                $log_activity = "Add Member Event"; 
                                                                                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$addevent_name')";
                                                                                $result3= mysqli_query($database_connection, $sql3);
                                        header("Location: memberevents.php?addsuccess=Event has been created successfully");
                                exit();
                                }
                                else
                                {
                                        header("Location: memberevents.php?adderror=Unknown error occurred&$user_data");
                                exit();
                                }
                               
                        
                       
                }

        }else{
                header("Location: memberevents.php");
                exit();
        }
            }

//TO SEARCH AND UPDATE
            if(isset($_POST['searchtoupdate']))
            {
                       
                        $updateid = $_POST['updateid'];
                        $search_query= "SELECT * FROM user_event WHERE id= '$updateid'";
                        $search_result= mysqli_query($database_connection, $search_query);
                        // $search_query1= "SELECT * FROM admin_event WHERE event_name= '$_POST[updateevent_name]'";
                        // $search_result1= mysqli_query($database_connection, $search_query1);
                        // $search_query2= "SELECT * FROM admin_event WHERE event_date= '$_POST[updateevent_date]'";
                        // $search_result2= mysqli_query($database_connection, $search_query2);
                        // $search_query3= "SELECT * FROM admin_event WHERE event_time= '$_POST[updateevent_time]'";
                        // $search_result3= mysqli_query($database_connection, $search_query3);

                              
                              
                              if(mysqli_num_rows($search_result))
                              {
                                    while($row = mysqli_fetch_array($search_result))
                                    {
                                        $updateid= $row['id'];
                                        $updateevent_name= $row['event_name'];
                                        $updateevent_date= $row['event_date'];
                                        $updateevent_start_time = $row['event_start_time'];
                                        $updateevent_end_time = $row['event_end_time'];   
                                        $updatedescription_purpose = $row['description_purpose']; 
                                        $updateevent_slot= $row['event_slot'];
                                         
                                    }
                              }
                              // else if(mysqli_num_rows($search_result1))
                              // {
                              //       while($row = mysqli_fetch_array($search_result1))
                              //       {
                              //             $updateid= $row['updateid'];
                              //             $updateevent_name= $row['updateevent_name'];
                              //             $updateevent_date= $row['updateevent_date'];
                              //             $updateevent_time= $row['updateevent_time'];
                              //             $updateevent_slot= $row['updateevent_slot'];

                                
                                         
                              //       }
                              // }
                              // else if(mysqli_num_rows($search_result2))
                              // {
                              //       while($row = mysqli_fetch_array($search_result2))
                              //       {
                              //             $updateid= $row['updateid'];
                              //             $updateevent_name= $row['updateevent_name'];
                              //             $updateevent_date= $row['updateevent_date'];
                              //             $updateevent_time= $row['updateevent_time'];
                              //             $updateevent_slot= $row['updateevent_slot'];

                                
                                         
                              //       }
                              // }
                              // else if(mysqli_num_rows($search_result3))
                              // {
                              //       while($row = mysqli_fetch_array($search_result3))
                              //       {
                              //             $updateid= $row['updateid'];
                              //             $updateevent_name= $row['updateevent_name'];
                              //             $updateevent_date= $row['updateevent_date'];
                              //             $updateevent_time= $row['updateevent_time'];
                              //             $updateevent_slot= $row['updateevent_slot'];

                                
                                         
                              //       }
                              // }
                              else
                              {
                                    header("Location: memberevents.php?updateerror=The ID is not existing&updateid=$updateid");
                                        exit();
                              }

                         
                             
            }

//TO UPDATE
if(isset($_POST['update']))
            {
              
                  
                        if (isset($_POST['updateid'])  && isset($_POST['updateevent_date']) && isset($_POST['updateevent_start_time']) && isset($_POST['updateevent_end_time']) && isset($_POST['updateevent_slot']) && isset($_POST['updatedescription_purpose'])) {

                function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }
                $updateid = validate ($_POST['updateid']);
                $updateevent_name = validate ($_POST['updateevent_name']);
                $updateevent_date = validate ($_POST['updateevent_date']);
                $updateevent_start_time= validate ($_POST['updateevent_start_time']);
                $updateevent_end_time= validate ($_POST['updateevent_end_time']);
                $updateevent_slot= validate ($_POST['updateevent_slot']);
                $updatedescription_purpose= validate ($_POST['updatedescription_purpose']);

                
                $user_data = 'updateevent_name=' . $updateevent_name. '&updateevent_date=' . $updateevent_date . '&updateevent_start_time=' . $updateevent_start_time . '&updateevent_end_time=' . $updateevent_end_time . '&updateevent_slot=' . $updateevent_slot . '&updatedescription_purpose=' . $updatedescription_purpose;
                if(empty($updateevent_name)){
                        header("Location: memberevents.php?error=Event Name is required&$user_data");
                        exit();
                }
                else if(empty($updateevent_date)){
                        header("Location: memberevents.php?error=Event Date is required&$user_data");
                        exit();
                }
                else if(empty($updateevent_start_time)){
                        header("Location: memberevents.php?error=Event Start Time is required&$user_data");
                        exit();
                }
                else if(empty($updateevent_end_time)){
                        header("Location: memberevents.php?error=Event End Time is required&$user_data");
                        exit();
                }
                else if(empty($updateevent_slot)){
                        header("Location: memberevents.php?error=Event Slot is required&$user_data");
                        exit();
                }
                else if(!preg_match("/^[0-9]+$/", $updateevent_slot)){
                        header("Location: memberevents.php?error=Event Slot must contain numbers from 1-250&$user_data");
                        exit();
                }
                else if($updateevent_slot <1){
                        header("Location: memberevents.php?error=Event Slot is not less than 1 &$user_data");
                        exit();
                }
                else if($updateevent_slot >250){
                        header("Location: memberevents.php?error=Event Slot is not more than 250&$user_data");
                        exit();
                }
                


                else{
                        
                        
                        $sql= "SELECT * FROM user_event WHERE id= '$updateid'";
                        $result= mysqli_query($database_connection, $sql);

                          
                       if (mysqli_num_rows($result) > 0) 
                       {
                       
                        $id = $_POST['updateid'];
                        $sql2= "UPDATE user_event SET event_name='$_POST[updateevent_name]',event_date='$_POST[updateevent_date]',event_start_time='$_POST[updateevent_start_time]',event_end_time='$_POST[updateevent_end_time]',event_slot='$_POST[updateevent_slot]',description_purpose='$_POST[updatedescription_purpose]' WHERE id ='$updateid'";

                        $result2= mysqli_query($database_connection, $sql2);

                                        if($result2)
                                        {
                                                $log_username = $_SESSION['username'];
                                                                                $log_activity = "Update Member Event"; 
                                                                                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$updateid')";
                                                                                $result3= mysqli_query($database_connection, $sql3);

                                                header("Location: memberevents.php?updatesuccess=Event has been updated successfully");
                                        exit();
                                        }
                                        else
                                        {
                                                header("Location: memberevents.php?updateerror=Unknown error occurred&$user_data");
                                        exit();
                                        }                        
                       } 

                       else
                       {
                                        header("Location: memberevents.php?updateerror=The id is not existing&$user_data");
                        exit();
                       }
                     
                }

        }else{
                header("Location: memberevents.php");
                exit();
        }
}


        if(isset($_POST['updaterefresh']))
        {
              header("Location: memberevents.php?#updateevent");
              exit();
        } 
                if(isset($_POST['addrefresh']))
        {
              header("Location: memberevents.php?#addevent");
              exit();
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
        <link rel="stylesheet" href="css/adminmembereventsD.css"/>
        <link rel="stylesheet" type="text/css" href="css/eventsprint.css" media="print" />
        <title>SCPCFI Admin Events</title>
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
                              <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
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
        <form action="memberevents.php" method="post">
             
              <label>Event Name</label>
                <?php if (isset($_GET['addevent_name'])) { ?>
              <select id="addevent_name" name="addevent_name">    
               <option value="<?php echo $_GET['addevent_name']; ?>"><?php echo $_GET['addevent_name']; ?></option>
               <option value="BAPTISM">BAPTISM</option>
               <option value="CONFIRMATION">CONFIRMATION</option>
               <option value="RECONCILIATION">RECONCILIATION</option>
               <option value="ANOINTING OF THE SICK">ANOINTING OF THE SICK</option>
               <option value="MARRIAGE">MARRIAGE</option>
               <option value="ORDINATION">ORDINATION</option>
               </select>
               <?php }else{ ?>
              <select id="addevent_name" name="addevent_name" >
               <option value="<?php echo $addevent_name; ?>"><?php echo $addevent_name; ?></option>
               <option value="BAPTISM">BAPTISM</option>
               <option value="CONFIRMATION">CONFIRMATION</option>
               <option value="RECONCILIATION">RECONCILIATION</option>
               <option value="ANOINTING OF THE SICK">ANOINTING OF THE SICK</option>
               <option value="MARRIAGE">MARRIAGE</option>
               <option value="ORDINATION">ORDINATION</option>
               </select>
               <?php }?><br>

              
              <label>Event Date</label>
              <?php if (isset($_GET['addevent_date'])) { ?>
                  <input type="date" 
                          id="addevent_date"
                          name="addevent_date" 
                          value="<?php echo $_GET['addevent_date']; ?>"> <br>
              <?php }else{ ?>
                  <input type="date" 
                          name="addevent_date" 
                          value="<?php echo $addevent_date; ?>"> <br>
              <?php }?>
              
              <label>Event Start Time</label>
            
              <?php if (isset($_GET['addevent_start_time'])) { ?>
                  <input type="time" 
                          name="addevent_start_time" 
                          placeholder="Event time"
                          value="<?php echo $_GET['addevent_start_time']; ?>"> 
              <?php }else{ ?>
                  <input type="time" 
                          name="addevent_start_time" 
                          placeholder="Event time"
                          value="<?php echo $addevent_start_time; ?>"> 
              <?php }?> 
              <label>Event End Time</label>
              <?php if (isset($_GET['addevent_end_time'])) { ?>
                  <input type="time" 
                          name="addevent_end_time" 
                          placeholder="Event time"
                          value="<?php echo $_GET['addevent_end_time']; ?>"> <br>
              <?php }else{ ?>
                  <input type="time" 
                          name="addevent_end_time" 
                          placeholder="Event time"
                          value="<?php echo $addevent_end_time; ?>"> <br> 
              <?php }?> 

              <label>Event Slot</label>
              <?php if (isset($_GET['addevent_slot'])) { ?>
                  <input type="number" 
                          name="addevent_slot" 
                          placeholder="Event slot"
                          value="<?php echo ($_GET['addevent_slot']); ?>"> 
              <?php }else{ ?>
                  <input type="number" 
                          name="addevent_slot" 
                          placeholder="Event slot"
                          value="<?php echo $addevent_slot; ?>"> 
              <?php }?> 

              <label>Event Description/Purpose</label>
                <?php if (isset($_GET['adddescription_purpose'])) { ?>
                  <input class="desc" type="text" 
                          name="adddescription_purpose" 
                          placeholder="Description/Purpose"
                          value="<?php echo ($_GET['adddescription_purpose']); ?>"> 
              <?php }else{ ?>
                  <input class="desc" type="text" 
                          name="adddescription_purpose" 
                          placeholder="Description/Purpose"
                          value="<?php echo $adddescription_purpose; ?>"> 
              <?php }?>    


                <div class="row">
                        <div class="col-6">
                                <input class="btn btn-primary btninput" type="submit" name="add" value="ADD">
                        </div>
                        <div class="col-6">
                                <input class="btn btn-primary btninput" type="submit" name="addrefresh" action="events.php" value="REFRESH">
                        </div>
                </div>
        </form> 
        </div>

<form action="memberevents.php" method="post">
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
                <?php if (isset($_GET['updateevent_name'])) { ?>
              <select id="updateevent_name" name="updateevent_name">    
               <option value="<?php echo $_GET['updateevent_name']; ?>"><?php echo $_GET['updateevent_name']; ?></option>
               <option value="BAPTISM">BAPTISM</option>
               <option value="CONFIRMATION">CONFIRMATION</option>
               <option value="RECONCILIATION">RECONCILIATION</option>
               <option value="ANOINTING OF THE SICK">ANOINTING OF THE SICK</option>
               <option value="MARRIAGE">MARRIAGE</option>
               <option value="ORDINATION">ORDINATION</option>
               </select>
               <?php }else{ ?>
              <select id="updateevent_name" name="updateevent_name" >
               <option value="<?php echo $updateevent_name; ?>"><?php echo $updateevent_name; ?></option>
               <option value="BAPTISM">BAPTISM</option>
               <option value="CONFIRMATION">CONFIRMATION</option>
               <option value="RECONCILIATION">RECONCILIATION</option>
               <option value="ANOINTING OF THE SICK">ANOINTING OF THE SICK</option>
               <option value="MARRIAGE">MARRIAGE</option>
               <option value="ORDINATION">ORDINATION</option>
               </select>
               <?php }?><br>

              
              <label>Event Date</label>
              <?php if (isset($_GET['updateevent_date'])) { ?>
                  <input type="date" 
                          id="updateevent_date"
                          name="updateevent_date" 
                          value="<?php echo $_GET['updateevent_date']; ?>"> <br>
              <?php }else{ ?>
                  <input type="date" 
                          name="updateevent_date" 
                          value="<?php echo $updateevent_date; ?>"> <br>
              <?php }?>
              
              <label>Event Start Time</label>
            
              <?php if (isset($_GET['updateevent_start_time'])) { ?>
                  <input type="time" 
                          name="updateevent_start_time" 
                          placeholder="Event time"
                          value="<?php echo $_GET['updateevent_start_time']; ?>"> 
              <?php }else{ ?>
                  <input type="time" 
                          name="updateevent_start_time" 
                          placeholder="Event time"
                          value="<?php echo $updateevent_start_time; ?>"> 
              <?php }?> 
              <label>Event End Time</label>
              <?php if (isset($_GET['updateevent_end_time'])) { ?>
                  <input type="time" 
                          name="updateevent_end_time" 
                          placeholder="Event time"
                          value="<?php echo $_GET['updateevent_end_time']; ?>"> <br>
              <?php }else{ ?>
                  <input type="time" 
                          name="updateevent_end_time" 
                          placeholder="Event time"
                          value="<?php echo $updateevent_end_time; ?>"> <br> 
              <?php }?> 

              <label>Event Slot</label>
              <?php if (isset($_GET['updateevent_slot'])) { ?>
                  <input type="number" 
                          name="updateevent_slot" 
                          placeholder="Event slot"
                          value="<?php echo ($_GET['updateevent_slot']); ?>"> 
              <?php }else{ ?>
                  <input type="number" 
                          name="updateevent_slot" 
                          placeholder="Event slot"
                          value="<?php echo $updateevent_slot; ?>"> 
              <?php }?> 

              <label>Event Description/Purpose</label>
                <?php if (isset($_GET['updatedescription_purpose'])) { ?>
                  <input class="desc" type="text" 
                          name="updatedescription_purpose" 
                          placeholder="Description/Purpose"
                          value="<?php echo ($_GET['updatedescription_purpose']); ?>"> 
              <?php }else{ ?>
                  <input class="desc" type="text" 
                          name="updatedescription_purpose" 
                          placeholder="Description/Purpose"
                          value="<?php echo $updatedescription_purpose; ?>"> 
              <?php }?>    


                <div class="row">
                        <div class="col-6">
                                <input class="btn btn-primary btninput" type="submit" name="update" value="UPDATE">
                        </div>
                        <div class="col-6">
                                <input class="btn btn-primary btninput" type="submit" name="updaterefresh" action="memberevents.php" value="REFRESH">
                        </div>
                </div>
        
        </div>
</form> 

<form action="memberevents.php" method="post">
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
                      <a class="dropdown-item" href="memberevents.php?#listevent">Refresh</a>
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
            <p class="deletesuccess"><?php echo $searchsuccess; ?></p>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php } ?>
       <?php
//TABLE

if (isset($_POST['search'])) 
{
        if (isset($_POST['searchinput'])) 
        {
                $searchinput = $_POST['searchinput'];

                $sql= "SELECT * FROM user_event WHERE id= '$searchinput' OR event_name LIKE '%$searchinput%'";
                $result= mysqli_query($database_connection, $sql);

                if (mysqli_num_rows($result) > 0) 
                {

                 echo "<div class='container-fluid table'><table>";

        echo "<thead><tr><th class='idth'>Id</th><th class='nameth'>Event Name</th><th>Event Date</th><th>Event Start Time</th><th>Event End Time</th><th class='idth'>Slots</th><th class='nameth'>Description Purpose</th><th>Added by</th><th>Timestamp</th></tr></thead>";
        
        while ($row = mysqli_fetch_assoc($result)) 
        {
        echo "<tr><td class='idtd'>{$row['id']}</td><td class='nametd'><div class='wrapname'>{$row['event_name']}</div></td><td>{$row['event_date']}</td><td>{$row['event_start_time']}</td><td>{$row['event_end_time']}</td><td class='idtd'>{$row['event_slot']}</td><td>{$row['description_purpose']}</td><td class='nametd'>{$row['username']}</td><td>{$row['dateadded']}</td><td><a   href='memberevents.php?id={$row['id']}'><button type='button' class='btn btn-primary actions' value='DELETE'>DELETE</button></a></td></tr>";
        }
        
        echo "</table></div>";                                                                 
                }
                else
                {
                
                $sql = "SELECT * FROM user_event";
                $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

                 echo "<div class='container-fluid table'><table>";

        echo "<thead><tr><th class='idth'>Id</th><th class='nameth'>Event Name</th><th>Event Date</th><th>Event Start Time</th><th>Event End Time</th><th class='idth'>Slots</th><th class='nameth'>Description Purpose</th><th>Added by</th><th>Timestamp</th></tr></thead>";
        
        while ($row = mysqli_fetch_assoc($result)) 
        {
        echo "<tr><td class='idtd'>{$row['id']}</td><td class='nametd'><div class='wrapname'>{$row['event_name']}</div></td><td>{$row['event_date']}</td><td>{$row['event_start_time']}</td><td>{$row['event_end_time']}</td><td class='idtd'>{$row['event_slot']}</td><td>{$row['description_purpose']}</td><td class='nametd'>{$row['username']}</td><td>{$row['dateadded']}</td><td><a   href='memberevents.php?id={$row['id']}'><button type='button' class='btn btn-primary actions' value='DELETE'>DELETE</button></a></td></tr>";
        }
        
        echo "</table></div>";


                }
        }
                        else
                {
                
                $sql = "SELECT * FROM user_event";
                $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

                 echo "<div class='container-fluid table'><table>";

        echo "<thead><tr><th class='idth'>Id</th><th class='nameth'>Event Name</th><th>Event Date</th><th>Event Start Time</th><th>Event End Time</th><th class='idth'>Slots</th><th class='nameth'>Description Purpose</th><th>Added by</th><th>Timestamp</th></tr></thead>";
        
        while ($row = mysqli_fetch_assoc($result)) 
        {
        echo "<tr><td class='idtd'>{$row['id']}</td><td class='nametd'><div class='wrapname'>{$row['event_name']}</div></td><td>{$row['event_date']}</td><td>{$row['event_start_time']}</td><td>{$row['event_end_time']}</td><td class='idtd'>{$row['event_slot']}</td><td>{$row['description_purpose']}</td><td class='nametd'>{$row['username']}</td><td>{$row['dateadded']}</td><td><a   href='memberevents.php?id={$row['id']}'><button type='button' class='btn btn-primary actions' value='DELETE'>DELETE</button></a></td></tr>";
        }
        
        echo "</table></div>";


                }
}
                else
                {
                
                $sql = "SELECT * FROM user_event";
                $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

                echo "<div class='container-fluid table'><table>";

        echo "<thead><tr><th class='idth'>Id</th><th class='nameth'>Event Name</th><th>Event Date</th><th>Event Start Time</th><th>Event End Time</th><th class='idth'>Slots</th><th class='nameth'>Description Purpose</th><th>Added by</th><th>Timestamp</th></tr></thead>";
        
        while ($row = mysqli_fetch_assoc($result)) 
        {
        echo "<tr><td class='idtd'>{$row['id']}</td><td class='nametd'><div class='wrapname'><a   href='memberevents.php?viewid={$row['id']}'>{$row['event_name']}</a></div></td><td>{$row['event_date']}</td><td>{$row['event_start_time']}</td><td>{$row['event_end_time']}</td><td class='idtd'>{$row['event_slot']}</td><td>{$row['description_purpose']}</td><td class='nametd'>{$row['username']}</td><td>{$row['dateadded']}</td><td><a   href='memberevents.php?id={$row['id']}'><button type='button' class='btn btn-primary actions' value='DELETE'>DELETE</button></a></td></tr>";
        }
        
        echo "</table></div>";


                }
  ?>
   <?php if(isset($_GET['id'])){  
    $sql = "SELECT * FROM user_event WHERE id='$_GET[id]'";
    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");    
    if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) 
    { 
$idb= $row['id'];
$event_nameb= $row['event_name'];
$event_dateb= $row['event_date'];
$event_start_timeb= $row['event_start_time'];
$event_end_timeb= $row['event_end_time'];
$event_slotb= $row['event_slot'];
?>
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this event?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-info"></i></center>
                </div>
                <div class="col-3">
                        ID
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $idb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-calendar-check-o"></i></center>
                </div>
                <div class="col-3">
                        Name
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_nameb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-calendar"></i></center>
                </div>
                <div class="col-3">
                        Date
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_dateb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-clock-o"></i></center>
                </div>
                <div class="col-3">
                        Start Time
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_start_timeb; ?></p>
                </div>
        </div>
                <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-clock-o"></i></center>
                </div>
                <div class="col-3">
                        End Time
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_end_timeb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-users"></i></center>
                </div>
                <div class="col-3">
                        Slot
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_slotb; ?></p>
                </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a class='btn btn-primary' type='submit' name='delete' value='DELETE' href='deletememberevent.php?id=<?php echo $idb; ?>&event_name=<?php echo $event_nameb; ?>'>Yes</a>
      </div>
    </div>
  </div>
</div>  
<?php    
} }
}
?>
<?php if(isset($_GET['viewid'])){  
    $sql = "SELECT * FROM user_event WHERE id='$_GET[viewid]'";
    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");    
    if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) 
    { 
$idbc= $row['id'];
$event_namebc= $row['event_name'];
$event_datebc= $row['event_date'];
$event_start_timebc= $row['event_start_time'];
$event_end_timebc= $row['event_end_time'];
$event_slotbc= $row['event_slot'];
?>
  <!-- Modal -->
<div class="modal fade" id="exampleModalb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Member Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-info"></i></center>
                </div>
                <div class="col-3">
                        ID
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $idbc; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-calendar-check-o"></i></center>
                </div>
                <div class="col-3">
                        Name
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_namebc; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-calendar"></i></center>
                </div>
                <div class="col-3">
                        Date
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_datebc; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-clock-o"></i></center>
                </div>
                <div class="col-3">
                        Start Time
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_start_timebc; ?></p>
                </div>
        </div>
                <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-clock-o"></i></center>
                </div>
                <div class="col-3">
                        End Time
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_end_timebc; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-users"></i></center>
                </div>
                <div class="col-3">
                        Slot
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_slotbc; ?></p>
                </div>
        </div>
      </div>

      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>  
<?php    
} }
}
?>
</form>

</div>
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://khaalipaper.com/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          $('#exampleModal').modal({
              show: true,
              backdrop: 'static',
            keyboard: false

          });
        });
    
    </script>
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://khaalipaper.com/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          $('#exampleModalb').modal({
              show: true,
              backdrop: 'static',
            keyboard: false

          });
        });
    
    </script>
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
