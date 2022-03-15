<?php 
      session_start();
      if(isset($_SESSION['id']) && isset($_SESSION['username']))
      {
?>
<?php
                error_reporting(0);
                include 'databaseconnection.php';

                $updateid= "";
                $updateevent_name = "";
                $updateevent_date = "";
                $updateevent_time = ""; 
                $updateevent_slot = "";     

                function getPosts()
                {
                  $posts= array();
                  $posts[0]= $_POST['updateid'];
                  $posts[1]= $_POST['updateevent_name'];
                  $posts[2]= $_POST['updateevent_date'];
                  $posts[3]= $_POST['updateevent_time'];
                  $posts[4]= $_POST['updateevent_slot'];
                  return $posts;
                }

        //TO ADD
        if(isset($_POST['add']))
        {
                 if (isset($_POST['addevent_name']) && isset($_POST['addevent_date']) && isset($_POST['addevent_time']) && isset($_POST['addevent_slot'])) 
                {

                        function validate($data){
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                        }
                
                        $addimage_name = validate ($_FILES['addimage_name']['name']);
                        $addevent_name = validate ($_POST['addevent_name']);
                        $addevent_date = validate ($_POST['addevent_date']);
                        $addevent_time = validate ($_POST['addevent_time']);
                        $addevent_slot = validate ($_POST['addevent_slot']);

                
                        $user_data = 'addimage_name=' . $addimage_name. '&addevent_name='  . $addevent_name. '&addevent_date=' . $addevent_date . '&addevent_time=' . $addevent_time . '&addevent_slot=' . $addevent_slot;

                        if(empty($addimage_name)){
                                header("Location: events.php?adderror=Image is required&$user_data");
                                exit();
                        }
                        else if(empty($addevent_name)){
                                header("Location: events.php?adderror=Event Name is required&$user_data");
                                exit();
                        }
                        else if(strlen($addevent_name) <5){
                                header("Location: events.php?adderror=Event Name is too short must be 5-50 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($addevent_name) >50){
                                header("Location: events.php?adderror=Event Name is too long must be 2-50 characters length&$user_data");
                                exit();
                        }
                        else if(empty($addevent_date)){
                                header("Location: events.php?adderror=Event Date is required&$user_data");
                                exit();
                        }
                        else if(empty($addevent_time)){
                                header("Location: events.php?adderror=Event Time is required&$user_data");
                                exit();
                        }
                        else if(empty($addevent_slot)){
                                header("Location: events.php?adderror=Event Slot is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[0-9]+$/", $addevent_slot)){
                                header("Location: events.php?adderror=Event Slot must contain numbers from 1-250&$user_data");
                                exit();
                        }
                        else if($addevent_slot <1){
                                header("Location: events.php?adderror=Event Slot is not less than 1 &$user_data");
                                exit();
                        }
                        else if($addevent_slot >250){
                                header("Location: events.php?adderror=Event Slot is not more than 250&$user_data");
                                exit();
                        }
                        else
                        {
                                $addevent_name = strtoupper($addevent_name);
                                $sql= "SELECT * FROM admin_event WHERE event_name= '$addevent_name'";
                                $result= mysqli_query($database_connection, $sql);

                                $addimage_name = $_FILES['addimage_name']['name'];
                                $target_dir = "C:\\xampp\htdocs\scpcficlean\img\\";
                                $target_file = $target_dir . basename($_FILES["addimage_name"]["name"]);

                                // Select file type
                                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                                // Valid file extensions
                                $extensions_arr = array("jpg","jpeg","png","gif");


                                if (isset($_POST['addevent_name']))
                                {
                                  
                                        if (mysqli_num_rows($result) > 0) 
                                       {
                                                header("Location: events.php?adderror=The event name is already taken&$user_data");
                                                exit();
                                       } 
                                       else
                                       {
                                                // Check extension
                                                if( in_array($imageFileType,$extensions_arr) )
                                                {
                                                        // Upload file
                                                        if(move_uploaded_file($_FILES['addimage_name']['tmp_name'],$target_dir.$addimage_name))
                                                        {
                                                                // Convert to base64 
                                                                $image_base64 = base64_encode(file_get_contents('C:\xampp\htdocs\scpcficlean\img\\'.$addimage_name) );
                                                                $image = 'data:image\\'.$imageFileType.';base64,'.$image_base64;
                                                                $image_blob = addslashes(file_get_contents('C:\xampp\htdocs\scpcficlean\img\\'.$addimage_name) );
                                                                
                                                                // Insert record
                                                                $sql2= "INSERT INTO admin_event(img_name, event_name, event_date, event_time, event_slot, username) VALUES('$image_blob','$addevent_name', '$addevent_date', '$addevent_time','$addevent_slot', '$_SESSION[username]')";
                                                                $result2= mysqli_query($database_connection, $sql2);

                                                                if($result2)
                                                                {
                                                                                $log_username = $_SESSION['username'];
                                                                                $log_activity = "Add Admin Event"; 
                                                                                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$addevent_name')";
                                                                                $result3= mysqli_query($database_connection, $sql3);
                                                                        header("Location: events.php?addsuccess=Event has been created successfully");
                                                                        exit();
                                                                }
                                                                else
                                                                {
                                                                        header("Location: events.php?adderror=Unknown error occurred&$user_data");
                                                                        exit();
                                                                }
                                                        }
                                                        else
                                                        {
                                                                header("Location: events.php?adderror=Target directory must be existing&$user_data");
                                                                exit();
                                                        }
                            
                                                }
                                                else
                                                {
                                                        header("Location: events.php?adderror=File must be image type&$user_data");
                                                        exit();
                                                }  
                                       }
                                }
                               
                        }

                }
                else
                {
                        header("Location: events.php");
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
                        $data= getPosts();
                        $updateid = $_POST['updateid'];
                        $search_query= "SELECT * FROM admin_event WHERE id= '$updateid'";
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
                                          $updateevent_time= $row['event_time'];
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
                                    header("Location: events.php?updateerror=The ID is not existing&updateid=$updateid");
                                        exit();
                              }

                         
                             
            }

        //TO UPDATE
        if(isset($_POST['update']))
        {
                      
                          
                if (isset($_POST['updateid']) && isset($_POST['updateevent_name']) && isset($_POST['updateevent_date']) && isset($_POST['updateevent_time']) && isset($_POST['updateevent_slot'])) 
                {

                        function validate($data){
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                        }

                        $updateimage_name = validate ($_FILES['updateimage_name']['name']);
                        $updateid = validate ($_POST['updateid']);
                        $updateevent_name = validate ($_POST['updateevent_name']);
                        $updateevent_date = validate ($_POST['updateevent_date']);
                        $updateevent_time = validate ($_POST['updateevent_time']);
                        $updateevent_slot = validate ($_POST['updateevent_slot']);

                        $user_data = 'updateimage_name=' . $updateimage_name.'&updateevent_name=' . $updateevent_name. '&updateevent_date=' . $updateevent_date . '&updateevent_time=' . $updateevent_time . '&updateevent_slot=' . $updateevent_slot. '&updateid=' . $updateid;

                        if(empty($updateid)){
                                header("Location: events.php?updateerror=ID is required&$user_data");
                                exit();
                        }
                        else if(empty($updateevent_name)){
                                header("Location: events.php?updateerror=Event Name is required&$user_data");
                                exit();
                        }
                        else if(strlen($updateevent_name) <5){
                                header("Location: events.php?updateerror=Event Name is too short must be 5-50 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($updateevent_name) >50){
                                header("Location: events.php?updateerror=Event Name is too long must be 2-50 characters length&$user_data");
                                exit();
                        }
                        else if(empty($updateevent_date)){
                                header("Location: events.php?updateerror=Event Date is required&$user_data");
                                exit();
                        }
                        else if(empty($updateevent_time)){
                                header("Location: events.php?updateerror=Event Time is required&$user_data");
                                exit();
                        }
                        else if(empty($updateevent_slot)){
                                header("Location: events.php?updateerror=Event Slot is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[0-9]+$/", $updateevent_slot)){
                                header("Location: events.php?updateerror=Event Slot must contain numbers from 1-250&$user_data");
                                exit();
                        }
                        else if($updateevent_slot <1){
                                header("Location: events.php?updateerror=Event Slot is not less than 1 &$user_data");
                                exit();
                        }
                        else if($updateevent_slot >250){
                                header("Location: events.php?updateerror=Event Slot is not more than 250&$user_data");
                                exit();
                        }
                        else
                        {
                                if(empty($updateimage_name)){
                                        $updateevent_name = strtoupper($updateevent_name);
                                        $sql= "SELECT * FROM admin_event WHERE id= '$updateid'";
                                        $result= mysqli_query($database_connection, $sql);

                                          
                                        if (mysqli_num_rows($result) > 0) 
                                        {
                                       
                                                $id = $_POST['updateid'];
                                                $sql2= "UPDATE admin_event SET event_name='$updateevent_name',event_date='$updateevent_date',event_time='$updateevent_time', event_slot='$updateevent_slot' WHERE id ='$updateid'";

                                                $result2= mysqli_query($database_connection, $sql2);

                                                if($result2)
                                                {
                                                        $log_username = $_SESSION['username'];
                                                                                $log_activity = "Update Admin Event"; 
                                                                                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$updateevent_name')";
                                                                                $result3= mysqli_query($database_connection, $sql3);

                                                        header("Location: events.php?updatesuccess=Event has been updated successfully");
                                                        exit();
                                                }
                                                else
                                                {
                                                        header("Location: events.php?updateerror=Unknown error occurred&$user_data");
                                                        exit();
                                                }                        
                                        } 

                                        else
                                        {
                                                header("Location: events.php?updateerror=The id is not existing&$user_data");
                                                exit();
                                        }
                                }
                                else
                                {
                                        $updateevent_name = strtoupper($updateevent_name);
                                        $sql= "SELECT * FROM admin_event WHERE event_name= '$updateevent_name'";
                                        $result= mysqli_query($database_connection, $sql);

                                        $updateimage_name = $_FILES['updateimage_name']['name'];
                                        $target_dir = "C:\\xampp\htdocs\scpcficlean\img\\";
                                        $target_file = $target_dir . basename($_FILES["updateimage_name"]["name"]);

                                        // Select file type
                                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                                        // Valid file extensions
                                        $extensions_arr = array("jpg","jpeg","png","gif");


                                        if (isset($_POST['updateevent_name']))
                                        {
                                          
                                                if (mysqli_num_rows($result) > 0) 
                                               {
                                                     // Check extension
                                                        if( in_array($imageFileType,$extensions_arr) )
                                                        {
                                                                // Upload file
                                                                if(move_uploaded_file($_FILES['updateimage_name']['tmp_name'],$target_dir.$updateimage_name))
                                                                {
                                                                        // Convert to base64 
                                                                        $image_base64 = base64_encode(file_get_contents('C:\xampp\htdocs\scpcficlean\img\\'.$updateimage_name) );
                                                                        $image = 'data:image\\'.$imageFileType.';base64,'.$image_base64;
                                                                        $image_blob = addslashes(file_get_contents('C:\xampp\htdocs\scpcficlean\img\\'.$updateimage_name) );
                                                                        
                                                                        // Insert record
                                                                        $sql2= "UPDATE admin_event SET img_name='$image_blob', event_name='$updateevent_name',event_date='$updateevent_date',event_time='$updateevent_time', event_slot='$updateevent_slot' WHERE id ='$updateid'";
                                                                        $result2= mysqli_query($database_connection, $sql2);

                                                                        if($result2)
                                                                        {
                                                                                $log_username = $_SESSION['username'];
                                                                                $log_activity = "Update Admin Event"; 
                                                                                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$updateevent_name')";
                                                                                $result3= mysqli_query($database_connection, $sql3);

                                                                                header("Location: events.php?updatesuccess=Event has been created successfully");
                                                                                exit();
                                                                        }
                                                                        else
                                                                        {
                                                                                header("Location: events.php?updateerror=Unknown error occurred&$user_data");
                                                                                exit();
                                                                        }
                                                                }
                                                                else
                                                                {
                                                                        header("Location: events.php?updateerror=Target directory must be existing&$user_data");
                                                                        exit();
                                                                }
                                    
                                                        }
                                                        else
                                                        {
                                                                header("Location: events.php?updateerror=File must be image type&$user_data");
                                                                exit();
                                                        }     
                                               } 
                                               
                                        }
                               
                                }       
                             
                        }
                }
                else
                {
                        header("Location: events.php");
                        exit();
                }
        }

        if(isset($_POST['updaterefresh']))
        {
              header("Location: events.php?#updateevent");
              exit();
        } 
        


//TO SEARCH

        //TO SEARCH
if(isset($_POST['search']))
{         
        $searchinput = $_POST['searchinput']; 

        if(!empty($searchinput))
        {
            
            $log_activity = "Search Admin Event"; 
                              $log_username = $_SESSION['username'];
            $sql= "SELECT * FROM admin_event WHERE id= '$searchinput' OR event_name LIKE '%$searchinput%'";
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
                header("Location: events.php?searcherror=The data is not existing&#listevent");
                exit();
            }
        } 
        else
        {
            header("Location: events.php?searcherror=Search bar is empty&#listevent");
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
        <link rel="stylesheet" href="css/admineventsC.css"/>
        <link rel="stylesheet" type="text/css" href="css/eventsprint.css" media="print" />
        <title>Admin Events | SCPCFI</title>
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
        <form action="events.php" method="post" enctype="multipart/form-data">


                <?php if (isset($_GET['addimage_name'])) { ?>
                <input class="btn btn-primary" type="file" 
                name="addimage_name"
                value="<?php echo $_GET['addimage_name']; ?>"> <br><br>
                <?php }else{ ?>
                <input class="btn btn-primary" type="file" 
                name="addimage_name" 
                value="<?php echo $addimage_name; ?>"> <br><br>
                <?php }?>


                <label>Event Name</label>
                <?php if (isset($_GET['addevent_name'])) { ?>
                <input type="text" 
                name="addevent_name" 
                placeholder="Event Name"
                value="<?php echo $_GET['addevent_name']; ?>"> 
                <?php }else{ ?>
                <input type="text" 
                name="addevent_name" 
                placeholder="Event Name"
                value="<?php echo $addevent_name; ?>"> 
                <?php }?> 


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

                <label>Event Time</label>

                <?php if (isset($_GET['addevent_time'])) { ?>
                <input type="time" 
                name="addevent_time" 
                placeholder="Event time"
                value="<?php echo $_GET['addevent_time']; ?>"> 
                <?php }else{ ?>
                <input type="time" 
                name="addevent_time" 
                placeholder="Event time"
                value="<?php echo $addevent_time; ?>"> 
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

        <form action="events.php" method="post" enctype="multipart/form-data">
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

                        <?php if (isset($_GET['updateimage_name'])) { ?>
                        <input class="btn btn-primary" type="file" 
                        name="updateimage_name"
                        value="<?php echo $_GET['updateimage_name']; ?>"> <br><br>
                        <?php }else{ ?>
                        <input class="btn btn-primary" type="file" 
                        name="updateimage_name" 
                        value="<?php echo $updateimage_name; ?>"> <br><br>
                        <?php }?>
                
                        <label>Event Name</label>
                        <?php if (isset($_GET['updateevent_name'])) { ?>
                        <input type="text" 
                        name="updateevent_name" 
                        placeholder="Event Name"
                        value="<?php echo $_GET['updateevent_name']; ?>"> 
                        <?php }else{ ?>
                        <input type="text" 
                        name="updateevent_name" 
                        placeholder="Event Name"
                        value="<?php echo $updateevent_name; ?>"> 
                        <?php }?> 


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

                        <label>Event Time</label>

                        <?php if (isset($_GET['updateevent_time'])) { ?>
                        <input type="time" 
                        name="updateevent_time" 
                        placeholder="Event time"
                        value="<?php echo $_GET['updateevent_time']; ?>"> 
                        <?php }else{ ?>
                        <input type="time" 
                        name="updateevent_time" 
                        placeholder="Event time"
                        value="<?php echo $updateevent_time; ?>"> 
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

                        <div class="row">
                                <div class="col-6">
                                        <input class="btn btn-primary btninput" type="submit" name="update" value="UPDATE">
                                </div>
                                <div class="col-6">
                                        <input class="btn btn-primary btninput" type="submit" name="updaterefresh" action="events.php" value="REFRESH">
                                </div>
                        </div>
                 
                </div>
        </form>

        <form action="events.php" method="post" enctype="multipart/form-data">
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
                      <a class="dropdown-item" href="events.php?#listevent">Refresh</a>
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

                $sql= "SELECT * FROM admin_event WHERE id= '$searchinput' OR event_name LIKE '%$searchinput%'";
                $result= mysqli_query($database_connection, $sql);

                if (mysqli_num_rows($result) > 0) 
                {

                echo "<div class='container-fluid table'><table>";

                echo "<thead><tr><th>Image</th><th class='idth'>Id</th><th class='nameth'>Name</th><th>Date</th><th>Time</th><th>Slots</th><th>Added by</th><th>Timestamp</th><th></th></tr></thead>";

                while ($row = mysqli_fetch_assoc($result)) 
                {
               echo "<tr class='infos'><td class='imagetd'><img class='imgtable' src='data:image;base64," .base64_encode($row['img_name']). "' ></td><td class='idtd'>{$row['id']}</td><td class='nametd'><div class='wrapname'><a class='tableview' href='events.php?viewid={$row['id']}'>{$row['event_name']}</a></div></td><td>{$row['event_date']}</td><td>{$row['event_time']}</td><td>{$row['event_slot']}</td><td>{$row['username']}</td><td>{$row['dateadded']}</td><td><a   href='events.php?id={$row['id']}'><button type='button' class='btn btn-primary actions' value='DELETE'>DELETE</button></a></td></tr>";
                }

                echo "</table></div>";                                                                  
                }
                else
                {
                
                $sql = "SELECT * FROM admin_event";
                $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

                echo "<div class='container-fluid table'><table>";

                echo "<thead><tr><th>Image</th><th class='idth'>Id</th><th class='nameth'>Name</th><th>Date</th><th>Time</th><th>Slots</th><th>Added by</th><th>Timestamp</th><th></th></tr></thead>";

                while ($row = mysqli_fetch_assoc($result)) 
                {
                echo "<tr class='infos'><td class='imagetd'><img class='imgtable' src='data:image;base64," .base64_encode($row['img_name']). "' ></td><td class='idtd'>{$row['id']}</td><td class='nametd'><div class='wrapname'><a class='tableview' href='events.php?viewid={$row['id']}'>{$row['event_name']}</a></div></td><td>{$row['event_date']}</td><td>{$row['event_time']}</td><td>{$row['event_slot']}</td><td>{$row['username']}</td><td>{$row['dateadded']}</td><td><a   href='events.php?id={$row['id']}'><button type='button' class='btn btn-primary actions' value='DELETE'>DELETE</button></a></td></tr>";
                //echo '<img src="data:image;base64,' .base64_encode($row['img_name']). '"style="width:100px;" >';
                }

                echo "</table></div>";


                }
        }
                        else
                {
                
                $sql = "SELECT * FROM admin_event";
                $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

                echo "<div class='container-fluid table'><table>";

                echo "<thead><tr><th>Image</th><th class='idth'>Id</th><th class='nameth'>Name</th><th>Date</th><th>Time</th><th>Slots</th><th>Added by</th><th>Timestamp</th><th></th></tr></thead>";

                while ($row = mysqli_fetch_assoc($result)) 
                {
                echo "<tr class='infos'><td class='imagetd'><img class='imgtable' src='data:image;base64," .base64_encode($row['img_name']). "' ></td><td class='idtd'>{$row['id']}</td><td class='nametd'><div class='wrapname'><a class='tableview' href='events.php?viewid={$row['id']}'>{$row['event_name']}</a>div></td><td>{$row['event_date']}</td><td>{$row['event_time']}</td><td>{$row['event_slot']}</td><td>{$row['username']}</td><td>{$row['dateadded']}</td><td><a   href='events.php?id={$row['id']}'><button type='button' class='btn btn-primary actions' value='DELETE'>DELETE</button></a></td></tr>";
                //echo '<img src="data:image;base64,' .base64_encode($row['img_name']). '"style="width:100px;" >';
                }

                echo "</table></div>";


                }
}
                else
                {
                
                $sql = "SELECT * FROM admin_event";
                $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

                echo "<div class='container-fluid table'><table>";

                echo "<thead><tr><th>Image</th><th class='idth'>Id</th><th class='nameth'>Name</th><th>Date</th><th>Time</th><th>Slots</th><th>Added by</th><th>Timestamp</th><th></th></tr></thead>";

                while ($row = mysqli_fetch_assoc($result)) 
                {
                echo "<tr class='infos'><td class='imagetd'><img class='imgtable' src='data:image;base64," .base64_encode($row['img_name']). "' ></td><td class='idtd'>{$row['id']}</td><td class='nametd'><div class='wrapname'><a class='tableview' href='events.php?viewid={$row['id']}'>{$row['event_name']}</a></div></td><td>{$row['event_date']}</td><td>{$row['event_time']}</td><td>{$row['event_slot']}</td><td>{$row['username']}</td><td>{$row['dateadded']}</td><td><a   href='events.php?id={$row['id']}'><button type='button' class='btn btn-primary actions' value='DELETE'>DELETE</button></a></td></tr>";
                //echo '<img src="data:image;base64,' .base64_encode($row['img_name']). '"style="width:100px;" >';
                }

                echo "</table></div>";


                }
  ?>
  <?php if(isset($_GET['id'])){  
    $sql = "SELECT * FROM admin_event WHERE id='$_GET[id]'";
    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");    
    if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) 
    { 
$idb= $row['id'];
$img_nameb= $row['img_name'];
$event_nameb= $row['event_name'];
$event_dateb= $row['event_date'];
$event_timeb= $row['event_time'];
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
<!--         <div class="row">
                <div class="col-12">
       <?php //echo "<img class='imgview' src='data:image;base64," .base64_encode($row['img_name']). "' >"; ?>
</div>
</div> -->
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
                        Time
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_timeb; ?></p>
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
        <a class='btn btn-primary' type='submit' name='delete' value='DELETE' href='deleteadminevent.php?id=<?php echo $idb; ?>&event_name=<?php echo $event_nameb; ?>'>Yes</a>
      </div>
    </div>
  </div>
</div>  
<?php    
} }
}
?>

  <?php if(isset($_GET['viewid'])){  
    $sql = "SELECT * FROM admin_event WHERE id='$_GET[viewid]'";
    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");    
    if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) 
    { 
$idbc= $row['id'];
$img_namebc= $row['img_name'];
$event_namebc= $row['event_name'];
$event_datebc= $row['event_date'];
$event_timebc= $row['event_time'];
$event_slotbc= $row['event_slot'];
?>
  <!-- Modal -->
<div class="modal fade" id="exampleModalb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Church Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
                <div class="col-12">
       <?php echo "<img class='eventimg' src='data:image;base64," .base64_encode($row['img_name']). "'style='width:100%' >"; ?>
</div>
</div>
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
                        Time
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_timebc; ?></p>
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