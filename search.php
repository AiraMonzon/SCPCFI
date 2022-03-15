 //TO SEARCH
      if(isset($_POST['search']))
            {
                  
                  
                        
                        $data= getPosts();
                        $search_query= "SELECT * FROM admins WHERE id= '$_POST[searchinput]'";
                        $search_result= mysqli_query($database_connection, $search_query);

                        $search_query1= "SELECT * FROM admins WHERE first_name= '$_POST[first_name]'";
                        $search_result1= mysqli_query($database_connection, $search_query1);

                        $search_query2= "SELECT * FROM admins WHERE middle_name= '$_POST[middle_name]'";
                        $search_result2= mysqli_query($database_connection, $search_query2);

                        $search_query3= "SELECT * FROM admins WHERE last_name= '$_POST[last_name]'";
                        $search_result3= mysqli_query($database_connection, $search_query3);

                        $search_query4= "SELECT * FROM admins WHERE email= '$_POST[email]'";
                        $search_result4= mysqli_query($database_connection, $search_query4);

                        $search_query5= "SELECT * FROM admins WHERE phone= '$_POST[phone]'";
                        $search_result5= mysqli_query($database_connection, $search_query5);

                        $search_query6= "SELECT * FROM admins WHERE housestreet= '$_POST[housestreet]'";
                        $search_result6= mysqli_query($database_connection, $search_query6);

                        $search_query7= "SELECT * FROM admins WHERE baranggay= '$_POST[baranggay]'";
                        $search_result7= mysqli_query($database_connection, $search_query7);

                        $search_query8= "SELECT * FROM admins WHERE city= '$_POST[city]'";
                        $search_result8= mysqli_query($database_connection, $search_query8);

                        $search_query9= "SELECT * FROM admins WHERE province= '$_POST[province]'";
                        $search_result9= mysqli_query($database_connection, $search_query9);

                        $search_query10= "SELECT * FROM admins WHERE zp= '$_POST[zp]'";
                        $search_result10= mysqli_query($database_connection, $search_query10);

                        $search_query11= "SELECT * FROM admins WHERE birthdate= '$_POST[birthdate]'";
                        $search_result11= mysqli_query($database_connection, $search_query11);

                        $search_query12= "SELECT * FROM admins WHERE gender= '$_POST[gender]'";
                        $search_result12= mysqli_query($database_connection, $search_query12);

                        $search_query13= "SELECT * FROM admins WHERE username= '$_POST[username]'";
                        $search_result13= mysqli_query($database_connection, $search_query13);



                        if($search_result)
                        {

                              
                              
                              if(mysqli_num_rows($search_result))
                              {
                                    while($row = mysqli_fetch_array($search_result))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }
                              
                              else if(mysqli_num_rows($search_result1))
                              {
                                    while($row = mysqli_fetch_array($search_result1))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }

                              else if(mysqli_num_rows($search_result2))
                              {
                                    while($row = mysqli_fetch_array($search_result2))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }

                              else if(mysqli_num_rows($search_result3))
                              {
                                    while($row = mysqli_fetch_array($search_result3))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }

                              else if(mysqli_num_rows($search_result4))
                              {
                                    while($row = mysqli_fetch_array($search_result4))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }

                              else if(mysqli_num_rows($search_result5))
                              {
                                    while($row = mysqli_fetch_array($search_result5))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }


                              else if(mysqli_num_rows($search_result6))
                              {
                                    while($row = mysqli_fetch_array($search_result6))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }

                              else if(mysqli_num_rows($search_result7))
                              {
                                    while($row = mysqli_fetch_array($search_result7))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }

                              else if(mysqli_num_rows($search_result8))
                              {
                                    while($row = mysqli_fetch_array($search_result8))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }

                              else if(mysqli_num_rows($search_result9))
                              {
                                    while($row = mysqli_fetch_array($search_result9))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }


                              else if(mysqli_num_rows($search_result10))
                              {
                                    while($row = mysqli_fetch_array($search_result10))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }

                              else if(mysqli_num_rows($search_result11))
                              {
                                    while($row = mysqli_fetch_array($search_result11))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }

                              else if(mysqli_num_rows($search_result12))
                              {
                                    while($row = mysqli_fetch_array($search_result12))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }

                              else if(mysqli_num_rows($search_result13))
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

                                          $password= $row['password'];
                                
                                         
                                    }
                              }
                              else
                              {
                                    header("Location: settings.php?error=The ID is not existing&#listaccount");
                                    exit();
                              }

                        } 
                             
                  
                  else
                  {
                        header("Location: settings.php?error=Enter member ID&$user_data");
                        exit();
                  }




            }
