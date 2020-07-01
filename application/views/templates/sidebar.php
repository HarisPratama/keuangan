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
         MANAJEMEN
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