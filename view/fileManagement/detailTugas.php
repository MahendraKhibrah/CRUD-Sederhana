<?php

use config\database;

session_start();
if ($_SESSION['auth'] == false) {
    header("location: /praktikum_5/view/auth/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETAIL TUGAS</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php require_once __DIR__ . "/../components/navbar.php" ?>

    <div class="pl-4">
        <div class="h1 pt-4">4. QUEUE</div>
    </div>

    <?php if ($_SESSION['role'] == "mahasiswa") : ?>
        <div class="row">
            <div class="col-md-8">
                <div class="my-4 box-shadow">
                    <div class="card shadow p-3 py-2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-1 font-weight-bold">Deskripsi : </div>
                                <span class="mb-1">bla bla bla</span>

                                <div class="mb-1 font-weight-bold">Mengumpulkan : </div>
                                <span class="mb-1">-</span>

                                <div class="mb-1 font-weight-bold">Lampiran : </div>
                                <span class="mb-1">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="my-4 box-shadow">
                    <div class="card shadow p-3 py-2">
                        <div class="d-flex flex-column">
                            <button class="btn btn-primary mt-auto mb-2">submit tugas</button>
                            <button class="btn btn-secondary mt-auto" disabled>anda sudah submit</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>