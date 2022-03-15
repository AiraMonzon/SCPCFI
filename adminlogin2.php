<?php
        session_start();
        include "databaseconnection.php";
        
        if (isset($_POST['username']) && isset($_POST['password'])) 
        {
                function validate($data)
                {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }
                
                $username = validate ($_POST['username']);
                $password = validate ($_POST['password']);
                $forcookiepassword = $_POST['password'];
                if(empty($username))
                {
                        header("Location: adminlogin.php?error=Username is required");
                        exit();
                }

                else if(empty($password))
                {
                        header("Location: adminlogin.php?error=Password is required");
                        exit();
                }

                else
                {       
                        $password = md5($password);
                        $sql= "SELECT * FROM admins WHERE username= '$username' AND password= '$password'";
                        $result= mysqli_query($database_connection, $sql);

                        if (mysqli_num_rows($result) === 1) 
                        {
                                $row = mysqli_fetch_assoc($result);
                                
                                if($row['username'] === $username && $row['password'] === $password)
                                {
                                        if(!empty($_POST["rememberme"]))   
                                           {  
                                            setcookie ("scpcfiusername",$username,time()+ (10 * 365 * 24 * 60 * 60));  
                                            setcookie ("scpcfipassword",$forcookiepassword,time()+ (10 * 365 * 24 * 60 * 60));
                                            $_SESSION["username"] = $username;
                                           }  
                                           else  
                                           {  
                                            if(isset($_COOKIE["scpcfiusername"]))   
                                            {  
                                             setcookie ("scpcfiusername","");  
                                            }  
                                            if(isset($_COOKIE["scpcfipassword"]))   
                                            {  
                                             setcookie ("scpcfipassword","");  
                                            }  
                                           }
                                       $_SESSION['username'] = $row['username'];
                                       $_SESSION['first_name'] = $row['first_name'];
                                       $_SESSION['id'] = $row['id'];
                                       $_SESSION['email'] = $row['email'];

                                        $log_username = $row['username'];
                                        $log_activity = "Login"; 
                                        $log_admin = "Admin"; 
                                       $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$log_admin')";
                        $result3= mysqli_query($database_connection, $sql3);

                                       header("Location: adminhome.php");
                                       exit();
                                }
                                
                                else 
                                {
                                        header("Location: adminlogin.php?error=Incorrect Username or Password");
                                        exit();
                                }
                        }               
                        
                        else 
                        {
                                header("Location: adminlogin.php?error=Incorrect Username or Password");
                                exit();
                        }
                }

        }
        
        else
        {
                header("Location: adminlogin.php");
                exit();
        }
?>