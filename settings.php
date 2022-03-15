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

                    function getPosts()
                    {
                          $posts= array();
                          $posts[0]= $_POST['id'];
                          $posts[1]= $_POST['first_name'];
                          $posts[2]= $_POST['middle_name'];
                          $posts[3]= $_POST['last_name'];
                          $posts[4]= $_POST['email'];
                          $posts[5]= $_POST['phone'];
                          $posts[6]= $_POST['housestreet'];
                          $posts[7]= $_POST['baranggay'];
                          $posts[8]= $_POST['city'];
                          $posts[9]= $_POST['province'];
                          $posts[10]= $_POST['zp'];
                          $posts[11]= $_POST['birthdate'];
                          
                          $posts[12]= $_POST['username'];
                          $posts[13]= $_POST['password'];

                
                     
                          return $posts;
                          $gender = $_POST['gender'];

                    }
        //TO SEARCH
        if(isset($_POST['search']))
        {         
                $searchinput = $_POST['searchinput']; 

                if(!empty($searchinput))
                {
                    $log_activity = "Search Admin"; 
                    $log_username = $_SESSION['username'];
                    $data= getPosts();
                    $search_query= "SELECT * FROM admins WHERE id= '$searchinput' OR first_name LIKE '%$searchinput%' OR middle_name LIKE '%$searchinput%' OR last_name LIKE '%$searchinput%' OR email LIKE '%$searchinput%' OR phone LIKE '%$searchinput%' OR housestreet LIKE '%$searchinput%' OR baranggay LIKE '%$searchinput%' OR city LIKE '%$searchinput%' OR province LIKE '%$searchinput%' OR zp LIKE '%$searchinput%' OR birthdate LIKE '%$searchinput%' OR gender= '$searchinput' OR username LIKE '%$searchinput%'";
                    $search_result= mysqli_query($database_connection, $search_query);                      
                                          
                    if(mysqli_num_rows($search_result))
                    {
                        $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$searchinput')";
                        $result3= mysqli_query($database_connection, $sql3);
                        
                        if(mysqli_num_rows($search_result) ==1)
                        {
                           
                            $searchsuccess = "Found ". mysqli_num_rows($search_result)." record successfully!";
                        }
                        else
                        {
                            
                            $searchsuccess = "Found ". mysqli_num_rows($search_result)." records successfully!";
                        }
                    }
                    else
                    {
                        header("Location: settings.php?searcherror=The data is not existing&#listaccount");
                        exit();
                    }
                } 
                else
                {
                    header("Location: settings.php?searcherror=Search bar is empty&#listaccount");
                    exit();
                }
        }   
        //TO ADD
                    if(isset($_POST['add']))
                    {
                         
                          
                  

                        function validate($data){
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                        }
                        
                        $addusername = validate ($_POST['addusername']);
                        $addpassword = validate ($_POST['addpassword']);
                        $addrepassword = validate ($_POST['addrepassword']);
                        $addfirst_name = validate ($_POST['addfirst_name']);
                        $addmiddle_name = validate ($_POST['addmiddle_name']);
                        $addlast_name = validate ($_POST['addlast_name']);
                        $addemail = validate ($_POST['addemail']);
                        $addphone = validate ($_POST['addphone']);
                        $addhousestreet = validate ($_POST['addhousestreet']);
                        $addbaranggay = validate ($_POST['addbaranggay']);
                        $addcity = validate ($_POST['addcity']);
                        $addprovince = validate ($_POST['addprovince']);
                        $addzp = validate ($_POST['addzp']);
                        $addgender = validate ($_POST['addgender']);              
                        $addbirthdate = validate ($_POST['addbirthdate']);

                        if(!empty($addphone)){
                          $addphone = str_replace([' ', '.', '-', '(', ')'], '', $addphone);
                        $addphone = str_replace(['+63'], '0', $addphone);
                        $addphone = substr_replace($addphone, "09", 0, 2);

                                
                        }
                        
                        $user_data = 'addusername=' . $addusername. '&addfirst_name=' . $addfirst_name . '&addmiddle_name=' . $addmiddle_name . '&addlast_name=' . $addlast_name . '&addemail=' . $addemail . '&addphone=' . $addphone . '&addhousestreet=' . $addhousestreet . '&addbaranggay=' . $addbaranggay. '&addcity=' . $addcity. '&addprovince=' . $addprovince . '&addzp=' . $addzp. '&addgender=' . $addgender . '&addbirthdate=' . $addbirthdate;

                        if(empty($addfirst_name)){
                                header("Location: settings.php?adderror=First Name is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z\s]+$/", $addfirst_name)){
                                header("Location: settings.php?adderror=First Name must contain letters&$user_data");
                                exit();
                        }
                        else if(strlen($addfirst_name) <2){
                                header("Location: settings.php?adderror=First Name is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($addfirst_name) >35){
                                header("Location: settings.php?error=First Name is too long must be 2-35 characters length&$user_data");
                                exit();
                        }

                        else if(!empty($addmiddle_name) && !preg_match("/^[a-zA-Z\s]+$/", $addmiddle_name)){
                                header("Location: settings.php?adderror=Middle Name must contain letters&$user_data");
                                exit();
                        }
                        else if(!empty($addmiddle_name) && strlen($addmiddle_name) <2){
                                header("Location: settings.php?adderror=Middle Name is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(!empty($addmiddle_name) && strlen($addmiddle_name) >35){
                                header("Location: settings.php?adderror=Middle Name is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(empty($addlast_name)){
                                header("Location: settings.php?adderror=Last Name is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z\s]+$/", $addlast_name)){
                                header("Location: settings.php?adderror=Last Name must contain letters&$user_data");
                                exit();
                        }
                        else if(strlen($addlast_name) <2){
                                header("Location: settings.php?adderror=Last Name is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($addlast_name) >35){
                                header("Location: settings.php?adderror=Last Name is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($addfirst_name) + strlen($addmiddle_name) + strlen($addlast_name)>70){
                                header("Location: settings.php?adderror=Full Name is too long must be 70 characters length&$user_data");
                                exit();
                        }
                        else if(empty($addemail)){
                                header("Location: settings.php?adderror=Email is required&$user_data");
                                exit();
                        }
                        else if(!filter_var($addemail, FILTER_VALIDATE_EMAIL)){
                                header("Location: settings.php?adderror=Email is incorrect&$user_data");
                                exit();
                        }              
                        else if(empty($addphone)){
                                header("Location: settings.php?adderror=Phone Number is required&$user_data");
                                exit();
                        }


                        else if(!preg_match("/^[0-9]+$/", $addphone)){
                                header("Location: settings.php?adderror=Phone Number must contain numbers&$user_data");
                                exit();
                        }

                        else if(strlen($addphone) <11){
                                header("Location: settings.php?adderror=Phone Number is too short must be 11 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($addphone) >11){
                                header("Location: settings.php?adderror=Phone Number is too long must be 11 characters length&$user_data");
                                exit();
                        }                                

                        else if(empty($addhousestreet)){
                                header("Location: settings.php?adderror=House No. or Street Name is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z0-9\s]+$/", $addhousestreet)){
                                header("Location: settings.php?adderror=House No. and Street Name must contain letters or numbers&$user_data");
                                exit();
                        }
                        else if(strlen($addhousestreet) <2){
                                header("Location: settings.php?adderror=House No. and Street Name is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($addhousestreet) >35){
                                header("Location: settings.php?adderror=House No. and Street Name is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(empty($addbaranggay)){
                                header("Location: settings.php?adderror=Baranggay is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z\s]+$/", $addbaranggay)){
                                header("Location: settings.php?adderror=Baranggay must contain letters&$user_data");
                                exit();
                        }
                        else if(strlen($addbaranggay) <2){
                                header("Location: settings.php?adderror=Baranggay is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($addbaranggay) >35){
                                header("Location: settings.php?adderror=Baranggay is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(empty($addcity)){
                                header("Location: settings.php?adderror=City is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z\s]+$/", $addcity)){
                                header("Location: settings.php?adderror=City must contain letters&$user_data");
                                exit();
                        }
                        else if(strlen($addcity) <2){
                                header("Location: settings.php?adderror=City is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($addcity) >35){
                                header("Location: settings.php?adderror=City is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(empty($addprovince)){
                                header("Location: settings.php?adderror=Province is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z\s]+$/", $addprovince)){
                                header("Location: settings.php?adderror=Province must contain letters&$user_data");
                                exit();
                        }
                        else if(strlen($addprovince) <2){
                                header("Location: settings.php?adderror=Province is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($addprovince) >35){
                                header("Location: settings.php?adderror=Province is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(empty($addzp)){
                                header("Location: settings.php?adderror=ZIP or Postal Code is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[0-9]+$/", $addzp)){
                                header("Location: settings.php?adderror=ZIP or Postal Code must contain numbers&$user_data");
                                exit();
                        }
                        else if(strlen($addzp) <4){
                                header("Location: settings.php?adderror=ZIP or Postal Code is too short must be 4 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($addzp) >4){
                                header("Location: settings.php?adderror=ZIP or Postal Code is too long must be 4 characters length&$user_data");
                                exit();
                        }
                        else if(empty($addbirthdate)){
                                header("Location: settings.php?adderror=Birthday is required&$user_data");
                                exit();
                        }
                        else if(empty($addgender)){
                                header("Location: settings.php?adderror=Gender is required&$user_data");
                                exit();
                        }
                        else if(empty($addusername)){
                                header("Location: settings.php?adderror=Username is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z0-9\s\_\-]+$/", $addusername)){
                                header("Location: settings.php?adderror=Username must contain letters, numbers or symbols only&$user_data");
                                exit();
                        }
                        else if(strlen($addusername) <6){
                                header("Location: settings.php?adderror=Username is too short must be 6-30 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($addusername) >30){
                                header("Location: settings.php?adderror=Username is too long must be 6-30 characters length&$user_data");
                                exit();
                        }
                        else if(empty($addpassword)){
                                header("Location: settings.php?adderror=Password is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z0-9\w\S]+$/", $addpassword)){
                                header("Location: settings.php?adderror=Password must contain letters, numbers or symbols only&$user_data");
                                exit();
                        }
                        else if(strlen($addpassword) <8){
                                header("Location: settings.php?adderror=Password is too short must be 8-32 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($addpassword) >32){
                                header("Location: settings.php?adderror=Password is too long must be 8-32 characters length&$user_data");
                                exit();
                        }
                        else if(empty($addrepassword)){
                                header("Location: settings.php?adderror=Confirm Password is required&$user_data");
                                exit();
                        }
                        
                        
                        
                        else if($addpassword !== $addrepassword){
                                header("Location: settings.php?adderror=The confirmation password does not match&$user_data");
                                exit();
                        }


                        else
                        {
                                 $addfirst_name = strtoupper($addfirst_name);
                                $addmiddle_name = strtoupper($addmiddle_name);
                                $addlast_name = strtoupper($addlast_name);
                                $addhousestreet = strtoupper($addhousestreet);
                                $addbaranggay = strtoupper($addbaranggay);
                                $addcity = strtoupper($addcity);
                                $addprovince = strtoupper($addprovince);
                                $addpassword = md5($addpassword); 
                                $sql= "SELECT * FROM admins WHERE username= '$addusername'";
                                $result= mysqli_query($database_connection, $sql);
                                $sql2= "SELECT * FROM admins WHERE email= '$addemail'";
                                $result2= mysqli_query($database_connection, $sql2);

                                if (isset($_POST['addusername']))
                                {
                                  
                                        if (mysqli_num_rows($result) ||mysqli_num_rows($result2) > 0) 
                                       {
                                        header("Location: settings.php?adderror=The username/email is already taken&$user_data");
                                        exit();
                                       } else{
                                        
                                        $sql2= "INSERT INTO admins(first_name, middle_name, last_name, email, phone, housestreet, baranggay, city, province, zp, gender, birthdate, username, password) VALUES('$addfirst_name', '$addmiddle_name', '$addlast_name','$addemail','$addphone','$addhousestreet','$addbaranggay','$addcity','$addprovince','$addzp','$addgender','$addbirthdate', '$addusername', '$addpassword')";

                                        $result2= mysqli_query($database_connection, $sql2);

                                        if($result2)
                                        {
                                                        $log_username = $_SESSION['username'];
                                                        $log_activity = "Add Admin"; 
                                                        $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$addusername')";
                                                        $result3= mysqli_query($database_connection, $sql3);

                                                header("Location: settings.php?addsuccess=Account has been created successfully");
                                        exit();
                                        }
                                        else
                                        {
                                                header("Location: settings.php?adderror=Unknown error occurred&$user_data");
                                        exit();
                                        }


                            
           
                                       }
                                }
                               
                        }

                    }
        //TO SEARCH
              if(isset($_POST['searchtoupdate']))
                    {
                          
                         $updateinput = $_POST['updateinput']; 
                                
                                $data= getPosts();
                                // $search_query= "SELECT * FROM admins WHERE id= '$updateinput'";
                                // $search_result= mysqli_query($database_connection, $search_query);

                                // $search_query1= "SELECT * FROM admins WHERE first_name= '$updateinput'";
                                // $search_result1= mysqli_query($database_connection, $search_query1);

                                // $search_query2= "SELECT * FROM admins WHERE middle_name= '$updateinput'";
                                // $search_result2= mysqli_query($database_connection, $search_query2);

                                // $search_query3= "SELECT * FROM admins WHERE last_name= '$updateinput'";
                                // $search_result3= mysqli_query($database_connection, $search_query3);

                                // $search_query4= "SELECT * FROM admins WHERE email= '$updateinput'";
                                // $search_result4= mysqli_query($database_connection, $search_query4);

                                // $search_query5= "SELECT * FROM admins WHERE phone= '$updateinput'";
                                // $search_result5= mysqli_query($database_connection, $search_query5);

                                // $search_query6= "SELECT * FROM admins WHERE housestreet= '$updateinput'";
                                // $search_result6= mysqli_query($database_connection, $search_query6);

                                // $search_query7= "SELECT * FROM admins WHERE baranggay= '$updateinput'";
                                // $search_result7= mysqli_query($database_connection, $search_query7);

                                // $search_query8= "SELECT * FROM admins WHERE city= '$updateinput'";
                                // $search_result8= mysqli_query($database_connection, $search_query8);

                                // $search_query9= "SELECT * FROM admins WHERE province= '$updateinput'";
                                // $search_result9= mysqli_query($database_connection, $search_query9);

                                // $search_query10= "SELECT * FROM admins WHERE zp= '$updateinput'";
                                // $search_result10= mysqli_query($database_connection, $search_query10);

                                // $search_query11= "SELECT * FROM admins WHERE birthdate= '$updateinput'";
                                // $search_result11= mysqli_query($database_connection, $search_query11);

                                // $search_query12= "SELECT * FROM admins WHERE gender= '$updateinput'";
                                // $search_result12= mysqli_query($database_connection, $search_query12);

                                $search_query13= "SELECT * FROM admins WHERE username= '$updateinput'";
                                $search_result13= mysqli_query($database_connection, $search_query13);



                                if($search_result13)
                                {

                                      
                                      
                                      // if(mysqli_num_rows($search_result))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }
                                      
                                      // else if(mysqli_num_rows($search_result1))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result1))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }

                                      // else if(mysqli_num_rows($search_result2))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result2))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }

                                      // else if(mysqli_num_rows($search_result3))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result3))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }

                                      // else if(mysqli_num_rows($search_result4))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result4))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }

                                      // else if(mysqli_num_rows($search_result5))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result5))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }


                                      // else if(mysqli_num_rows($search_result6))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result6))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }

                                      // else if(mysqli_num_rows($search_result7))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result7))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }

                                      // else if(mysqli_num_rows($search_result8))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result8))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }

                                      // else if(mysqli_num_rows($search_result9))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result9))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }


                                      // else if(mysqli_num_rows($search_result10))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result10))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }

                                      // else if(mysqli_num_rows($search_result11))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result11))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }

                                      // else if(mysqli_num_rows($search_result12))
                                      // {
                                      //       while($row = mysqli_fetch_array($search_result12))
                                      //       {
                                      //             $id= $row['id'];
                                      //             $first_name= $row['first_name'];
                                      //             $middle_name= $row['middle_name'];
                                      //             $last_name= $row['last_name'];
                                      //             $email= $row['email'];
                                      //             $phone= $row['phone'];
                                      //             $housestreet= $row['housestreet'];
                                      //             $baranggay= $row['baranggay'];
                                      //             $city= $row['city'];
                                      //             $province= $row['province'];
                                      //             $zp= $row['zp'];
                                      //             $birthdate= $row['birthdate'];
                                      //             $gender= $row['gender'];
                                      //             $username= $row['username'];

                                      //             $password= $row['password'];
                                        
                                                 
                                      //       }
                                      // }

                                      if(mysqli_num_rows($search_result13))
                                      {
                                            while($row = mysqli_fetch_array($search_result13))
                                            {
                                                  $id= $row['id'];
                                                  $first_name= $row['first_name'];
                                                  $middle_name= $row['middle_name'];
                                                  $last_name= $row['last_name'];
                                                  $email= $row['email'];
                                                  $phone= $row['phone'];
                                                  $housestreet= $row['housestreet'];
                                                  $baranggay= $row['baranggay'];
                                                  $city= $row['city'];
                                                  $province= $row['province'];
                                                  $zp= $row['zp'];
                                                  $birthdate= $row['birthdate'];
                                                  $gender= $row['gender'];
                                                  $username= $row['username'];


                                                  
                                                 
                                            }
                                      }
                                      else
                                      {
                                            header("Location: settings.php?error=The username is not existing&#updateaccount");
                                            exit();
                                      }

                                } 
                                     
                          
                          else
                          {
                                header("Location: settings.php?error=Enter member username&$user_data");
                                exit();
                          }




                    }
        //TO UPDATE
                    if(isset($_POST['update']))
                    {
                         
                          
                  

                        function validate($data){
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                        }
                        $updateinput = validate ($_POST['updateinput']);
                        $username = validate ($_POST['username']);
                        $password = validate ($_POST['password']);
                        $repassword = validate ($_POST['repassword']);
                        $first_name = validate ($_POST['first_name']);
                        $middle_name = validate ($_POST['middle_name']);
                        $last_name = validate ($_POST['last_name']);
                        $email = validate ($_POST['email']);
                        $phone = validate ($_POST['phone']);
                        $housestreet = validate ($_POST['housestreet']);
                        $baranggay = validate ($_POST['baranggay']);
                        $city = validate ($_POST['city']);
                        $province = validate ($_POST['province']);
                        $zp = validate ($_POST['zp']);
                        $gender = validate ($_POST['gender']);              
                        $birthdate = validate ($_POST['birthdate']);

                        if(!empty($phone)){
                          $phone = str_replace([' ', '.', '-', '(', ')'], '', $phone);
                        $phone = str_replace(['+63'], '0', $phone);
                        $phone = substr_replace($phone, "09", 0, 2);

                                
                        }
                        
                        $user_data = 'updateinput=' . $updateinput. '&username=' . $username. '&first_name=' . $first_name . '&middle_name=' . $middle_name . '&last_name=' . $last_name . '&email=' . $email . '&phone=' . $phone . '&housestreet=' . $housestreet . '&baranggay=' . $baranggay. '&city=' . $city. '&province=' . $province . '&zp=' . $zp. '&gender=' . $gender . '&birthdate=' . $birthdate;

                        if(empty($first_name)){
                                header("Location: settings.php?error=First Name is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z\s]+$/", $first_name)){
                                header("Location: settings.php?error=First Name must contain letters&$user_data");
                                exit();
                        }
                        else if(strlen($first_name) <2){
                                header("Location: settings.php?error=First Name is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($first_name) >35){
                                header("Location: settings.php?error=First Name is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        
                        else if(!empty($middle_name) && !preg_match("/^[a-zA-Z\s]+$/", $middle_name)){
                                header("Location: settings.php?error=Middle Name must contain letters&$user_data");
                                exit();
                        }
                        else if(!empty($middle_name) && strlen($middle_name) <2){
                                header("Location: settings.php?error=Middle Name is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(!empty($middle_name) && strlen($middle_name) >35){
                                header("Location: settings.php?error=Middle Name is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(empty($last_name)){
                                header("Location: settings.php?error=Last Name is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z\s]+$/", $last_name)){
                                header("Location: settings.php?error=Last Name must contain letters&$user_data");
                                exit();
                        }
                        else if(strlen($last_name) <2){
                                header("Location: settings.php?error=Last Name is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($last_name) >35){
                                header("Location: settings.php?error=Last Name is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($first_name) + strlen($middle_name) + strlen($last_name)>70){
                                header("Location: settings.php?error=Full Name is too long must be 70 characters length&$user_data");
                                exit();
                        }
                        else if(empty($email)){
                                header("Location: settings.php?error=Email is required&$user_data");
                                exit();
                        }
                        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                header("Location: settings.php?error=Email is incorrect&$user_data");
                                exit();
                        }              
                        else if(empty($phone)){
                                header("Location: settings.php?error=Phone Number is required&$user_data");
                                exit();
                        }


                        else if(!preg_match("/^[0-9]+$/", $phone)){
                                header("Location: settings.php?error=Phone Number must contain numbers&$user_data");
                                exit();
                        }

                        else if(strlen($phone) <11){
                                header("Location: settings.php?error=Phone Number is too short must be 11 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($phone) >11){
                                header("Location: settings.php?error=Phone Number is too long must be 11 characters length&$user_data");
                                exit();
                        }                                

                        else if(empty($housestreet)){
                                header("Location: settings.php?error=House No. or Street Name is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z0-9\s]+$/", $housestreet)){
                                header("Location: settings.php?error=House No. and Street Name must contain letters or numbers&$user_data");
                                exit();
                        }
                        else if(strlen($housestreet) <2){
                                header("Location: settings.php?error=House No. and Street Name is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($housestreet) >35){
                                header("Location: settings.php?error=House No. and Street Name is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(empty($baranggay)){
                                header("Location: settings.php?error=Baranggay is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z\s]+$/", $baranggay)){
                                header("Location: settings.php?error=Baranggay must contain letters&$user_data");
                                exit();
                        }
                        else if(strlen($baranggay) <2){
                                header("Location: settings.php?error=Baranggay is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($baranggay) >35){
                                header("Location: settings.php?error=Baranggay is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(empty($city)){
                                header("Location: settings.php?error=City is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z\s]+$/", $city)){
                                header("Location: settings.php?error=City must contain letters&$user_data");
                                exit();
                        }
                        else if(strlen($city) <2){
                                header("Location: settings.php?error=City is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($city) >35){
                                header("Location: settings.php?error=City is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(empty($province)){
                                header("Location: settings.php?error=Province is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z\s]+$/", $province)){
                                header("Location: settings.php?error=Province must contain letters&$user_data");
                                exit();
                        }
                        else if(strlen($province) <2){
                                header("Location: settings.php?error=Province is too short must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($province) >35){
                                header("Location: settings.php?error=Province is too long must be 2-35 characters length&$user_data");
                                exit();
                        }
                        else if(empty($zp)){
                                header("Location: settings.php?error=ZIP or Postal Code is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[0-9]+$/", $zp)){
                                header("Location: settings.php?error=ZIP or Postal Code must contain numbers&$user_data");
                                exit();
                        }
                        else if(strlen($zp) <4){
                                header("Location: settings.php?error=ZIP or Postal Code is too short must be 4 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($zp) >4){
                                header("Location: settings.php?error=ZIP or Postal Code is too long must be 4 characters length&$user_data");
                                exit();
                        }
                        else if(empty($gender)){
                                header("Location: settings.php?error=Gender is required&$user_data");
                                exit();
                        }

                        else if(empty($birthdate)){
                                header("Location: settings.php?error=Birthday is required&$user_data");
                                exit();
                        }
                          
                        else if(empty($username)){
                                header("Location: settings.php?error=Username is required&$user_data");
                                exit();
                        }
                        else if(!preg_match("/^[a-zA-Z0-9\s\_\-]+$/", $username)){
                                header("Location: settings.php?error=Username must contain letters, numbers or symbols only&$user_data");
                                exit();
                        }
                        else if(strlen($username) <6){
                                header("Location: settings.php?error=Username is too short must be 6-30 characters length&$user_data");
                                exit();
                        }
                        else if(strlen($username) >30){
                                header("Location: settings.php?error=Username is too long must be 6-30 characters length&$user_data");
                                exit();
                        }


                        else
                        {
                                 $first_name = strtoupper($first_name);
                                $middle_name = strtoupper($middle_name);
                                $last_name = strtoupper($last_name);
                                $housestreet = strtoupper($housestreet);
                                $baranggay = strtoupper($baranggay);
                                $city = strtoupper($city);
                                $province = strtoupper($province);
                                $sql= "SELECT * FROM admins WHERE username= '$username'";
                                $result= mysqli_query($database_connection, $sql);
                                $sql3= "SELECT * FROM admins WHERE username= '$updateinput'";
                                $result3= mysqli_query($database_connection, $sql3);

                                if (isset($_POST['username']))
                                {
                                  
                                        if (mysqli_num_rows($result) > 0) 
                                       {
                                            $username = $_POST['username'];
                                            $updateinput= $_POST['updateinput'];        

                                                                    $sql2= "UPDATE admins SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',email='$_POST[email]',phone='$_POST[phone]',housestreet='$housestreet',baranggay='$baranggay',city='$city',province='$province',zp='$_POST[zp]',birthdate='$_POST[birthdate]', gender='$_POST[gender]',username='$_POST[username]' WHERE username ='$username'";

                                        $result2= mysqli_query($database_connection, $sql2);

                                        if($result2)
                                        {
                                                        $log_username = $_SESSION['username'];
                                                        $log_activity = "Update Admin"; 
                                                        $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$username')";
                                                        $result3= mysqli_query($database_connection, $sql3);

                                                header("Location: settings.php?success=Account has been updated successfully");
                                        exit();
                                        }
                                        else
                                        {
                                                header("Location: settings.php?error=Unknown error occurred&$user_data");
                                        exit();
                                        }
                                       }else{
                                            $updateinput= $_POST['updateinput'];        

                                            $sql2= "UPDATE admins SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',email='$_POST[email]',phone='$_POST[phone]',housestreet='$housestreet',baranggay='$baranggay',city='$city',province='$province',zp='$_POST[zp]',birthdate='$_POST[birthdate]', gender='$_POST[gender]',username='$_POST[username]' WHERE username ='$updateinput'";

                                        $result2= mysqli_query($database_connection, $sql2);

                                        if($result2)
                                        {
                                                        $log_username = $_SESSION['username'];
                                                        $log_activity = "Update Admin"; 
                                                        $sql3= "INSERT INTO log_record (log_username,log_activity,log_details)VALUES('$log_username','$log_activity','$username')";
                                                        $result3= mysqli_query($database_connection, $sql3);

                                                header("Location: settings.php?success=Account has been updated successfully");
                                        exit();
                                        }
                                        else
                                        {
                                                header("Location: settings.php?error=Unknown error occurred&$user_data");
                                        exit();
                                        }
                                       }
                                }
                               
                        }

                    }
        if(isset($_POST['addrefresh']))
        {
              header("Location: settings.php?#addaccount");
              exit();
        }            
        if(isset($_POST['updaterefresh']))
        {
              header("Location: settings.php?#updateaccount");
              exit();
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
        <link rel="stylesheet" type="text/css" href="css/adminaccountprint.css" media="print" />
        <link rel="stylesheet" href="css/adminaccountsE.css"/>
        <title>Admin Accounts | SCPCFI</title>
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
                  <a><b>ACCOUNTS</b></a>
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
                              <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Accounts</a>
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
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
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
<!-- MAIN -------------------------------------------------------------------------------------------------------------------------------------->
<div class="main">
        <section class="page-section" id="addaccount">
      <div class="heading">
      <div class='row'>
      <div class='col-8'>
            <h1>ADD NEW ACCOUNT</h1>
      </div>

      
      </div>
      </div> </section>
            
              <?php if (isset($_GET['adderror'])){ ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p class="adderror"><?php echo $_GET['adderror']; ?></p>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php } ?>
            <?php if (isset($_GET['addsuccess'])){ ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="addsuccess"><?php echo $_GET['addsuccess']; ?></p>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php } ?>  
      <form action="settings.php" method="post">

      <div class="container-fluid" id="addform">

            

            <div class="row text-left">
                  <div class="col-4">
                        <label>First Name</label>
                  </div>
                  <div class="col-4">
                        <label>Middle Name</label>
                  </div>
                  <div class="col-4">
                        <label>Last Name</label>
                  </div>

                  <div class="col-4">
                        <?php if (isset($_GET['addfirst_name'])) { ?>
                        <input class="touppercase" type="text" 
                        name="addfirst_name" 
                        placeholder="First Name"
                        value="<?php echo $_GET['addfirst_name']; ?>"> 
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="addfirst_name" 
                        placeholder="First Name"
                        value="<?php echo $addfirst_name; ?>"> 
                        <?php }?> 
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['addmiddle_name'])) { ?>
                        <input class="touppercase" type="text" 
                        name="addmiddle_name" 
                        placeholder="Middle Name"
                        value="<?php echo $_GET['addmiddle_name']; ?>"> 
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="addmiddle_name" 
                        placeholder="Middle Name"
                        value="<?php echo $addmiddle_name; ?>"> 
                        <?php }?>
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['addlast_name'])) { ?>
                        <input class="touppercase" type="text" 
                        name="addlast_name" 
                        placeholder="Last Name"
                        value="<?php echo $_GET['addlast_name']; ?>"> <br>
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="addlast_name" 
                        placeholder="Last Name"
                        value="<?php echo $addlast_name; ?>"> <br>
                        <?php }?>
                  </div>
            </div>

            <div class="row text-left">
                  <div class="col-4">
                        <label>E-mail</label>
                  </div>
                  <div class="col-4">
                        <label>Phone Number</label>
                  </div>
                  <div class="col-4">
                        <label>House No. / Street Name</label>
                  </div>

                  <div class="col-4">
                        <?php if (isset($_GET['addemail'])) { ?>
                        <input type="email" 
                        name="addemail" 
                        placeholder="E-mail"
                        value="<?php echo $_GET['addemail']; ?>"> 
                        <?php }else{ ?>
                        <input type="email" 
                        name="addemail" 
                        placeholder="E-mail"
                        value="<?php echo $addemail; ?>"> 
                        <?php }?>
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['addphone'])) { ?>
                        <input class="touppercase" type="number" 
                        name="addphone" 
                        placeholder="Phone Number"
                        value="<?php echo $_GET['addphone']; ?>"> 
                        <?php }else{ ?>
                        <input class="touppercase" type="number" 
                        name="addphone" 
                        placeholder="Phone Number"
                        value="<?php echo $addphone; ?>"> 
                        <?php }?> 
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['addhousestreet'])) { ?>
                        <input class="touppercase" type="text" 
                        name="addhousestreet" 
                        placeholder="House No. / Street Name"
                        value="<?php echo $_GET['addhousestreet']; ?>"> <br>
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="addhousestreet" 
                        placeholder="House No. / Street Name"
                        value="<?php echo $addhousestreet; ?>"> <br>
                        <?php }?>
                  </div>
            </div>

            <div class="row text-left">
                  <div class="col-4">
                        <label>Baranggay</label>
                  </div>
                  <div class="col-4">
                        <label>City</label>
                  </div>
                  <div class="col-4">
                        <label>Province</label>
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['addbaranggay'])) { ?>
                        <input class="touppercase" type="text" 
                        name="addbaranggay" 
                        placeholder="Baranggay"
                        value="<?php echo $_GET['addbaranggay']; ?>"> 
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="addbaranggay" 
                        placeholder="Baranggay"
                        value="<?php echo $addbaranggay; ?>"> 
                        <?php }?>
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['addcity'])) { ?>
                        <input class="touppercase" type="text" 
                        name="addcity" 
                        placeholder="City"
                        value="<?php echo $_GET['addcity']; ?>"> 
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="addcity" 
                        placeholder="City"
                        value="<?php echo $addcity; ?>"> 
                        <?php }?>
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['addprovince'])) { ?>
                        <input class="touppercase" type="text" 
                        name="addprovince" 
                        placeholder="Province"
                        value="<?php echo $_GET['addprovince']; ?>"> <br>
                        <?php }else{ ?>
                        <input class="touppercase" type="text" 
                        name="addprovince" 
                        placeholder="Province"
                        value="<?php echo $addprovince; ?>"> <br>
                        <?php }?>
                  </div>
            </div>

            <div class="row text-left">
                  <div class="col-4">
                        <label>Zip / Postal Code</label>
                  </div>
                  <div class="col-4">
                        <label>Birthdate</label>
                  </div>
                  <div class="col-4">
                        <label>Gender</label>
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['addzp'])) { ?>
                        <input class="touppercase" type="number" 
                        name="addzp" 
                        placeholder="ZIP/Postal Code"
                        value="<?php echo $_GET['addzp']; ?>"> 
                        <?php }else{ ?>
                        <input class="touppercase" type="number" 
                        name="addzp" 
                        placeholder="ZIP/Postal Code"
                        value="<?php echo $addzp; ?>"> 
                        <?php }?>
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['addbirthdate'])) { ?>
                        <input type="date" 
                        id="addbirthdate"
                        name="addbirthdate" 
                        value="<?php echo $_GET['addbirthdate']; ?>"> 
                        <?php }else{ ?>
                        <input type="date" 
                        name="addbirthdate" 
                        value="<?php echo $addbirthdate; ?>"> 
                        <?php }?>
                  </div>
                  <div class="col-4 gender">
                        <?php if (isset($_GET['addgender'])) { ?>
                        <input class="radio" type="radio" 
                        id="male"
                        name="addgender" 
                        value="MALE"
                        <?php 
                        if($_GET['addgender'] == "MALE")
                        {
                        echo "checked";
                        }
                        ?>
                        ><span>Male</span>
                        <input class="radio" type="radio" 
                        id="female"
                        name="addgender" 
                        value="FEMALE"

                        <?php 
                        if($_GET['addgender'] == "FEMALE")
                        {
                        echo "checked";
                        }
                        ?>
                        ><span>Female</span><br>
                        <?php }else{ ?>
                        <input class="radio" type="radio"
                        id="male" 
                        name="addgender"
                        value="MALE"
                        <?php 
                        if($addgender == "MALE")
                        {
                        echo "checked";
                        }
                        ?>
                        ><span>Male</span>
                        <input class="radio" type="radio" 
                        id="female"
                        name="addgender" 
                        value="FEMALE"

                        <?php 
                        if($addgender == "FEMALE")
                        {
                        echo "checked";
                        }
                        ?>
                        ><span>Female</span><br>      
                        <?php }?> 
                  </div>
            </div>

            <div class="row text-left">
                  <div class="col-4">
                        <label>Username</label>
                  </div>
                  <div class="col-4">
                        <label>Password</label>
                  </div>
                  <div class="col-4">
                        <label>Confirm Password</label>
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['addusername'])) { ?>
                        <input type="text" 
                        name="addusername" 
                        placeholder="Username"
                        value="<?php echo $_GET['addusername']; ?>"> 
                        <?php }else{ ?>
                        <input type="text" 
                        name="addusername" 
                        placeholder="Username"
                        value="<?php echo $addusername; ?>"> 
                        <?php }?> 
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['addpassword'])) { ?>
                        <input type="password" 
                        name="addpassword" 
                        placeholder="Password"
                        value="<?php echo ($_GET['addpassword']); ?>"> 
                        <?php }else{ ?>
                        <input type="password" 
                        name="addpassword" 
                        placeholder="Password"
                        value=""> 
                        <?php }?>     
                  </div>
                  <div class="col-4">
                        <?php if (isset($_GET['addrepassword'])) { ?>
                        <input type="password" 
                        name="addrepassword" 
                        placeholder="Confirm Password"
                        value="<?php echo ($_GET['addrepassword']); ?>"> <br>
                        <?php }else{ ?>
                        <input type="password" 
                        name="addrepassword" 
                        placeholder="Confirm Password"
                        value=""> <br>
                        <?php }?>
                  </div>
            </div>
            
            <div class="row">
                  <div class="col-6">
                        <input class="btn btn-primary btninput" type="submit" name="add" value="ADD">
                  </div>
                  <div class="col-6">
                        <input class="btn btn-primary btninput" type="submit" name="addrefresh" action="settings.php" value="REFRESH">
                  </div>
            </div>
      </div>

      <section class="page-section" id="listaccount">
      <div class="heading">
            <div class='row'>
                  <div class='col-4'>
                        <h1>LIST OF ACCOUNTS</h1>
                  </div>
                  <div class='col-5'>
                        <div class="input-group">
                              <?php if (isset($_GET['searchinput'])) { ?>
                              <input class="form-control" type="text" 
                              name="searchinput" 
                              placeholder="Enter admin data . . .";
                              value="<?php echo $_GET['searchinput']; ?>">
                              <?php }else{ ?>
                              <input class="form-control" type="text" 
                              name="searchinput" 
                              placeholder="Enter admin data . . ."
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
                              <a class="dropdown-item" href="settings.php?#listaccount">Refresh</a>
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
                                <?php if (isset($_GET['deletesuccess'])){ ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="deletesuccess"><?php echo $_GET['deletesuccess']; ?></p>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php } ?>
            <?php if (isset($searchsuccess)){ ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="deletesuccess"><?php echo $searchsuccess; ?></p>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php } ?>
<?php
//TABLE
if (isset($_POST['search'])) 
{
        $sql= "SELECT * FROM admins WHERE id= '$searchinput' OR first_name LIKE '%$searchinput%' OR middle_name LIKE '%$searchinput%' OR last_name LIKE '%$searchinput%' OR email LIKE '%$searchinput%' OR phone LIKE '%$searchinput%' OR housestreet LIKE '%$searchinput%' OR baranggay LIKE '%$searchinput%' OR city LIKE '%$searchinput%' OR province LIKE '%$searchinput%' OR zp LIKE '%$searchinput%' OR birthdate LIKE '%$searchinput%' OR gender LIKE '%$searchinput%' OR username LIKE '%$searchinput%'";
        $result= mysqli_query($database_connection, $sql);

        if (mysqli_num_rows($result) > 0) 
        {

            echo "<div class='container-fluid table'><table>";
            echo "<thead><tr><th>Id</th><th>Name</th><th>Gender</th><th>Birthdate</th><th>Address</th><th>Phone No.</th><th>E-mail</th><th>Username</th></tr></thead>";

            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr class='infos'><td>{$row['id']}</td><td><a   href='settings.php?viewid={$row['id']}'>{$row['first_name']} {$row['middle_name']} {$row['last_name']}</a></td><td>{$row['gender']}</td><td>{$row['birthdate']}</td><td>{$row['housestreet']} {$row['baranggay']} {$row['city']} {$row['province']} {$row['zp']}</td><td>{$row['phone']}</td><td>{$row['email']}</td><td>{$row['username']}</td><td><a   href='settings.php?id={$row['id']}'><button type='button' class='btn btn-primary actions' value='DELETE'>DELETE</button></a></td></tr>";
            }
            echo "</table></div>";                                                                                     
        }

        else
        {          
            $sql = "SELECT * FROM admins";
            $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

            echo "<div class='container-fluid table'><table>";
            echo "<thead><tr><th>Id</th><th>Name</th><th>Gender</th><th>Birthdate</th><th>Address</th><th>Phone No.</th><th>E-mail</th><th>Username</th></tr></thead>";

            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr class='infos'><td>{$row['id']}</td><td><a   href='settings.php?viewid={$row['id']}'>{$row['first_name']} {$row['middle_name']} {$row['last_name']}</a></td><td>{$row['gender']}</td><td>{$row['birthdate']}</td><td>{$row['housestreet']} {$row['baranggay']} {$row['city']} {$row['province']} {$row['zp']}</td><td>{$row['phone']}</td><td>{$row['email']}</td><td>{$row['username']}</td><td><a   href='settings.php?id={$row['id']}'><button type='button' class='btn btn-primary actions' value='DELETE'>DELETE</button></a></td></tr>";
            }

            echo "</table></div>";
        }             
}
else
{
    $sql = "SELECT * FROM admins";
    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");

    echo "<div class='container-fluid table'><table>";
    echo "<thead><tr><th>Id</th><th>Name</th><th>Gender</th><th>Birthdate</th><th>Address</th><th>Phone No.</th><th>E-mail</th><th>Username</th></tr></thead>";

    while ($row = mysqli_fetch_assoc($result)) 
    {
        echo "<tr class='infos'><td>{$row['id']}</td><td><a   href='settings.php?viewid={$row['id']}'>{$row['first_name']} {$row['middle_name']} {$row['last_name']}</a></td><td>{$row['gender']}</td><td>{$row['birthdate']}</td><td>{$row['housestreet']} {$row['baranggay']} {$row['city']} {$row['province']} {$row['zp']}</td><td>{$row['phone']}</td><td>{$row['email']}</td><td>{$row['username']}</td><td><a   href='settings.php?id={$row['id']}'><button type='button' class='btn btn-primary actions' value='DELETE'>DELETE</button></a></td></tr>";
    }

    echo "</table></div>";
}
?>
<?php if(isset($_GET['id'])){  
    $sql = "SELECT * FROM admins WHERE id='$_GET[id]'";
    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");    
    if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) 
    { 
      $idb= $row['id'];
      $usernameb= $row['username'];
$first_nameb= $row['first_name'];
                                                  $middle_nameb= $row['middle_name'];
                                                  $last_nameb= $row['last_name'];
                                                  $emailb= $row['email'];
                                                  $phoneb= $row['phone'];
                                                  $housestreetb= $row['housestreet'];
                                                  $baranggayb= $row['baranggay'];
                                                  $cityb= $row['city'];
                                                  $provinceb= $row['province'];
                                                  $zpb= $row['zp'];
                                                  $birthdateb= $row['birthdate'];
                                                  $genderb= $row['gender'];
?>
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-id-card"></i></center>
                </div>
                <div class="col-3">
                        ID
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $idb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-user-circle"></i></center>
                </div>
                <div class="col-3">
                        Username
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $usernameb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-user"></i></center>
                </div>
                <div class="col-3">
                        Name
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $first_nameb." ".$middle_nameb." ".$last_nameb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-male"><i class="fa fa-female"></i></i></center>
                </div>
                <div class="col-3">
                        Gender
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $genderb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-birthday-cake"></i></center>
                </div>
                <div class="col-3">
                        Birthdate
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $birthdateb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-map-marker"></i></center>
                </div>
                <div class="col-3">
                        Address
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $housestreetb." ".$baranggayb." ".$cityb." ".$provinceb." ".$zpb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-phone-square"></i></center>
                </div>
                <div class="col-3">
                        Phone No.
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $phoneb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-envelope"></i></center>
                </div>
                <div class="col-3">
                        E-mail
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $emailb; ?></p>
                </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a class='btn btn-primary' type='submit' name='delete' value='DELETE' href='deleteadminaccount.php?id=<?php echo $idb; ?>&username=<?php echo $usernameb; ?>'>Yes</a>
      </div>
    </div>
  </div>
</div>  
<?php    
} }
}
?>
<?php if(isset($_GET['viewid'])){  
    $sql = "SELECT * FROM admins WHERE id='$_GET[viewid]'";
    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");    
    if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) 
    { 
      $idb= $row['id'];
      $usernameb= $row['username'];
$first_nameb= $row['first_name'];
                                                  $middle_nameb= $row['middle_name'];
                                                  $last_nameb= $row['last_name'];
                                                  $emailb= $row['email'];
                                                  $phoneb= $row['phone'];
                                                  $housestreetb= $row['housestreet'];
                                                  $baranggayb= $row['baranggay'];
                                                  $cityb= $row['city'];
                                                  $provinceb= $row['province'];
                                                  $zpb= $row['zp'];
                                                  $birthdateb= $row['birthdate'];
                                                  $genderb= $row['gender'];
?>
  <!-- Modal -->
<div class="modal fade" id="exampleModalb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Administrator Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-id-card"></i></center>
                </div>
                <div class="col-3">
                        ID
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $idb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-user-circle"></i></center>
                </div>
                <div class="col-3">
                        Username
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $usernameb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-user"></i></center>
                </div>
                <div class="col-3">
                        Name
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $first_nameb." ".$middle_nameb." ".$last_nameb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-male"><i class="fa fa-female"></i></i></center>
                </div>
                <div class="col-3">
                        Gender
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $genderb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-birthday-cake"></i></center>
                </div>
                <div class="col-3">
                        Birthdate
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $birthdateb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-map-marker"></i></center>
                </div>
                <div class="col-3">
                        Address
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $housestreetb." ".$baranggayb." ".$cityb." ".$provinceb." ".$zpb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-phone-square"></i></center>
                </div>
                <div class="col-3">
                        Phone No.
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $phoneb; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-envelope"></i></center>
                </div>
                <div class="col-3">
                        E-mail
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $emailb; ?></p>
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
</form> 
      
<!-- END OF MAIN ---------------------------------------------------------------------------------------------------------------------->
</div>
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://khaalipaper.com/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          $('#exampleModal').modal({
              show: true,
              backdrop: 'static',
            keyboard: false

          });
        });
    
    </script>
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