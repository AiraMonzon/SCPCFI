<?php      
error_reporting(0);
include 'databaseconnection.php';
session_start();
$log_username = $_SESSION['username'];
$log_activity = "Logout"; 
$log_admin = "Admin"; 

                if(empty($log_username)){
                        header("Location:index.php");
                        exit();
                }else{
                        $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$log_admin')";
                        $result3= mysqli_query($database_connection, $sql3);
                }


session_unset();
session_destroy();
unset($_SESSION["id"]);
unset($_SESSION["name"]);

header("Location:index.php");
?>