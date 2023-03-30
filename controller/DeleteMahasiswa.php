<?php

require_once __DIR__ . "/../config/database.php";

use config\database;

$db = database::getConnection();

$id = $_GET['id'];
$query = "DELETE FROM mahasiswa WHERE id='$id'";
$data = $db->prepare($query);
$data->execute();

header("location: ../view/home.php");
