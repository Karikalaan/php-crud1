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
    <title>Login</title>
</head>

<body>
<?php
  $conn = mysqli_connect('localhost','root','','crud');
if($conn->connect_error){
    die("connection failed" .$conn->connect_error);
}
$email= $password="" ;
$emailerr=$passworderr= $passworder= "";
$error=array();
$error1=array();
if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    if (empty($_POST['email'])) {
        $emailerr = '*Email is required.';
        array_push($error, $emailerr);
    }  else {
            $email = $_POST['email'];
        }
    if (empty($_POST['password'])) {
        $passworderr = 'Password is required';
        array_push($error, $passworderr);
    }  else {
            $password = $_POST['password'];
        }

    if (count($error) == 0) {
        $result = "SELECT * FROM form WHERE email='$email' and password ='$password'";
        $row = $conn->query($result);
        if ($row->num_rows > 0) {
            header("location:welcome.php");
        
        } else {
            $passworder = "Invalid password";
            array_push($error1, $passworder);
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

                                    <form method="POST">
                                        <p>Please login to your account</p>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" >User email </label>
                                            <input type="email"  placeholder="usermail" name="email" />
                                            <span class="error"><?php echo $emailerr; ?></span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" >Password</label>
                                            <input type="password"  name="password" />
                                            <span class="error"><?php echo $passworderr; if(isset($passworder)){ echo $passworder;} ?></span>
                                        </div>
.
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="submit">Log in</button>
                                            <a class="text-muted" href="password.php">Forgot password?</a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Don't have an account?</p>
                                            <button type="button" class="btn btn-outline-danger" > <a href="signup.php">Create new</a></button>
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