<?php
    require 'function.php';
    require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Kelola Admin -  DamTech</title>

        <!-- Custom fonts -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles -->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
                
                <!-- Sidebar -  DamTech -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="stock.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3"> DamTech</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Home -->
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Home</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <!-- Nav Item - Barang Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Barang</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Barang :</h6>
                            <a class="collapse-item" href="stock.php">Stock Barang</a>
                            <a class="collapse-item" href="masuk.php">Barang Masuk</a>
                            <a class="collapse-item" href="keluar.php">Barang Keluar</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Profile
                </div>

                <!-- Nav Item - Barang Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile"
                        aria-expanded="true" aria-controls="collapseProfile">
                        <i class="fas fa-fw fa-book"></i>
                        <span>User</span>
                    </a>
                    <div id="collapseProfile" class="collapse" aria-labelledby="headingProfile"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">dark User :</h6>
                            <a class="collapse-item" href="admin.php">Kelola Admin</a>
                            <a class="collapse-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User darkrmation -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['email'];?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>

                            <!-- Dropdown - User darkrmation -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->



                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Kelola Admin</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                <!-- Page Heading -->
                <p class="mb-4">Mengelola Admin.</p>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-dark">Tabel Admin</h6>
                    </div>

                    <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal">
                    Tambah Admin
                </button>
                <br>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email Admin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $ambilsemuadataadmin = mysqli_query($conn, "SELECT * FROM login");
                            $i = 1;
                            while ($data = mysqli_fetch_array($ambilsemuadataadmin)) {
                                $em = $data['email'];
                                $iduser = $data['iduser'];
                            ?>

                            <tr>
                                <td><?=$i++;?></td>
                                <td><?=$em;?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$iduser;?>">Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$iduser;?>">Delete</button>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="edit<?=$iduser;?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Barang</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                                <input type="email" name="emailadmin" value="<?=$em; ?>" class="form-control" placeholder="Email" required>
                                                <br>
                                                <input type="password" name="passwordbaru" class="form-control" placeholder="Password">
                                                <br>
                                                <input type="hidden" name="id" value="<?=$iduser;?>">
                                                <button type="submit" class="btn btn-dark" name="updateadmin">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="delete<?=$iduser;?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Hapus Barang</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus <?=$em;?>?
                                                <input type="hidden" name="id" value="<?=$iduser;?>">
                                                <br><br>
                                                <button type="submit" class="btn btn-danger" name="hapusadmin">Hapus</button>
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
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
        
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Admin</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <form method="post">
                        <div class="modal-body">
                            <input type="email" name="email" placeholder="Email" class="form-control" required>
                            <br>
                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                            <br>
                        </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark" name="addadmin">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <!-- End of Main Content -->



        </div>
            <!-- End of Main Content -->



                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Adam Kurniawan</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->



            </div>
            <!-- End of Content Wrapper -->



        </div>
        <!-- End of Page Wrapper -->


        
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ingin Keluar ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Tekan "Logout" dibawah jika kamu ingin keluar sesi.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-dark" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

    </body>

</html>