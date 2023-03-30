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


$query = "INSERT INTO mahasiswa(nama, nrp, jenis_kelamin, kelas, jurusan, email, alamat, no_hp, asal_sma) VALUES ('$nama', '$nrp', '$jenis_kelamin', '$kelas', '$jurusan', '$email', '$alamat', '$no_hp', '$asal_sma')";
$data = $db->prepare($query);
$data->execute();

header("location: ../view/home.php");
