<?php

$con = mysqli_connect('localhost', 'root', '', 'test');

$produk = "data.json";

$data = file_get_contents($produk);

$array = json_decode($data, true);

foreach ($array as $value) {

    $query = "INSERT INTO `db_produk` (`no`, `id_produk`, `nama_produk`, `harga`, `kategori`, `status`) VALUES ('" . $value['no'] . "', '" . $value['id_produk'] . "', '" . $value['nama_produk'] . "', '" . $value['harga'] . "', '" . $value['kategori'] . "', " . ($value['status'] == "bisa dijual" ? 1 : 2) . ")";

    mysqli_query($con, $query);
}

echo "Data Tersimpan...!!!";
