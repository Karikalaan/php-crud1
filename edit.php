<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>EDIT</title>
</head>

<body>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'crud');
    if ($conn->connect_error) {
        die("Connection failed" . $conn->connect_error);
    } 
    if (isset($_GET['edit'])) {
        $result = mysqli_query($conn, "SELECT * FROM form WHERE id =$id");
        $row = mysqli_fetch_array($result);
        $id = $row['id'];
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
    }


    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $password = $_POST['password'];
        $conn = mysqli_connect('localhost', 'root', '', 'crud');

        $result = ("UPDATE form SET username = '$username', email = '$email',phonenumber = '$phonenumber' , password = '$password' WHERE id = '$id'");
        if ($conn->query($result) === TRUE) {
          header("location:login.php");;
        } else {
            echo 'Update failed';
        }
        $conn->close();
    }

    ?>
    <table class="table table-hover table-responsive">
        <thead class="table-light">
            <tr>
                <td>Si.no</td>
                <td>User name</td>
                <td>User mail</td>
                <td>Phone number</td>
                <td>Action</td>
            </tr>
        </thead>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'crud');
        $records = mysqli_query($conn,"select * from form"); 
        while($row = mysqli_fetch_array($records)) :
?>
        
            <tbody>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phonenumber']; ?></td>
                    <td> <a href="edit.php?edit=<?php echo $row ['id']; ?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-<?php echo $row['id']; ?>"> Edit </button>
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
                                    <form action="edit.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        Name: <input type="text" name="username" value="<?php echo $row['username'] ?>">
                                        <br>
                                        <br>
                                        E-mail: <input type="text" name="email" value="<?php echo $row['email'] ?>">
                                        <br>
                                        <br>
                                        Phonenumber: <input type="text" name="phonenumber" value="<?php echo $row['phonenumber'] ?>">
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>