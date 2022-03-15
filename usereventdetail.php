<?php 
	session_start();
	if(isset($_GET['eventname']))
	{
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/eventdetail.css"/>
        <title>SCPCFI User Home</title>
</head>        
<body>
        <header>
                <img class="banner" src="css/head.png"><br>
                </header>

<nav class="navbar navbar-expand-sm">
        <a class="navbar-brand" ><?php
                echo "Date: ".date("m/d/y") ;
                echo " Time: ".date("h:i:s:a") ;
                ?></a>
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="">About</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="userhome.php">Home</a>
    </li>
          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Events
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="userviewchurchevents.php">Church Events</a>
          <a class="dropdown-item" href="userviewmemberevents.php">Member Events</a>
          <a class="dropdown-item" href="userevents.php">My Events</a>
      </li>
    <li class="nav-item">
      <a class="nav-link" href="usersettings.php">My Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="">Messages</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>


  </ul>
<a class="navbar-brand ml-auto" ><i>Hello, <?php echo $_SESSION['first_name']; ?></i></a>

</nav>

<!--start-->

<div class="col-12">
      <div class="container-fluid  my-container">

<?php
include 'databaseconnection.php';
$event_name = $_GET['eventname'];
$sql = "SELECT * FROM admin_event WHERE event_name='$event_name'";
                              $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

        echo "<table>";

        echo "<thead><tr><th>Image</th><th>Id</th><th>Event Name</th><th>Event Date</th><th>Event Time</th><th>No. of slots available</th><th>Added by</th><th>Timestamp</th></tr></thead>";
        
        while ($row = mysqli_fetch_assoc($result)) 
        {
        echo "<tr><td><img src='data:image;base64," .base64_encode($row['img_name']). "'style='width:50px;' ></td><td>{$row['id']}</td><td>{$row['event_name']}</td><td>{$row['event_date']}</td><td>{$row['event_time']}</td><td>{$row['event_slot']}</td><td>{$row['username']}</td><td>{$row['dateadded']}</td></tr>";
                           echo "<div class'row'>
                <h1>{$row['event_name']}</h1>
                </div>";
        echo '<img src="data:image;base64,' .base64_encode($row['img_name']). '" ><br><br>';

        echo "<div class='row'>
                <div class='col-6'><p class='head'>EVENT ID</p></div>
                <div class='col-6'><p>{$row['id']}</p></div>
                </div><div class='row'>
                <div class='col-6'><p class='head'>EVENT NAME</p></div>
                <div class='col-6'><p>{$row['event_name']}</p></div>
                </div><div class='row'>
                <div class='col-6'><p class='head'>EVENT DATE</p></div>
                <div class='col-6'><p>{$row['event_date']}</p></div>
                </div><div class='row'>
                <div class='col-6'><p class='head'>EVENT TIME</p></div>
                <div class='col-6'><p>{$row['event_time']}</p></div>
                </div><div class='row'>
                <div class='col-6'><p class='head'>EVENT SLOT</p></div>
                <div class='col-6'><p>{$row['event_slot']}</p></div>
                </div><div class='row'>
                <div class='col-6'><p class='head'>EVENT ADDED BY</p></div>
                <div class='col-6'><p>{$row['username']}</p></div>
                </div><div class='row'>
                <div class='col-6'><p class='head'>EVENT DATE ADDED</p></div>
                <div class='col-6'><p>{$row['dateadded']}</p></div>
                </div>";
        }
        
        echo "</table>";
?>

</div></div>
<!-- Footer -->
<footer>
  <!-- Copyright -->
@SCPCFILaguna:
    <a class="index" href = "index.php">Sanctuary of the Chosen People Christian Fellowship Inc.</a><br>

        <nav class="navbar2 navbar-expand-sm">

<ul class="navbar-nav centering">
    <li class="nav-item ">
      <a class="nav-link" href="adminabout.php">About</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="adminhome.php">Home</a>
    </li>
          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Accounts
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="settings.php">Administrator Accounts</a>
          <a class="dropdown-item" href="members.php">Member Accounts</a>
      </li>
          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Events
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="events.php">Administrator Events</a>
          <a class="dropdown-item" href="memberevents.php">Member Events</a>
      </li>
    <li class="nav-item">
      <a class="nav-link" href="adminmyprofile.php">My Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>


  </ul>

</nav>
  <!-- Copyright -->
</footer>
<!-- Footer -->


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<?php
	}
	else
	{

		header("Location: userevents.php");

		exit();
	}
?>