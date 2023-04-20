<?php

use Controller\mahasiswaController;
use Repository\MahasiswaRepository;
use config\database;
use Models\Mahasiswa;

require_once __DIR__ . "/../controller/mahasiswaController.php";
require_once __DIR__ . "/../repository/mahasiswaRepository.php";
require_once __DIR__ . "/../model/mahasiswa.php";
require_once __DIR__ . "/../config/database.php";


$connection = database::getConnection();
$mahasiswaRepository = new MahasiswaRepository($connection);
$mahasiswaController = new mahasiswaController($mahasiswaRepository);

$person = $mahasiswaController->showMahasiswa($_GET['id'])[1];

if (isset($_POST['id'])) {

    $mahasiswaController->updateMahasiswa(
        $_POST['nrp'],
        $_POST['nama'],
        $_POST['jenis_kelamin'],
        $_POST['kelas'],
        $_POST['jurusan'],
        $_POST['email'],
        $_POST['alamat'],
        $_POST['no_hp'],
        $_POST['asal_sma'],
        $_POST['id']
    );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT MAHASISWA</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-3">
        <div class="h3 text-center">EDIT MAHASISWA</div>

        <div class="mt-3 text-center">
            <div class="card">
                <div class="card-body">

                    <form action="edit.php" method="post">

                        <input type="text" name="nrp" id="" class="form-control mb-2" placeholder="nrp..." value="<?= $person->getNrp() ?>">
                        <input type="text" name="nama" id="" class="form-control mb-2" placeholder="nama..." value="<?= $person->getNama() ?>">
                        <div class=" form-group">
                            <select class="form-control" name="jenis_kelamin">
                                <option selected disabled>pilih gender</option>
                                <option value="laki-laki">laki-laki</option>
                                <option value="perempuan">perempuan</option>
                            </select>
                        </div>
                        <input type="text" name="kelas" id="" class="form-control mb-2" placeholder="kelas..." value="<?= $person->getKelas() ?>">
                        <div class="form-group">
                            <select class="form-control" name="jurusan">
                                <option selected disabled>pilih jurusan</option>
                                <option value="laki-laki">teknik informatika</option>
                                <option value="perempuan">teknik komputer</option>
                                <option value="perempuan">sains data</option>
                            </select>
                        </div>
                        <input type="email" name="email" id="" class="form-control mb-2" placeholder="email..." value="<?= $person->getEmail() ?>">
                        <input type="text" name="alamat" id="" class="form-control mb-2" placeholder="alamat..." value="<?= $person->getAlamat() ?>">
                        <input type="text" name="no_hp" id="" class="form-control mb-2" placeholder="No HP..." value="<?= $person->getNoHp() ?>">
                        <input type="text" name="asal_sma" id="" class="form-control mb-2" placeholder="asal sma..." value="<?= $person->getAsalSMA() ?>">
                        <input type="hidden" value="<?= $person->getId() ?>" name="id">

                        <button type="submit" class="btn btn-primary">submit</button>
                        <a href="home.php" class="btn btn-danger">back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>