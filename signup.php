<?php
session_start();
include "database.php";
include "process.php";


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="card col-lg-5 col-sm-6 col-8 ">

        <h3 class="text-center">Signup</h3>
        <form action="" method="post" id="frm" class="needs-validation" novalidate>



            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control uname" name="uname" id="uname" pattern="[a-z0-9_]{6,}" placeholder="Enter Username" required autocomplete="off">
                <div class="valid-feedback"></div>
                <p class="text-danger"><?php if (isset($errors[1])) echo $errors[1]; ?></p>
            </div>


            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="mail" class=" form-control uemail" name="uemail" id="uemail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" placeholder="Enter Email" required autocomplete="off">
                <div class="valid-feedback"></div>

                <p class="text-danger"><?php if (isset($errors[2])) echo $errors[2]; ?></p>
            </div>


            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="mail" class=" form-control phone" name="phone" id="phone" pattern="[6789][0-9]{9}" placeholder="Enter Mobile No" required autocomplete="off">
                <div class="valid-feedback"></div>

                <p class="text-danger"><?php if (isset($errors[3])) echo $errors[3]; ?></p>
            </div>


            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class=" form-control pswd" name="upass" id="upass" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                <div class="valid-feedback"></div>

                <p class="text-danger"><?php if (isset($errors[4])) echo $errors[4]; ?></p>
            </div>





            <div class="d-grid gap-2">
                <button class="btn btn-primary mt-3" id="signup" name="signup" type="submit">Signup</button>
            </div>

        </form>

        <div id="result"></div>
        <div class="signup-text p-4" <span>Already have an account? </span>
            <a href="login.php"> Login</a>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
        $(document).ready(function() {
            $("#signup").click(function() {
                $.ajax({
                    type: "POST",
                    url: "process.php",
                    data: $("#frm").serialize(),

                    success: function(d) {
                        // $("#frm")[0].reset();
                    }
                })
            })
        });
    </script>

</body>


</html>