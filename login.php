<?php
include "database.php";


$login = false;
if (isset($_POST['uname']) and isset($_POST['pass'])) {
    $user = $_POST["uname"];
    $pass = $_POST["pass"];
    $pswd = md5($pass);
    session_start();
    $sql = "select * from user where username='$user' ";
    $res = $db->query($sql);
    // print_r($res);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        echo $row['password'];
        if ($row['password'] == $pswd) {
            $_SESSION["ID"] = $row["id"];
            $login = true;
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


    <?php

    if ($login) {
        header("location:profile.php");
    } else {




    ?>
        <div class="card col-lg-5 col-sm-6 col-8 ">
            <h3 class="text-center">Login</h3>
            <form action="" method="post" id="frm">



                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control uname" name="uname" id="uname" placeholder="Enter name">
                </div>


                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control cpswd" name="pass" id="ucpass" placeholder="Enter Password">
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary mt-3" type="submit" id="login" name="login">Login</button>
                </div>


            </form>


            <div class="signup-text p-4" <span>Create an account? </span>
                <a href="signup.php"> Signup</a>
            </div>
        </div>
    <?php
    }
    ?>

</body>


</html>