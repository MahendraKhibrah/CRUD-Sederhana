<?php
require_once __DIR__ . "/../config/database.php";

use config\database;

$db = database::getConnection();
$query = "SELECT * FROM mahasiswa";
$data = $db->prepare($query);
$data->execute();

$persons = $data->fetchAll(\PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-3">

        <div class="h3 text-center">DATA MAHASISWA TEKNIK INFORMATIKA</div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            tambah data
        </button>

    </div>
    <div class="container mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NRP</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">kelas</th>
                    <th scope="col">jurusan</th>
                    <th scope="col">email</th>
                    <th scope="col">alamat</th>
                    <th scope="col">no hp</th>
                    <th scope="col">asal sma</th>
                    <th scope="col">menu</th>

                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($persons as $person) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $person['nrp']; ?></td>
                        <td><?= $person['nama']; ?></td>
                        <td><?= $person['jenis_kelamin']; ?></td>
                        <td><?= $person['kelas']; ?></td>
                        <td><?= $person['jurusan']; ?></td>
                        <td><?= $person['email']; ?></td>
                        <td><?= $person['alamat']; ?></td>
                        <td><?= $person['no_hp']; ?></td>
                        <td><?= $person['asal_sma']; ?></td>
                        <td><a class="btn btn-warning" href="edit.php?id=<?= $person['id'] ?>">edit</a>
                            <form action="../controller/DeleteMahasiswa.php?id=<?= $person['id'] ?>" method="post">
                                <button class="btn btn-danger">delete</button>
                            </form>
                        </td>
                    </tr>
                <?php $i++;
                endforeach; ?>
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
                    <form action="../controller/CreateMahasiswa.php" method="post">
                        <input type="text" name="nrp" id="" class="form-control mb-2" placeholder="nrp...">
                        <input type="text" name="nama" id="" class="form-control mb-2" placeholder="nama...">
                        <div class="form-group">
                            <select class="form-control" name="jenis_kelamin">
                                <option selected disabled>pilih gender</option>
                                <option value="laki-laki">laki-laki</option>
                                <option value="perempuan">perempuan</option>
                            </select>
                        </div>
                        <input type="text" name="kelas" id="" class="form-control mb-2" placeholder="kelas...">
                        <div class="form-group">
                            <select class="form-control" name="jurusan">
                                <option selected disabled>pilih jurusan</option>
                                <option value="laki-laki">teknik informatika</option>
                                <option value="perempuan">teknik komputer</option>
                                <option value="perempuan">sains data</option>
                            </select>
                        </div>
                        <input type="email" name="email" id="" class="form-control mb-2" placeholder="email...">
                        <input type="text" name="alamat" id="" class="form-control mb-2" placeholder="alamat...">
                        <input type="text" name="no_hp" id="" class="form-control mb-2" placeholder="No HP...">
                        <input type="text" name="asal_sma" id="" class="form-control mb-2" placeholder="asal sma...">

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