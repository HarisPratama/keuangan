<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" style="text-transform: uppercase"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <a href="" class="btn btn-info text-light mb-3 font-weight-bold" data-toggle="modal" data-target="#newUserModal">Input Pengeluaran</a>
        </div>
        <div class="col-lg-4">
            <form method="get" action="<?= base_url('admin/filterpengeluaran'); ?>">
                <div class="form-group row">
                    <div class="col-sm-5 mb-3 mb-sm-0">
                        <input type="date" class="form-control" id="startdate" name="startdate" value="">
                    </div>
                    <div class="col-sm-5 mb-3 mb-sm-0">
                        <input type="date" class="form-control" id="enddate" name="enddate" value="">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 mb-3">
            <a href="<?= base_url('laporan/toexcelnow2'); ?>" class="btn btn-success"><i class="fas fa-file-excel"></i> Export Excel</a>
        </div>
        <div class="col-lg-3 mb-3">
            <a href="<?= base_url('laporan/topdfnow2'); ?>" class="btn btn-warning"><i class="fas fa-file-pdf"></i> Export PDF</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
        </div>
        <div class="col-lg">
            <?= $this->session->flashdata('notif'); ?>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Data Tabel Pengeluaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Deskripsi</th>
                            <th>BOS</th>
                            <th>BRS</th>
                            <th>Lain-lain</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="bg-secondary text-white" colspan="2">Total</th>
                            <th class="bg-secondary text-white">Rp. <?= number_format($total_bos, 0, ',', '.'); ?></th>
                            <th class="bg-secondary text-white">Rp. <?= number_format($total_brs, 0, ',', '.'); ?></th>
                            <th class="bg-secondary text-white">Rp. <?= number_format($total_lain, 0, ',', '.'); ?></th>
                            <?php $total = $total_bos + $total_brs + $total_lain; ?>
                            <th colspan="5" class="text-center text-white bg-success">Rp. <?= number_format($total, 0, ',', '.'); ?></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($transaksi as $t) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $t['deskripsi']; ?></td>
                                <td>Rp. <?= number_format($t['bos'], 0, ',', '.'); ?></td>
                                <td>Rp. <?= number_format($t['brs'], 0, ',', '.'); ?></td>
                                <td>Rp. <?= number_format($t['lain'], 0, ',', '.'); ?></td>
                                <td><?= $t['kategori']; ?></td>
                                <?php $jumlah = $t['bos'] + $t['brs'] + $t['lain'] ?>
                                <td class="bg-info text-white">Rp. <strong><?= number_format($jumlah, 0, ',', '.'); ?></strong></td>
                                <td><?= $t['keterangan']; ?></td>
                                <td><?= date('d F Y', strtotime(str_replace('/', '-', $t['tanggal']))); ?></td>
                                <td>
                                    <a href="<?= base_url('admin/editpengeluaran/') . $t['id']; ?>" class="badge badge-primary">Edit</a>
                                    <a href="<?= base_url('admin/delPengeluaran/') . $t['id']; ?>" class="badge badge-danger" onclick="myFunction()">Delete</a>
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
                    <h5 class="modal-title" id="newUserModalLabel">Masukan Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?= form_open_multipart('admin/inputpengeluaran'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <h5 class="text-success font-weight-bold">SALDO : Rp. <?= number_format($saldo, 0, ',', '.'); ?></h5>
                    </div>
                    <hr class="divider">
                    <div class="form-group">
                        <label class="font-weight-bold" for="">Masukan Deskripsi Pengeluaran</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukan Deskripsi">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="">BOS</label>
                        <input type="number" class="form-control" id="bos" name="bos" placeholder="Nominal" value="0" max="<?= $saldo; ?>">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="">BRS</label>
                        <input type="number" class="form-control" id="brs" name="brs" placeholder="BOS" value="0" max="<?= $saldo; ?>">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="">Lain-lain</label>
                        <input type="number" class="form-control" id="lain" name="lain" placeholder="Lain-lain" value="0" max="<?= $saldo; ?>">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="">Pilih Kategori</label>
                        <select class="form-control" id="kategori" name="kategori">
                            <option>Sarpras</option>
                            <option>Belanja Harian</option>
                            <option>TAL</option>
                            <option>Gaji</option>
                            <option>Air</option>
                            <option>Insentif Pengawas</option>
                            <option>Iuran RT</option>
                            <option>OSIS</option>
                            <option>Iuran Sampah</option>
                            <option>Bulanan</option>
                            <option>Pengelolaan Website</option>
                            <option>Service AC dan lainnya</option>
                            <option>ATK</option>
                            <option>Lain - lain</option>
                        </select>
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
        alert('Yakin hapus data?');
    }
</script>