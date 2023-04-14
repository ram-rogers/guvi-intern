<?php


include 'database.php';
session_start();

$user_id = $_SESSION["ID"];


if (!isset($_SESSION['ID'])) {
    header('location:login.php');
}

if (isset($_POST['update'])) {

    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];


    $sql = "UPDATE `user` SET `age`='$age',`dob`='$dob',`contact`='$contact' WHERE id=$user_id";
    $result = mysqli_query($db, $sql);

    if ($result) {
        header("location:profile.php");
    }
}

?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <button class="btn btn-danger" id="idpos"><a id="hyper" href="logout.php">Logout</a></button>
    <?php
    $view = "SELECT * from user where id=$user_id";
    $res = mysqli_query($db, $view);

    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
    }

    if ($fetch['age'] == null or $fetch['dob'] == null or $fetch['contact'] == null) {
    ?>

        <div class="card col-lg-5 col-sm-6 col-8 ">
            <h3 class="text-center">Update Profile</h3>
            <form action="" method="post" id="frm">



                <div class="mb-3">
                    <label class="form-label">Age</label>
                    <input type="text" class="form-control uname" name="age" placeholder="Enter Age">
                </div>


                <div class="mb-3">
                    <label class="form-label">DOB</label>
                    <input type="date" class="form-control cpswd" name="dob" placeholder="Enter DOB">
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact</label>
                    <input type="text" class="form-control cpswd" name="contact" placeholder="Enter Contact">
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary mt-3" type="submit" id="login" name="update">Update</button>
                </div>


            </form>
        <?php
    } else {
        $orgDate = $fetch['dob'];
        $newDate = date("d-m-Y", strtotime($orgDate));
        ?>
            <div class="card col-lg-5 col-sm-6 col-8 ">
                <h3 class="text-center">Profile Information</h3>
                <p>Age : <?= $fetch['age'] ?></p>
                <p>Dob : <?= $newDate ?></p>
                <p>Contact : <?= $fetch['contact'] ?></p>

            </div>
        <?php
    }

        ?>

        </div>
</body>

</html>