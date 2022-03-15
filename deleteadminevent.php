<?php
session_start();
      error_reporting(0);
            include 'databaseconnection.php';

//TO DELETE
$id = $_GET['id'];
$event_name = $_GET['event_name'];
                      $user_data = 'id=' . $id.'&event_name=' . $event_name;
                      $success =$event_name. ' has been deleted successfully';

$log_username = $_SESSION['username']; 
                                                $log_activity = "Delete Admin Event"; 
                              $sql= "SELECT * FROM admin_event WHERE id= '$id'";
                              $result= mysqli_query($database_connection, $sql);

                             if (mysqli_num_rows($result) > 0) 
                             {
                                              
                                              $sql2 = "DELETE FROM admin_event WHERE id ='$id' ";
                                              $result2 = mysqli_query($database_connection, $sql2);

                                              if($result2)
                                              {
                                                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$event_name')";
                                                $result3= mysqli_query($database_connection, $sql3);

                                              header("Location: events.php?deletesuccess=$success&#listevent");
                                               exit();
                                               }
                                              else
                                              {
                                              header("Location: events.php?searcherror=Unknown error occurred&$user_data");
                                              exit();
                                              } 
                                }     
                                else
                                     {


                              header("Location: events.php?error=The ID is not existing&$user_data");
                              exit();
                                      }
                              
                      



?>