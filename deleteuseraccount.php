<?php
session_start();
      error_reporting(0);
            include 'databaseconnection.php';

//TO DELETE
$id = $_GET['id'];
$username = $_GET['username'];
                      $user_data = 'id=' . $id.'&username=' . $username;
                      $success =$username. ' has been deleted successfully';

$log_username = $_SESSION['username'];
                                                $log_activity = "Delete Member"; 
                              $sql= "SELECT * FROM users WHERE id= '$id'";
                              $result= mysqli_query($database_connection, $sql);

                             if (mysqli_num_rows($result) > 0) 
                             {
                                              
                                              $sql2 = "DELETE FROM users WHERE id ='$id' ";
                                              $result2 = mysqli_query($database_connection, $sql2);

                                              if($result2)
                                              {
                                                $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$username')";
                                                $result3= mysqli_query($database_connection, $sql3);
                                              header("Location: members.php?deletesuccess=$success&#listaccount");
                                               exit();
                                               }
                                              else
                                              {
                                              header("Location: members.php?searcherror=Unknown error occurred&$user_data");
                                              exit();
                                              } 
                                }     
                                else
                                     {


                              header("Location: members.php?error=The ID is not existing&$user_data");
                              exit();
                                      }
                              
                      


?>