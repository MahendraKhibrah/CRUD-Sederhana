<?php

use Controller\FileTugasController;
use Repository\FileTugasRepository;
use config\database;

require_once __DIR__ . "/../../controller/fileTugasController.php";
require_once __DIR__ . "/../../repository/fileTugasRepository.php";
require_once __DIR__ . "/../../model/fileTugas.php";
require_once __DIR__ . "/../../model/tugass.php";
require_once __DIR__ . "/../../config/database.php";

$connection = database::getConnection();
$fileTugasRepository = new FileTugasRepository($connection);
$fileTugasController = new FileTugasController($fileTugasRepository);

session_start();
if ($_SESSION['auth'] == false) {
    header("location: /praktikum_5/view/auth/login.php");
} else {
    $idTugas = 0;
    if (!isset($_POST['tugas'])) {
        if (!isset($_POST['idTugas'])) {
            header("location: /praktikum_5/view/fileManagement/materi.php");
        }
        $idTugas = $_POST['idTugas'];
    } else {
        $idTugas = $_POST['tugas'];
    }
}

if (isset($_POST['submitFile'])) {
    $fileTugasController->uploadFile(
        $_FILES['file']['tmp_name'],
        $_FILES['file']['name'],
        $_FILES['file']['size'],
        $_FILES['file']['type'],
        $_POST['deskripsi'],
        $_SESSION['username'],
        $_POST['idTugas']
    );
}

if (isset($_POST['download'])) {
    $fileTugasController->downloadFile($_POST['download']);
}

if (isset($_POST['insertNilai'])) {
    $fileTugasController->updateNilai($_POST['nilai'], $_POST['insertNilai']);
}

$tugas = $fileTugasController->getTugas(0, $idTugas);
$fileAll = $fileTugasController->showFile($idTugas, "");
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

    <div class="container">
        <div class="h1 pt-4">4. QUEUE</div>
    </div>

    <?php if ($_SESSION['role'] == "mahasiswa") : ?>
        <div class="container">

            <div class="row">
                <div class="col-md-8">
                    <div class="my-4 box-shadow">
                        <div class="card shadow p-3 py-2">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-1 font-weight-bold">Deskripsi : </div>
                                    <span class="mb-1"><?= $tugas->getDeskripsi() ?></span>

                                    <div class="mb-1 font-weight-bold">Mengumpulkan : </div>
                                    <?php if ($fileTugasController->showFile($idTugas, $_SESSION['username'])) : ?>
                                        <span class="mb-1">sudah Mengumpulkan</span>
                                    <?php else : ?>
                                        <span class="mb-1">-</span>
                                    <?php endif; ?>

                                    <div class="mb-1 font-weight-bold">Lampiran : </div>
                                    <?php if ($file = $fileTugasController->showFile($idTugas, $_SESSION['username'])) : ?>
                                        <img src="<?= $file->getPath() ?>">
                                    <?php else : ?>
                                        <span class="mb-1">-</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="my-4 box-shadow">
                        <div class="card shadow p-3 py-2">
                            <div class="d-flex flex-column">
                                <?php $file = $fileTugasController->showFile($idTugas, $_SESSION['username']);
                                if (!$file) : ?>
                                    <form action="detailTugas.php" method="post" enctype="multipart/form-data">
                                        <label class=" form-label">File Tugas : </label>
                                        <input type="file" name="file" id="" class="form-control mb-2">

                                        <label class="form-label">deskripsi : </label>
                                        <input type="text" name="deskripsi" id="" class="form-control mb-2">

                                        <input type="hidden" name="idTugas" value="<?= $_POST['tugas'] ?>">

                                        <input type="submit" value="submit tugas" class="btn btn-primary mt-auto" name="submitFile">
                                    </form>
                                <?php else : ?>
                                    <button class="btn btn-secondary mt-auto mb-2" disabled>anda sudah submit</button>
                                    <?php if ($file->getNilai() != "-") : ?>
                                        <button class="btn btn-success mt-auto" disabled>nilai : <?= $file->getNilai() ?></button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="my-4 box-shadow">
                        <div class="card shadow p-3 py-2">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-1 font-weight-bold">Deskripsi : </div>
                                    <span class="mb-1"><?= $tugas->getDeskripsi() ?></span>

                                    <div class="mb-1 font-weight-bold">Mengumpulkan : </div>
                                    <span class="mb-1"><?= count($fileAll) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="my-4 box-shadow">
                        <div class="card shadow p-3 py-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">file</th>
                                        <th scope="col">nilai</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1;
                                    foreach ($fileAll as $file) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++ ?></th>
                                            <td><?= $file->getNamaUser() ?></td>
                                            <td>
                                                <form method="post" action="detailTugas.php">
                                                    <input type="hidden" name="idTugas" value="<?= $idTugas ?>">
                                                    <button class="btn btn-warning" type="submit" value="<?= $file->getId() ?>" name="download">download</button>
                                                </form>
                                            </td>
                                            <td>
                                                <?php if ($file->getNilai() == "-") : ?>
                                                    <form method="post" action="detailTugas.php">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <input type="text" name="nilai" class="form-control">
                                                            </div>
                                                            <input type="hidden" name="idTugas" value="<?= $idTugas ?>">
                                                            <div class="col-md-4">
                                                                <button class="btn btn-primary" type="submit" value="<?= $file->getId() ?>" name="insertNilai">beri Nilai</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                <?php else : ?>
                                                    <?= $file->getNilai() ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
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