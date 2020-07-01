<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" style="text-transform: uppercase"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-2">
            <a href="" class="btn btn-info mb-3 font-weight-bold" data-toggle="modal" data-target="#newUserModal">Input Pemasukan</a>
        </div>
        <div class="col-lg-4">
            <form method="get" action="<?= base_url('admin/filter'); ?>">
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
        <div class="col-lg-3 mb-3">
            <a href="<?= base_url('laporan/toexcelnow'); ?>" class="btn btn-success"><i class="fas fa-file-excel"></i> Export Excel</a>
        </div>
        <div class="col-lg-3 mb-3">
            <a href="<?= base_url('laporan/topdfnow'); ?>" class="btn btn-warning"><i class="fas fa-file-pdf"></i> Export PDF</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
        </div>
        <div class="col-lg">
            <?= $this->session->flashdata('notif'); ?>
        </div>
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Data Tabel Pemasukan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Deskripsi</th>
                            <th>Uang Sekolah</th>
                            <th>BOS</th>
                            <th>Lain-lain</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="bg-secondary text-white" colspan="2">Total</th>
                            <th class="bg-secondary text-white">Rp. <?= number_format($total_nominal, 0, ',', '.'); ?></th>
                            <th class="bg-secondary text-white">Rp. <?= number_format($total_bos, 0, ',', '.'); ?></th>
                            <th class="bg-secondary text-white">Rp. <?= number_format($total_lain, 0, ',', '.'); ?></th>
                            <?php $total = $total_nominal + $total_bos + $total_lain; ?>
                            <th colspan="4" class="text-center text-white bg-success">Rp. <?= number_format($total, 0, ',', '.'); ?></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($transaksi as $t) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $t['deskripsi']; ?></td>
                                <td>Rp. <?= number_format($t['nominal'], 0, ',', '.'); ?></td>
                                <td>Rp. <?= number_format($t['bos'], 0, ',', '.'); ?></td>
                                <td>Rp. <?= number_format($t['lain'], 0, ',', '.'); ?></td>
                                <?php $jumlah = $t['nominal'] + $t['bos'] + $t['lain'] ?>
                                <td class="bg-info text-white">Rp. <strong><?= number_format($jumlah, 0, ',', '.'); ?></strong></td>
                                <td><?= $t['keterangan']; ?></td>
                                <td><?= date('d F Y', strtotime(str_replace('/', '-', $t['tanggal']))); ?></td>
                                <td>
                                    <a href="<?= base_url('admin/editpemasukan/') . $t['id']; ?>" class="badge badge-primary">Edit</a>
                                    <a href="<?= base_url('admin/delPemasukan/') . $t['id']; ?>" class="badge badge-danger" onclick="myFunction()">Delete</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer py-3">
            <h5 class="m-0 font-weight-bold text-info">Sisa Saldo : Rp. <?= number_format($saldo, 0, ',', '.'); ?></h5>
        </div>
    </div>



    <!-- Modal input -->
    <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newUserModalLabel">Input Pemasukan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?= form_open_multipart('admin/inputpemasukan'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold" for="">Pilih Deskripsi</label>
                        <select class="form-control" id="deskripsi" name="deskripsi">
                            <option>SPP</option>
                            <option>Sarpras</option>
                            <option>Tunggakan</option>
                            <option>OSIS</option>
                            <option>SAT</option>
                            <option>Semesteran</option>
                            <option>Ujian Nasional</option>
                            <option>Lain-lain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="">Uang Sekolah</label>
                        <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Nominal" value="0">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="">BOS</label>
                        <input type="number" class="form-control" id="bos" name="bos" placeholder="BOS" value="0">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="">Lain-lain</label>
                        <input type="number" class="form-control" id="lain" name="lain" placeholder="Lain-lain" value="0">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="">Tanggal</label>
                        <input type="date" class="form-control-file" id="tanggal" name="tanggal" value="<?php echo date("Y-m-d"); ?>" min="2018-01-01" max="2022-12-31">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    function myFunction() {
        alert('Yakin hapus data ?');
    }
</script>