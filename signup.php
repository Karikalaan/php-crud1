 <?php
    session_start();
    ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">

     <title>Index</title>
 </head>

 <body>
    <?php
    //  connnecting  Database
    $conn = mysqli_connect('localhost', 'root', '', 'crud');
    if ($conn->connect_error) {
        die('connection error' . $conn->connect_error);
    }
    //  inserting data
    
    $usernameerr = $emailerr = $emailformaterr = $phonenumbererr = $passworderr = $passwordlenerr = $confirmpassworderr = $confirmpassworder = "";
    $error = array();

    if (isset($_POST['submit']))  {
        $username = $_POST['username'];
        if (empty($_POST['username'])) {    
            $usernameerr = "*Username is required";
            array_push($error, $usernameerr);
        } else {
            $username = $_POST['username'];
        }
        $email = $_POST['email'];
        if (empty($_POST['email'])) {
            $emailerr = "*Mail id is required";
            array_push($error, $emailerr);
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailformaterr = "*Enter valid mail id";
                array_push($error, $emailformaterr);
            } else {
                $email = $_POST['email'];
            }
        }
        $phonenumber = $_POST['phonenumber'];
        if (empty($_POST['phonenumber'])) {
            $phonenumbererr = "*Field is required";
            array_push($error, $phonenumbererr);
        } else {
            $phonenumber = $_POST['phonenumber'];
        }
        $password = $_POST['password'];
        if (empty($_POST['password'])) {
            $passworderr = "*Password is required";
            array_push($error, $passworderr);
        } else {
            if (strlen($password) < 5) {
                $passwordlenerr = "*Minimum 5 field  is required";
                array_push($error, $passwordlenerr);
            } else {
                $password = $_POST['password'];
            }
        }
        $confirmpassword = $_POST['confirmpassword'];
        if (empty($_POST['confirmpassword'])) {
            $confirmpassworderr = '*Password is required';
            array_push($error, $confirmpassworderr);
        } else {
            if ($_POST["password"] !== $_POST["confirmpassword"]) {     

                $confirmpassworder = 'Correct password is required';
                array_push($error, $confirmpassworder);
            } else {
                $confirmpassword = $_POST['confirmpassword'];
            }
        }
        

    }

    // Inserting Data
    if (count($error) == 0) {
if(isset($_POST['username'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];

        $sql = "INSERT INTO form(username,email,phonenumber,password,confirmpassword) 
        VALUES('$username','$email','$phonenumber','$password','$confirmpassword')";
        if ($conn->query($sql) === TRUE) {
                header("location:welcome.php");
                    } else {
            echo "Error" . $conn->error;
        }
        }
        }

    ?>
     <section class="h-100 gradient-form" style="background-color: #eee;">
         <div class="container py-5 h-100">
             <div class="row d-flex justify-content-center align-items-center h-100">
                 <div class="col-xl-10">
                     <div class="card rounded-3 text-black">
                         <div class="row g-0">
                             <div class="col-lg-6">
                                 <div class="card-body p-md-5 mx-md-4">

                                     <div class="text-center">
                                         <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/lotus.png" style="width: 185px;" alt="logo">
                                         <h4 class="mt-1 mb-5 pb-1">We are The Lotus Team</h4>
                                     </div>

                                     <form action="signup.php" method="POST">
                                         <div class="d-flex align-items-center justify-content-center pb-4">
                                             <p class="mb-0 me-2">Don't you have an account?</p>
                                         </div>
                                         <p id="key">Just create</p>
                                         <div class="form-outline mb-4">
                                             Username
                                             <input type="text" placeholder="user name" name="username" />
                                             <br> <span class="error"> <?php echo $usernameerr; ?></span>
                                         </div>
                                         <div class="form-outline mb-4">
                                             Mail-id
                                             <input type="email" placeholder="email address" name="email" />
                                             <br><span class="error"> <?php echo $emailerr;
                                                                        echo $emailformaterr;  ?></span>
                                         </div>
                                         <div class="form-outline mb-4">
                                             Phone number 
                                             <input type="text" placeholder="Phone number" name="phonenumber" />
                                             <br> <span class="error"> <?php echo $phonenumbererr; ?></span>
                                         </div>
                                         <div class="form-outline mb-4">
                                             Password
                                             <input type="password" name="password" />
                                             <br> <span class="error"> <?php echo $passworderr;
                                                                        echo $passwordlenerr; ?></span>
                                         </div>
                                         <div class="form-outline mb-4">
                                             Confirm Password
                                             <input type="password" name="confirmpassword" />
                                             <br> <span class="error"> <?php echo $confirmpassworderr;
                                                                        echo $confirmpassworder; ?></span>
                                         </div>
                                         <div class="text-center pt-1 mb-5 pb-1">
                                             <button type="submit" name="submit"> sign in</button>
                                         </div>
                                     </form>

                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
 </body>

 </html>