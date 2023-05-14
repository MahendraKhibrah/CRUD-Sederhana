<?php


use Controller\FileTugasController;
use Repository\FileTugasRepository;
use config\database;

require_once __DIR__ . "/../../controller/fileTugasController.php";
require_once __DIR__ . "/../../repository/fileTugasRepository.php";
require_once __DIR__ . "/../../model/tugass.php";
require_once __DIR__ . "/../../config/database.php";

$connection = database::getConnection();
$fileTugasRepository = new FileTugasRepository($connection);
$fileTugasController = new FileTugasController($fileTugasRepository);


session_start();
if ($_SESSION['auth'] == false) {
    header("location: /praktikum_5/view/auth/login.php");
}

if (isset($_POST['submitTugas'])) {
    $fileTugasController->createTugas($_POST['tugas'], $_POST['deskripsi'], $_POST['idMatkul'], $_POST['namaMatkul']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUGAS</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php require_once __DIR__ . "/../components/navbar.php" ?>

    <div class="pl-4">
        <div class="h1 pt-4"><?= $_GET['a'] ?></div>
        <div class="row">

            <div class="col-md-10">
                <div class="h2 pb-1">Tugas</div>
            </div>
            <?php if ($_SESSION['role'] == "dosen") : ?>
                <div class="col-md-2">
                    <button class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">tambah tugas</button>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <hr>
    </div>


    <div class="row">
        <?php foreach ($fileTugasController->getTugas($_GET['b']) as $tugas) : ?>
            <div class="col-md-6">
                <div class="mx-2 my-4 box-shadow">
                    <div class="card shadow p-3 py-2 mx-2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-1 h5"><?= $tugas->getNama() ?></div>
                            </div>

                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <form action="detailTugas.php" method="post">
                                    <input type="hidden" name="tugas" value="<?= $tugas->getId() ?>">
                                    <button class="btn btn-primary">detail</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">TAMBAH TUGAS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="tugas.php" method="post">
                        <input type="text" class="form-control mb-2" name="tugas" placeholder="masukkan judul tugas..">
                        <input type="text" class="form-control" name="deskripsi" placeholder="masukkan deskripsi tugas..">
                        <input type="hidden" name="idMatkul" value="<?= $_GET['b'] ?>">
                        <input type="hidden" value="<?= $_GET['a'] ?>" name="namaMatkul">
                        <input type="hidden" name="submitTugas" value="submitted">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">submit</button>
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