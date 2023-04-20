<?php

use Controller\UserController;
use Repository\UserRepository;
use config\database;

require_once __DIR__ . "/../../controller/userController.php";
require_once __DIR__ . "/../../repository/userRepository.php";
require_once __DIR__ . "/../../model/user.php";
require_once __DIR__ . "/../../config/database.php";


$connection = database::getConnection();
$userRepository = new UserRepository($connection);
$userController = new UserController($userRepository);

if (isset($_POST['username'])) {
    $userController->loginUser($_POST['username'], $_POST['password']);
}

session_start();
if (isset($_SESSION['auth'])) {
    if ($_SESSION['auth'] == false) {
        header("location: /praktikum_5/view/tabelMahasiswa/home.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <?php require_once __DIR__ . "/../components/navbar.php" ?>

    <div class="card container" style="width: 30rem; margin-top: 10rem;">
        <div class="card-body">
            <div class="card-title h3 weight-bold">LOGIN</div>
            <form action="login.php" method="post">

                <label class="form-label">username : </label>
                <input type="text" name="username" class="form-control mb-2">

                <label class="form-label">password : </label>
                <input type="password" name="password" class="form-control mb-2">

                <div class="container pt-2">
                    <div class="row">
                        <input type="submit" class="btn btn-primary col-sm-3">
                        <div class="col-sm-6"></div>
                        <a href="/praktikum_5/view/auth/register.php" class="col-sm-3 pl-4">register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>