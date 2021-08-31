<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Password</title>
</head>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'crud');
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}
$usernameerr = $emailerr = $emailformaterr = $phonenumbererr =  $usererr="";
$error = array();
$error1 = array();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    if (empty($_POST['username'])) {
        $usernameerr = "*Enter User Name";
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
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];

    if (count($error) == 0) { 
        $result = "SELECT * FROM form WHERE email='$email' ";
        $row = $conn->query($result);
        if ($row->num_rows > 0) {
            header("location:edit.php");
        } else {   
        $usererr= "Invalid username/mail ";  
        array_push($error1,$usererr);  
      }
    }
}    
?>
<body>
    <center>
        <form method="POST">
            <div class="container">
                <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/lotus.png" style="width: 185px;" alt="logo">
            </div>
            <div class="container" >
                <div class="form-outline mb-4">
                    Username
                    <input type="text" placeholder="user name" name="username" />
                    <br> <span class="error"> <?php echo $usernameerr; ?></span>
                </div>
                <div class="form-outline mb-4">
                    Mail-id
                    <input type="email" placeholder="email address" name="email" />
                    <br><span class="error"> <?php echo $emailerr;
                                                $emailformaterr; ?></span>
                </div>
                <div class="form-outline mb-4">
                    Phone number
                    <input type="text" placeholder="Phone number" name="phonenumber" />
                    <br> <span class="error"> <?php echo $phonenumbererr;  if(isset($usererr)){ echo $usererr;} ?></span>
                </div>
                <input type="submit" name="submit">&nbsp;&nbsp;

            </div>
</form>
</body>
</table>
</center>




</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

</html>