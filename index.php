<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/all.min.css">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html"><i class="fa-solid fa-bars-progress"></i> Data Produk</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div>
                            Data Produk
                        </a>
                        <a class="nav-link" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Produk</h1>
                    <div class="container mb-4">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="fa-solid fa-plus"></i> Add Data
                        </button>
                        <!-- The Modal -->
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title"> Add Data</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <form method="POST">
                                        <div class="modal-body">
                                            <input type="number" name="no" placeholder="No" class="form-control" require>
                                            <br>
                                            <input type="number" name="id_produk" placeholder="Id Produk" class="form-control" require>
                                            <br>
                                            <input type="text" name="nama_produk" placeholder="Nama Produk" class="form-control" require>
                                            <br>
                                            <input type="number" name="harga" placeholder="Harga" class="form-control" require>
                                            <br>
                                            <select name="Kategori" class="form-control">
                                                <?php
                                                $getKategori = mysqli_query($conn, "SELECT * FROM db_produk");
                                                while ($fetcharray = mysqli_fetch_array($getKategori)) {
                                                    $kategori = $fetcharray['kategori'];
                                                    $idproduk = $fetcharray['id_produk'];
                                                ?>
                                                    <option value="<?= $idproduk ?>"><?= $kategori ?></option>
                                                <?php
                                                }
                                                ?>


                                            </select>
                                            <br>
                                            <button type="submit" class="btn btn-success" name="add"><i class="fa-solid fa-plus"></i> Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getalldata = mysqli_query($conn, "SELECT * FROM db_produk");
                                    while ($data = mysqli_fetch_array($getalldata)) {
                                        $no = $data['no'];
                                        $id_produk = $data['id_produk'];
                                        $nama_produk = $data['nama_produk'];
                                        $harga = $data['harga'];
                                        $kategori = $data['kategori'];
                                        $status = $data['status'];
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $id_produk ?></td>
                                            <td><?= $nama_produk ?></td>
                                            <td><?= $harga ?></td>
                                            <td><?= $kategori ?></td>
                                            <td><?= $status ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit<?= $no ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $no ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?= $no ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="no" value="<?= $no ?>">
                                                            <input type="text" name="nama_produk" value="<?= $nama_produk ?>" class="form-control" require>
                                                            <br>
                                                            <input type="number" name="harga" value="<?= $harga ?>" class="form-control" require>
                                                            <br>
                                                            <select name="Kategori" class="form-control">
                                                                <?php
                                                                $getKategori = mysqli_query($conn, "SELECT * FROM db_produk");
                                                                while ($fetcharray = mysqli_fetch_array($getKategori)) {
                                                                    $kategori = $fetcharray['kategori'];
                                                                    $idproduk = $fetcharray['id_produk'];
                                                                ?>
                                                                    <option value="<?= $idproduk ?>"><?= $kategori ?></option>
                                                                <?php
                                                                }
                                                                ?>


                                                            </select>
                                                            <br>
                                                            <button type="submit" class="btn btn-primary" name="editproduk"><i class="fa-solid fa-pen"></i> Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete<?= $no ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="no" value="<?= $no ?>">
                                                            Apakah anda akan menghapus barang <?= $nama_produk ?> ?
                                                            <br>
                                                            <br>
                                                            <button type="submit" class="btn btn-danger" name="deleteproduk"><i class="fa-solid fa-xmark"></i> Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php

                                    };

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="./js/all.min.js"></script>
</body>

</html>