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

               if (isset($_POST['search'])) 
        {
                $searchinput = $_POST['searchinput'];

                if(!empty($searchinput))
                {

                $sql2log_record = "SELECT * FROM log_record WHERE log_username LIKE '%$searchinput%' OR log_activity LIKE '%$searchinput%' OR log_details LIKE '%$searchinput%' OR log_id= '$searchinput' OR log_time= '$searchinput' OR  log_date= '$searchinput'";
                $result2log_record = mysqli_query($database_connection, $sql2log_record) or die("Bad Query: $sql");

                
                if(mysqli_num_rows($result2log_record)){
                        $searchsuccess = "Found ". mysqli_num_rows($result2log_record)." records successfully!";
                }
                 else{
                         header("Location: adminlogrecords.php?searcherror=The ID is not existing&#logrecord");
                    exit();
                }
                }

                else{
                        header("Location: adminlogrecords.php?searcherror=Search bar is empty&#logrecord");
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
        <link rel="stylesheet" href="css/adminlogrecordsC.css"/>
        <link rel="stylesheet" type="text/css" href="css/eventsprint.css" media="print" />
        <title>Admin Log Records | SCPCFI</title>
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
                  <a><b>RECORDS</b></a>
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
<form action="adminlogrecords.php" method="post">
<section class="page-section" id="logrecord">
        <div class="heading">
                <div class='row'>
                <div class='col-4'>
                <h1>LOG RECORDS</h1>
                </div>
                <div class='col-5'>
                <div class="input-group">
                      <?php if (isset($_GET['searchinput'])) { ?>
                      <input class="form-control" type="text" 
                      name="searchinput" 
                      placeholder="Enter log data . . .";
                      value="<?php echo $_GET['searchinput']; ?>">
                      <?php }else{ ?>
                      <input class="form-control" type="text" 
                      name="searchinput" 
                      placeholder="Enter log data . . ."
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
                      <a class="dropdown-item" href="adminlogrecords.php?#logrecord">Refresh</a>
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

        if (isset($_POST['search'])) 
        {
                $searchinput = $_POST['searchinput'];
                if(!empty($searchinput))
                {
                        $sql2 = "SELECT * FROM log_record WHERE log_username LIKE '%$searchinput%' OR log_activity LIKE '%$searchinput%' OR log_details LIKE '%$searchinput%' OR log_id= '$searchinput' OR log_time= '$searchinput' OR  log_date= '$searchinput'";
                        $result2 = mysqli_query($database_connection, $sql2) or die("Bad Query: $sql");

                        if(mysqli_num_rows($result2) > 0){
                        echo "<table>";

                        echo "<thead><tr><th class='idth'>Id</th><th>Date</th><th>Time</th><th class='nameth'>Username</th><th>Activity</th><th>Details</th></tr></thead>";


                        while ($row = mysqli_fetch_assoc($result2)) 
                        {
                        echo "<tr class='infos'><td class='idtd'>{$row['log_id']}</td><td>{$row['log_date']}</td><td>{$row['log_time']}</td><td class='nametd'><div class='wrapname'><a class='tableview' href='eventdetail.php?eventname={$row['log_username']}'>{$row['log_username']}</a></div></td><td>{$row['log_activity']}</td><td>{$row['log_details']}</td></tr>";

                        }

                        echo "</table>";                
                        }

                        else{
                        $allsql = "SELECT * FROM log_record";
                        $allresult = mysqli_query($database_connection, $allsql) or die("Bad Query: $sql");
                                        echo "<table>";

                                        echo "<thead><tr><th class='idth'>Id</th><th>Date</th><th>Time</th><th class='nameth'>Username</th><th>Activity</th><th>Details</th></tr></thead>";
                        while ($row = mysqli_fetch_assoc($allresult)) 
                        {
                        echo "<tr class='infos'><td class='idtd'>{$row['log_id']}</td><td>{$row['log_date']}</td><td>{$row['log_time']}</td><td class='nametd'><div class='wrapname'><a class='tableview' href='eventdetail.php?eventname={$row['log_username']}'>{$row['log_username']}</a></div></td><td>{$row['log_activity']}</td><td>{$row['log_details']}</td></tr>";

                        }
                        echo "</table>";   
                        }

                        }

                
        }
                        else{
                        $allsql = "SELECT * FROM log_record";
                        $allresult = mysqli_query($database_connection, $allsql) or die("Bad Query: $sql");
                                        echo "<table>";

                                        echo "<thead><tr><th class='idth'>Id</th><th>Date</th><th>Time</th><th class='nameth'>Username</th><th>Activity</th><th>Details</th></tr></thead>";
                        while ($row = mysqli_fetch_assoc($allresult)) 
                        {
                        echo "<tr class='infos'><td class='idtd'>{$row['log_id']}</td><td>{$row['log_date']}</td><td>{$row['log_time']}</td><td class='nametd'><div class='wrapname'><a class='tableview' href='eventdetail.php?eventname={$row['log_username']}'>{$row['log_username']}</a></div></td><td>{$row['log_activity']}</td><td>{$row['log_details']}</td></tr>";

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