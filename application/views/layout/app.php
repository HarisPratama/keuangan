<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <link rel="shortcut icon" href="<?= base_url('assets/img/smp.jpg'); ?>" />
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .sidebar {
            animation: colorchange 30s;
            /* animation-name followed by duration in seconds*/
            /* you could also use milliseconds (ms) or something like 2.5s */
            -webkit-animation: colorchange 30s;
            /* Chrome and Safari */
        }

        @keyframes colorchange {
            0% {
                background: rgba(255, 107, 107, 1.0);
            }

            25% {
                background: rgba(255, 159, 67, 1.0);
            }

            50% {
                background: rgba(95, 39, 205, 1.0);
            }

            75% {
                background: rgba(116, 185, 255, 1.0);
            }

            100% {
                background: rgba(232, 67, 147, 1.0);
            }
        }

        @-webkit-keyframes colorchange

        /* Safari and Chrome - necessary duplicate */
            {
            0% {
                background: rgba(255, 107, 107, 1.0);
            }

            25% {
                background: rgba(255, 159, 67, 1.0);
            }

            50% {
                background: rgba(95, 39, 205, 1.0);
            }

            75% {
                background: rgba(116, 185, 255, 1.0);
            }

            100% {
                background: rgba(232, 67, 147, 1.0);
            }
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
                <div class="sidebar-brand-text mx-3">Manajemen Keuangan</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                ADMINISTRASI SISWA
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('siswa') ?>">
                    <i class="fas fa-fw fa-file-invoice-dollar"></i>
                    <span>Administrasi</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file-invoice-dollar"></i>
                    <span>Transaksi Siswa</span>
                </a>
                <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url('spp'); ?>">
                            <i class="fas fa-fw fa-sign-in-alt"></i> SPP</a>
                        <a class="collapse-item" href="<?= base_url('ppdb'); ?>">
                            <i class="fas fa-fw fa-sign-out-alt"></i> PPDB</a>
                        <a class="collapse-item" href="<?= base_url('ujian'); ?>">
                            <i class="fas fa-fw fa-sign-out-alt"></i> Ujian</a>
                        <a class="collapse-item" href="<?= base_url('tunggakan'); ?>">
                            <i class="fas fa-fw fa-credit-card"></i> Tunggakan</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                KEUANGAN
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file-invoice-dollar"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url('admin/pemasukan'); ?>">
                            <i class="fas fa-fw fa-sign-in-alt"></i> Pemasukan</a>
                        <a class="collapse-item" href="<?= base_url('admin/pengeluaran'); ?>">
                            <i class="fas fa-fw fa-sign-out-alt"></i> Pengeluaran</a>
                        <a class="collapse-item" href="<?= base_url('admin/peminjaman'); ?>">
                            <i class="fas fa-fw fa-credit-card"></i> Peminjaman</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MENAJEMEN
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('kelas'); ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Data Kelas</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('siswa/menajemen_siswa') ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Data Siswa</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('management') ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Import Data Siswa</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                LAPORAN
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('laporan/laporanbulanan'); ?>">
                    <i class="fas fa-fw fa-print"></i>
                    <span>Cetak Rincian Laporan</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('laporan/laporanbulanan1'); ?>">
                    <i class="fas fa-fw fa-print"></i>
                    <span>Cetak Laporan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                USER
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item text-info" style="font-weight : 600; font-size : 30px">
                            SMP PGRI 30
                        </li>
                    </ul>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
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

                <!-- content -->
                <?php $this->load->view($page); ?>
                <!-- End -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2019</span>
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
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="<?= base_url('assets/') ?>js/demo/chart-area-demo.js"></script>
        <script src="<?= base_url('assets/') ?>js/demo/chart-pie-demo.js"></script>
        <script src="<?= base_url('assets/') ?>js/demo/chart-bar-demo.js"></script>
        <script src="<?= base_url('assets/') ?>js/autoNumeric.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#kelas').change(function() {
                    var id_kelas = $('#kelas').val();
                    if (id_kelas != '') {
                        $.ajax({
                            url: "<?php echo base_url(); ?>spp/fetch_siswa",
                            method: "POST",
                            data: {
                                id_kelas: id_kelas
                            },
                            success: function(data) {
                                $('#nama').html(data);
                            }
                        });
                    } else {
                        $('#nama').html('<option value="">Pilih Siswa</option>');
                    }
                });

            });
        </script>

        <script>
            new AutoNumeric('#kjp', {
                decimalPlaces: '0',
                decimalCharacter: ',',
                digitGroupSeparator: '.'
            });
            new AutoNumeric('#nominal', {
                decimalPlaces: '0',
                decimalCharacter: ',',
                digitGroupSeparator: '.'
            });
        </script>

        <script>
            new AutoNumeric('#osis', {
                decimalPlaces: '0',
                decimalCharacter: ',',
                digitGroupSeparator: '.'
            });
            new AutoNumeric('#tabungan', {
                decimalPlaces: '0',
                decimalCharacter: ',',
                digitGroupSeparator: '.'
            });
            new AutoNumeric('#sat', {
                decimalPlaces: '0',
                decimalCharacter: ',',
                digitGroupSeparator: '.'
            });
            new AutoNumeric('#koperasi', {
                decimalPlaces: '0',
                decimalCharacter: ',',
                digitGroupSeparator: '.'
            });
        </script>

        <script>
            new AutoNumeric('#pts1', {
                decimalPlaces: '0',
                decimalCharacter: ',',
                digitGroupSeparator: '.'
            });
            new AutoNumeric('#pat1', {
                decimalPlaces: '0',
                decimalCharacter: ',',
                digitGroupSeparator: '.'
            });
            new AutoNumeric('#pts2', {
                decimalPlaces: '0',
                decimalCharacter: ',',
                digitGroupSeparator: '.'
            });
            new AutoNumeric('#pat2', {
                decimalPlaces: '0',
                decimalCharacter: ',',
                digitGroupSeparator: '.'
            });
        </script>


</body>

</html>