<?php

class ParkirModel
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function getDataParkir()
    {
        return mysqli_query($this->koneksi, "SELECT * FROM parkir");
    }
}
?>