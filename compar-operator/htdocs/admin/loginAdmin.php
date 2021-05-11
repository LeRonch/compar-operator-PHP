<?php
session_start();
include('../config/db.php');
include('../config/autoload.php');


if (isset($_POST['login'])) {

    $admin_pseudo = !empty($_POST['name']) ? trim($_POST['name']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    $sql =
        "SELECT * 
    FROM admin 
    WHERE name = :name";

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':name', $admin_pseudo);

    $stmt->execute();

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin === false) {
        header('Location: loginAdmin.php?message=Information(s)erronée(s)');
        exit('Information(s) erronée(s)');
    } else {

        if ($passwordAttempt == $admin['password']) {

            $_SESSION['id'] = $admin['id'];
            $_SESSION['logged_in'] = time();
            $_SESSION['name'] = $admin['name'];
            header('Location: ../index.php');
            exit;
        } else {

            header('Location: loginAdmin.php?message=Information(s)erronée(s)');
            exit;
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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style/admin.css">
</head>

<body id="login">

    <form action="" class='login-form' method="post">

        <div class="flex-row">
            <label class="lf--label" for="username">
            <i class="fa fa-user" aria-hidden="true"></i>
            </label>
            <input id="username" class='lf--input' placeholder='Administrator' name="name" type="text">
        </div>

        <div class="flex-row">
            <label class="lf--label" for="password">
            <i class="fa fa-lock" aria-hidden="true"></i>
            </label>
            <input id="password" class='lf--input' placeholder='Password' name="password" type="password">
        </div>

        <input class='lf--submit' name="login" type='submit' value='LOGIN'>

    </form>

</body>