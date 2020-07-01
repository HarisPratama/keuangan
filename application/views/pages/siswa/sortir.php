<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $this->load->view('/layout/_alert'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="dropdown">
                        <a class="btn btn-success btn-md dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pilih Kelas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <?php foreach (getKelas() as $kelas) : ?>
                                <a class="dropdown-item" href="<?= base_url("siswa/sortir/$kelas->rombel") ?>"><?= $kelas->rombel ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <form action="<?= base_url('siswa/search') ?>" method="POST">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control form-control-sm text-center" placeholder="Cari" value="<?= $this->session->userdata('keyword'); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-secondary btn-sm" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="<?= base_url('siswa/reset') ?>" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-eraser"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Rombel</th>
                            <th>Role</th>
                            <th>SPP</th>
                            <th>PPDB</th>
                            <th>Ujian</th>
                            <th>Tunggakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($content as $row) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row->nama ?></td>
                                <td><?= $row->nisn ?></td>
                                <td><?= $row->rombel ?></td>
                                <td><?= $row->role ?></td>
                                <td>
                                    <a href="<?= base_url("/siswa/detail_spp/$row->nisn") ?>" class="btn btn-sm">
                                        <span class="badge badge-primary">Detail</span>
                                        <i class="fas fa-edit text-info"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url("/siswa/detail_ppdb/$row->nisn") ?>" class="btn btn-sm">
                                        <span class="badge badge-success">Detail</span>
                                        <i class="fas fa-edit text-info"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url("/siswa/detail_ujian/$row->nisn") ?>" class="btn btn-sm">
                                        <span class="badge badge-warning">Detail</span>
                                        <i class="fas fa-edit text-info"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url("/siswa/detail_ujian/$row->nisn") ?>" class="btn btn-sm">
                                        <span class="badge badge-danger">Detail</span>
                                        <i class="fas fa-edit text-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <?= $pagination ?>
                </nav>
            </div>
        </div>
    </div>
</div>
</div>