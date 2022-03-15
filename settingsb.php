<?php

                 
                  
          

                function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }
                

                $first_name = validate ($_POST['first_name']);

                         $first_name = strtoupper($first_name);
                        $sql= "SELECT * FROM admins WHERE first_name= '$first_name'";
                        $result= mysqli_query($database_connection, $sql);
                        $sql2= "SELECT * FROM admins WHERE first_name= '$first_name'";
                        $result2= mysqli_query($database_connection, $sql2);

                        if (isset($_POST['first_name']))
                        {
                                
                                $sql2= "INSERT INTO admins(first_name)";

                                $result2= mysqli_query($database_connection, $sql2);
                        }
                       
                

            
    ?>