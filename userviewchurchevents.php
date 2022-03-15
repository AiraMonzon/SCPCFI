<?php 
      session_start();

      if(isset($_SESSION['id']) && isset($_SESSION['username']))
      {
?>
<?php

            include 'databaseconnection.php';
            $searchinput ="";
        if (isset($_POST['search'])) 
        {
                $searchinput = $_POST['searchinput'];

                if(!empty($searchinput))
                {

            $sql2 = "SELECT * FROM admin_event WHERE event_name LIKE '%$searchinput%' OR event_time= '$searchinput' OR  event_date= '$searchinput' OR event_slot= '$searchinput' OR username LIKE '%$searchinput%' OR  dateadded= '$searchinput'";
          $result2 = mysqli_query($database_connection, $sql2) or die("Bad Query: $sql");

                
                if(mysqli_num_rows($result2)){
                        $searchsuccess = "Found ". mysqli_num_rows($result2)." records successfully!";
                }
                 else{
                         header("Location: userviewchurchevents.php?searcherror=The event is not existing&#churchevents");
                    exit();
                }
                }

                else{
                        header("Location: userviewchurchevents.php?searcherror=Search bar is empty&#churchevents");
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
      <link rel="stylesheet" href="css/userchurcheventsB.css">
      <title>Member Church Events | SCPCFI</title>
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
  <form action="userviewchurchevents.php" method="post">
  <section class="page-section" id="churchevents">
        <div class="heading">
                <div class='row'>
                <div class='col-4'>
                <h1>Church Events</h1>
                </div>
                <div class='col-5'>
                <div class="input-group">
                      <?php if (isset($_GET['searchinput'])) { ?>
                      <input class="form-control" type="text" 
                      name="searchinput" 
                      placeholder="Enter church events . . .";
                      value="<?php echo $_GET['searchinput']; ?>">
                      <?php }else{ ?>
                      <input class="form-control" type="text" 
                      name="searchinput" 
                      placeholder="Enter church events . . ."
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
                      <button class="btn btn-primary actions" type="button" onclick="window.location='userviewchurchevents.php?#churchevents'">Refresh</button>
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
   

            <?php

if (isset($_POST['search'])) 
{
    $searchinput = $_POST['searchinput'];              
        if(!empty($searchinput))
        {        
              $sql = "SELECT * FROM admin_event WHERE event_name LIKE '%$searchinput%' OR event_time= '$searchinput' OR  event_date= '$searchinput' OR event_slot= '$searchinput' OR username LIKE '%$searchinput%' OR  dateadded= '$searchinput'";
              $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

              if(mysqli_num_rows($result) > 0)
              {
                  echo "<div class='container-fluid table'><table>";

                  echo "<thead><tr><th>Image</th><th>Event Name</th><th>Event Date</th><th>Event Time</th><th class='idth'>Slots</th><th>Added by</th><th>Timestamp</th></tr></thead>";

                  while ($row = mysqli_fetch_assoc($result)) 
                  {
                  echo "<tr class='infos'><td class='imagetd'><img class='imgtable' src='data:image;base64," .base64_encode($row['img_name']). "' ></td><td><div class='wrapname'><a class='tableview' href='userviewchurchevents.php?viewid={$row['id']}'>{$row['event_name']}</a></div></td><td>{$row['event_date']}</td><td>{$row['event_time']}</td><td class='idtd'>{$row['event_slot']}</td><td>{$row['username']}</td><td>{$row['dateadded']}</td></tr>";
                  }

                  echo "</table></div>";  
              }

              else
              {
                    $sql = "SELECT * FROM admin_event";
                    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

                    echo "<div class='container-fluid table'><table>";

                  echo "<thead><tr><th>Image</th><th>Event Name</th><th>Event Date</th><th>Event Time</th><th class='idth'>Slots</th><th>Added by</th><th>Timestamp</th></tr></thead>";

                  while ($row = mysqli_fetch_assoc($result)) 
                  {
                  echo "<tr class='infos'><td class='imagetd'><img class='imgtable' src='data:image;base64," .base64_encode($row['img_name']). "' ></td><td><div class='wrapname'><a class='tableview' href='userviewchurchevents.php?viewid={$row['id']}'>{$row['event_name']}</a></div></td><td>{$row['event_date']}</td><td>{$row['event_time']}</td><td class='idtd'>{$row['event_slot']}</td><td>{$row['username']}</td><td>{$row['dateadded']}</td></tr>";
                  }

                  echo "</table></div>";  
              }
        }
                      else
              {
                    $sql = "SELECT * FROM admin_event";
                    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

                    echo "<div class='container-fluid table'><table>";

                  echo "<thead><tr><th>Image</th><th>Event Name</th><th>Event Date</th><th>Event Time</th><th class='idth'>Slots</th><th>Added by</th><th>Timestamp</th></tr></thead>";

                  while ($row = mysqli_fetch_assoc($result)) 
                  {
                  echo "<tr class='infos'><td class='imagetd'><img class='imgtable' src='data:image;base64," .base64_encode($row['img_name']). "' ></td><td><div class='wrapname'><a class='tableview' href='userviewchurchevents.php?viewid={$row['id']}'>{$row['event_name']}</a></div></td><td>{$row['event_date']}</td><td>{$row['event_time']}</td><td class='idtd'>{$row['event_slot']}</td><td>{$row['username']}</td><td>{$row['dateadded']}</td></tr>";
                  }

                  echo "</table></div>";   
              }

                
}
else
{
      $sql = "SELECT * FROM admin_event";
      $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

     echo "<div class='container-fluid table'><table>";

                  echo "<thead><tr><th>Image</th><th>Event Name</th><th>Event Date</th><th>Event Time</th><th class='idth'>Slots</th><th>Added by</th><th>Timestamp</th></tr></thead>";

                  while ($row = mysqli_fetch_assoc($result)) 
                  {
                  echo "<tr class='infos'><td class='imagetd'><img class='imgtable' src='data:image;base64," .base64_encode($row['img_name']). "' ></td><td><div class='wrapname'><a class='tableview' href='userviewchurchevents.php?viewid={$row['id']}'>{$row['event_name']}</a></div></td><td>{$row['event_date']}</td><td>{$row['event_time']}</td><td class='idtd'>{$row['event_slot']}</td><td>{$row['username']}</td><td>{$row['dateadded']}</td></tr>";
                  }

                  echo "</table></div>";   
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
