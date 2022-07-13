<?php

session_start();

// KONEKSI

$conn = mysqli_connect("localhost", "root", "", "test");

$produk = "data.json";

$data = file_get_contents($produk);

$array = json_decode($data, true);

foreach ($array as $value) {

    $query = "INSERT INTO `db_produk` (`no`, `id_produk`, `nama_produk`, `harga`, `kategori`, `status`) VALUES ('" . $value['no'] . "', '" . $value['id_produk'] . "', '" . $value['nama_produk'] . "', '" . $value['harga'] . "', '" . $value['kategori'] . "', " . ($value['status'] == "bisa dijual" ? 1 : 2) . ")";

    mysqli_query($conn, $query);
}

// TAMBAH PRODUK

if (isset($_POST['add'])) {
    $no = $_POST['no'];
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    $add = mysqli_query($conn, "insert into db_produk(no, id_produk, nama_produk, harga, kategori) values('$no','$id_produk','$nama_produk','$harga','$kategori')");

    mysqli_query($conn, $add);

    if ($add) {
        header('location:index.php');
    } else {
        header('location:404.php');
    }
}

// EDIT PRODUK

if (isset($_POST['editproduk'])) {
    $no = $_POST['no'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    $update = mysqli_query($conn, "UPDATE db_produk SET no='$no', nama_produk='$nama_produk', harga='$harga', kategori='$kategori' WHERE no= $no");
    mysqli_query($conn, $update);

    if ($update) {
        header('location:index.php');
    } else {
        header('location:404.php');
    }
}


// HAPUS PRODUK

if (isset($_POST['deleteproduk'])) {
    $no = $_POST['no'];

    $delete = mysqli_query($conn, "DELETE FROM db_produk WHERE no=$no");

    if ($delete) {
        header('location:index.php');
    } else {
        header('location:404.php');
    }
}
