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
                        header("Location: userlogin.php?error=Username is required");
                        exit();
                }

                else if(empty($password))
                {
                        header("Location: userlogin.php?error=Password is required");
                        exit();
                }

                else
                {
                        $password = md5($password);
                        $sql= "SELECT * FROM users WHERE username= '$username' AND password= '$password'";
                        $result= mysqli_query($database_connection, $sql);
                        $adminsql= "SELECT * FROM admins WHERE username= '$username' AND password= '$password'";
                        $adminresult= mysqli_query($database_connection, $adminsql);
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
                                       header("Location: userhome.php");
                                       exit();
                                }
                                
                                else 
                                {
                                        header("Location: userlogin.php?error=Incorrect Username or Password");
                                        exit();
                                }
                        }               
                        else if (mysqli_num_rows($adminresult) === 1) 
                        {
                                $row = mysqli_fetch_assoc($adminresult);
                                
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
                                       header("Location: adminhome.php");
                                       exit();
                                }
                                
                                else 
                                {
                                        header("Location: userlogin.php?error=Incorrect Username or Password");
                                        exit();
                                }
                        }
                        else 
                        {
                                header("Location: userlogin.php?error=Incorrect Username or Password");
                                exit();
                        }
                }

        }
        
        else
        {
                header("Location: userlogin.php");
                exit();
        }
?>