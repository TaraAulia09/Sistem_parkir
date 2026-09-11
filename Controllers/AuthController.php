<?php

include "../Database/Koneksi.php";
include "../Models/ParkirModel.php";

$model = new ParkirModel($koneksi);

if (isset($_POST['simpan'])) {
    $model->simpanData($_POST);
    header("Location: ../View/Parkir/DataParkir.php");
    exit;
}
?>