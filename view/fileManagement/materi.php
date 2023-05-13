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
    <title>materi</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php require_once __DIR__ . "/../components/navbar.php" ?>

    <div class="pl-4">
        <div class="h1 pt-4">TEKNIK INFORMATIKA</div>
        <div class="row">
            <div class="col-md-10">
                <div class="h2 pb-1">Mata Kuliah</div>
            </div>
            <?php if ($_SESSION['role'] == "dosen") : ?>
                <div class="col-md-2">
                    <button class="btn btn-info">tambah matkul</button>
                </div>
            <?php endif; ?>
        </div>
        <hr>
    </div>

    <?php if ($_SESSION['role'] == "mahasiswa") : ?>

        <div class="row">
            <div class="col-md-6">
                <div class="my-4 box-shadow">
                    <div class="card shadow p-3 py-2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-1 h5">Algoritma Struktur Data</div>
                            </div>

                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <form action="" method="post">
                                    <button class="btn btn-primary">pilih</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="my-4 box-shadow">
                    <div class="card shadow p-3 py-2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-1 h5">5. Stack</div>
                            </div>

                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <form action="" method="post">
                                    <button class="btn btn-primary">pilih</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else : ?>
        <div class="row">
            <div class="col-md-6">
                <div class="my-4 box-shadow">
                    <div class="card shadow p-3 py-2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-1 h5">Algoritma Struktur Data</div>
                            </div>

                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <form action="" method="post">
                                    <button class="btn btn-primary">pilih</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="my-4 box-shadow">
                    <div class="card shadow p-3 py-2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-1 h5">5. Stack</div>
                            </div>

                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <form action="" method="post">
                                    <button class="btn btn-primary">pilih</button>
                                </form>
                            </div>
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