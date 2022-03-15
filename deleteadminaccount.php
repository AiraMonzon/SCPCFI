<?php
session_start();
      error_reporting(0);
            include 'databaseconnection.php';

//TO DELETE
$id = $_GET['id'];
$username = $_GET['username'];
                                                $log_username = $_SESSION['username'];
                                                $log_activity = "Delete Admin"; 
                      $user_data = 'id=' . $id.'&username=' . $username;
                      $success =$username. ' has been deleted successfully';


                              $sql= "SELECT * FROM admins WHERE id= '$id'";
                              $result= mysqli_query($database_connection, $sql);

                             if (mysqli_num_rows($result) > 0) 
                             {
                                              
                                              $sql2 = "DELETE FROM admins WHERE id ='$id' ";
                                              $result2 = mysqli_query($database_connection, $sql2);

                                              if($result2)
                                              {
                                                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$username')";
                                                $result3= mysqli_query($database_connection, $sql3);
                                              header("Location: settings.php?deletesuccess=$success&#listaccount");
                                               exit();
                                               }
                                              else
                                              {
                                              header("Location: settings.php?searcherror=Unknown error occurred&$user_data");
                                              exit();
                                              } 
                                }     
                                else
                                     {


                              header("Location: settings.php?error=The ID is not existing&$user_data");
                              exit();
                                      }
                              
                      


?>