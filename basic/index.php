<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>document</title>
</head>

<body>
    <!-- full php code -->

    <?php

    //connect to database

    $conn = mysqli_connect('localhost', 'root', '', 'company');
    if ($conn->connect_error) {
        die('Connection failed' . $conn->connect_error);
    } else {
        echo '';
    }

    // insert data

    $nameerr = $emailerr = $emailformat = $designationerr = $passworderr = $passwordstrength =  "";
    $errors = array();

    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        if (empty($_POST['name'])) {
            $nameerr = '*Name is required.';
            array_push($errors, $nameerr);
        } else {
            $name = $_POST['name'];
        }

        $email = $_POST['email'];
        if (empty($_POST['email'])) {
            $emailerr = '*E-mail is required.';
            array_push($errors, $emailerr);
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailformat = 'Enter valid email.';
                array_push($errors, $emailformat);
            } else {
                $email = $_POST['email'];
            }
        }

        $designation = $_POST['designation'];
        if (empty($_POST['designation'])) {
            $designationerr = '*Designation is required.';
            array_push($errors, $designationerr);
        } else {
            $designation = $_POST['designation'];
        }

        $password = $_POST['password'];
        if (empty($_POST['password'])) {
            $passworderr = '*Password is required.';
            array_push($errors, $passworderr);
        } else {
            if (strlen($password) < 8) {
                $passwordstrength = 'Password must be atlest 8 characters.';
                array_push($errors, $passwordstrength);
            } else {
                $password = $_POST['password'];
            }
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $designation = $_POST['designation'];
        $password = $_POST['password'];

        // required field


        if (count($errors) == 0) {
            $sql = "INSERT INTO employees (name, email, designation, password)
            VALUES ('$name', '$email', '$designation', '$password')";
            if ($conn->query($sql) === TRUE) {
                echo '';
            } else {
                echo 'Error Inserting' . $conn->error;
            }
        }
    }
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $result = mysqli_query($conn, "SELECT * FROM employees WHERE id =$id");
        $row = mysqli_fetch_array($result);
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $password = $row['password'];
    }


    $conn = mysqli_connect('localhost', 'root', '', 'company');
            $nameerrmodal = $emailerrmodal = $emailformatmodal = $designationerrmodal = $passworderrmodal = $passwordstrengthmodal =  "";
            $error = array();


            if (isset($_POST['update'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $designation = $_POST['designation'];
                $password = $_POST['password'];
                $conn = mysqli_connect('localhost', 'root', '', 'company');

                $result = ("UPDATE employees SET name = '$name', email = '$email', designation = '$designation', password = '$password' WHERE id = '$id'");
                if ($conn->query($result) === TRUE) {
                    echo 'Record updated successfully';
                } else {
                    echo 'Update failed';
                }
                $conn->close();
            }
           if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $conn = mysqli_connect('localhost', 'root', '', 'company');
        $result = mysqli_query($conn, "DELETE FROM employees WHERE id =$id");
           }
    ?>
    <!-- form on first loaded page -->

    <form class="container card col-lg-3 col-md-12 col-sm-12 " method="POST" action="index.php">
        Name: <br>
        <input type="text" name="name">
        <span class="error">
            <p><?php echo $nameerr; ?></p>
        </span><br>
        E-mail: <br>
        <input type="text" name="email">
        <span class="error">
            <p><?php echo $emailerr;
                echo $emailformat; ?></p>
        </span><br>
        Designation: <br>
        <input type="text" name="designation">
        <span class="error">
            <p><?php echo $designationerr; ?></p>
        </span><br>
        Password: <br>
        <input type="password" name="password">
        <span class="error">
            <p><?php echo $passworderr;
                echo $passwordstrength; ?></p>
        </span><br>
        <input type="submit" class="btn btn-primary col-lg-3 col-sm-6 left" name="submit" value="submit"> <br>
    </form>

    <!--READ  THE DATA    -->
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'company');
    $result = mysqli_query($conn, "SELECT * FROM employees");
    // print_r($result);
    // exit;
    ?>

    <table class="table table-hover table-responsive">
        <thead class="table-light">
            <tr>
                <td> s.no </td>
                <td> Name </td>
                <td> E-Mail </td>
                <td> Designation </td>
                <td> Password </td>
                <td> Action </td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($result)) :
                $i++;
            ?>
                <tr>
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $row['name']; ?> </td>
                    <td> <?php echo $row['email']; ?> </td>
                    <td> <?php echo $row['designation']; ?> </td>
                    <td> <?php echo $row['password']; ?> </td>
                    <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-<?php echo $row['id']; ?>"> Edit </button>
                        <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                    <!-- MODAL -->
                    <div class="modal fade" id="modal-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Form</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="index.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        Name: <input type="text" name="name" value="<?php echo $row['name'] ?>">
                                        <br>
                                        <br>
                                        E-mail: <input type="text" name="email" value="<?php echo $row['email'] ?>">
                                        <br>
                                        <br>
                                        Designation: <input type="text" name="designation" value="<?php echo $row['designation'] ?>">
                                        <br>
                                        <br>
                                        Password: <input type="text" name="password" value="<?php echo $row['password'] ?>">
                                        <br>
                                        <br>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" name="update" data-bs-dismiss="modal" value="update">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>

</html>