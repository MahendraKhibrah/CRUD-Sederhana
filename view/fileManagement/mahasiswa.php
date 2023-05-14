<?php

use Controller\FileTugasController;
use Repository\FileTugasRepository;
use config\database;

require_once __DIR__ . "/../../controller/fileTugasController.php";
require_once __DIR__ . "/../../repository/fileTugasRepository.php";
require_once __DIR__ . "/../../model/file_tugas.php";
require_once __DIR__ . "/../../config/database.php";

$connection = database::getConnection();
$fileTugasRepository = new FileTugasRepository($connection);
$fileTugasController = new FileTugasController($fileTugasRepository);

if (isset($_POST['submit'])) {
    $fileTugasController->uploadFile(
        $_FILES['file']['tmp_name'],
        $_FILES['file']['name'],
        $_FILES['file']['size'],
        $_FILES['file']['type'],
        $_POST['deskripsi'],
        "",
        ""
    );
    var_dump($fileTugasController->showFile());
    die;
}

if (isset($_POST['download'])) {
    $fileTugasController->downloadFile($_POST['download']);
}

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

    <title>TUGAS</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <?php require_once __DIR__ . "/../components/navbar.php" ?>

    <div class="container mt-3">

        <div class="h3 text-center">FILE TUGAS MAHASISWA</div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            tambah data
        </button>

    </div>
    <div class="container mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">ukuran</th>
                    <th scope="col">tipe</th>
                    <th scope="col">deskripsi</th>
                    <th scope="col">menu</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($fileTugasController->showFile() as $file) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $file->getNama(); ?></td>
                        <td><?= $file->getUkuran(); ?></td>
                        <td><?= $file->getTipe(); ?></td>
                        <td><?= $file->getDeskripsi(); ?></td>
                        <td>
                            <form method="post" action="mahasiswa.php">
                                <button class="btn btn-success" type="submit" value="<?= $file->getId() ?>" name="download">download</button>
                            </form>
                        </td>
                    </tr>
                <?php $i++;
                endforeach; ?>
            </tbody>
            <tbody>

            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">TAMBAH DATA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="mahasiswa.php" method="post" enctype="multipart/form-data">

                        <label class="form-label">File Tugas : </label>
                        <input type="file" name="file" id="" class="form-control mb-2">

                        <label class="form-label">deskripsi : </label>
                        <input type="text" name="deskripsi" id="" class="form-control mb-2">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit" value="submitted">submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>