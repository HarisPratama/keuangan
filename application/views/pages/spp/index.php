<!-- Begin Page Content -->
<div class="container-fluid">
    <?php $this->load->view('/layout/_alert'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-2">
                    <a href="<?= base_url('spp/create') ?>" class="btn btn-md btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                </div>
                <div class="col-md-7">
                    <form method="get" action="<?= base_url('spp/filter'); ?>">
                        <div class="form-group row">
                            <div class="col-lg-4 mb-3 mb-sm-0">
                                <input type="date" class="form-control" id="startdate" name="startdate" value="">
                            </div>
                            <div class="col-lg-4 mb-3 mb-sm-0">
                                <input type="date" class="form-control" id="enddate" name="enddate" value="">
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <form action="<?= base_url('spp/search') ?>" method="POST">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control form-control-sm text-center" placeholder="Masukan NISN" value="<?= $this->session->userdata('keyword'); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-secondary btn-sm" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="<?= base_url('spp/reset') ?>" class="btn btn-secondary btn-sm">
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
                            <th>Nominal</th>
                            <th>Bulan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($content as $row) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row->nama ?></td>
                                <td><?= $row->nisn_siswa ?></td>
                                <td><?= $row->kelas_rombel ?></td>
                                <td>Rp <?= number_format($row->nominal + $row->kjp, 0, ',', '.') ?></td>
                                <td><?= $row->bulan ?></td>
                                <td><?= date('d F Y', strtotime(str_replace('/', '-', $row->tanggal))); ?></td>
                                <td>
                                    <?= form_open(base_url("/spp/delete/$row->id"), ['method' => 'POST']) ?>
                                    <?= form_hidden('id', $row->id) ?>
                                    <a href="<?= base_url("/spp/edit/$row->id") ?>" class="btn btn-sm">
                                        <i class="fas fa-edit text-info"></i>
                                    </a>
                                    <button class="btn btn-sm" type="submit" onclick="return confirm('Are you sure ?')">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                    <a href="<?= base_url("/spp/export_pdf/$row->id") ?>" class="btn btn-sm" target="_blank">
                                        <i class="fas fa-print text-info"></i>
                                    </a>
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