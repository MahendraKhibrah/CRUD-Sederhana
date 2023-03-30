<?php

require_once __DIR__ . "/../config/database.php";

use config\database;

$db = database::getConnection();

$nrp = $_POST['nrp'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$asal_sma = $_POST['asal_sma'];
$id = $_GET['id'];


$query = "UPDATE mahasiswa SET nrp='$nrp', nama='$nama', jenis_kelamin='$jenis_kelamin', kelas='$kelas', jurusan='$jurusan', email='$email', alamat='$alamat', no_hp='$no_hp', asal_sma='$asal_sma' WHERE id='$id'";
$data = $db->prepare($query);
$data->execute();

header("location: ../view/home.php");
