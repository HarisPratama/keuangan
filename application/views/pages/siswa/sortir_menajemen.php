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
                                <a class="dropdown-item" href="<?= base_url("siswa/sortir_menajemen/$kelas->rombel") ?>"><?= $kelas->rombel ?></a>
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
                <div class="col-md-4">
                    <a href="<?= base_url('siswa/create') ?>" class="btn btn-md btn-primary"><i class="fas fa-plus"></i> Tambah</a>
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
                            <th>Keringanan</th>
                            <th>Total SPP</th>
                            <th>Aksi</th>
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
                                <td><?= $row->keringanan ?></td>
                                <td><?= $row->total_spp ?></td>
                                <td>
                                    <?= form_open(base_url("/siswa/delete/$row->siswa_id"), ['method' => 'POST']) ?>
                                    <?= form_hidden('id', $row->siswa_id) ?>
                                    <a href="<?= base_url("/siswa/edit/$row->siswa_id") ?>" class="btn btn-sm">
                                        <i class="fas fa-edit text-info"></i>
                                    </a>
                                    <button class="btn btn-sm" type="submit" onclick="return confirm('Are you sure ?')">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                    <?= form_close() ?>
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