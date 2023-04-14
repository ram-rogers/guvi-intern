<?php

include "database.php";


if (isset($_POST['signup'])) {
    $name = $_POST["uname"];
    $email = $_POST["uemail"];
    $phone = $_POST["phone"];
    $pswd = $_POST["upass"];
    $pass = md5($pswd);
    $errors = array();


    $sql_u = "select * from user where username='$name'";
    $sql_e = "select * from user where email='$email'";

    $res_u = mysqli_query($db, $sql_u);
    $res_e = mysqli_query($db, $sql_e);


    if (empty($name)) {
        $errors[1] = "Enter Name";
    }

    if (mysqli_num_rows($res_u) > 0) {
        $errors[1] = "Sorry.... Username already taken";
    }



    if (empty($email)) {
        $errors[2] = "Enter Email";
    }
    if (mysqli_num_rows($res_e) > 0) {
        $errors[2] = "Sorry.... Email already taken";
    }

    if (empty($phone)) {
        $errors[3] = "Enter PhoneNumber";
    }

    if (empty($pswd)) {
        $errors[4] = "Enter New Password";
    }



    if ((count($errors) == 0)) {
        $sql = $db->prepare("insert into user (username, phone, email, password) VALUES (?,?,?,?)");
        $sql->bind_param("ssss", $name, $phone, $email, $pass);
        $sql->execute();

        $new_message = array(
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "password" => $pswd
        );

        if (filesize("db.json") == 0) {
            $first_record = array($new_message);
            $data_to_save = $first_record;
        } else {
            $old_records = json_decode(file_get_contents("db.json"));
            array_push($old_records, $new_message);
            $data_to_save = $old_records;
        }

        $encoded_data = json_encode($data_to_save, JSON_PRETTY_PRINT);

        if (!file_put_contents("db.json", $encoded_data, LOCK_EX)) {
            $error = "Error storing message, please try again";
        } else {
            $success =  "Message is stored successfully";
        }
        header("location:success.php");
    }
}
