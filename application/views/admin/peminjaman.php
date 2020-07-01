<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 " style="text-transform: uppercase"><?= $title; ?></h1>

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
            <a href="" class="btn btn-info mb-3 font-weight-bold" data-toggle="modal" data-target="#newUserModal">Input Peminjaman</a>
        </div>
        <div class="col-lg-4">
            <form method="get" action="<?= base_url('admin/filterpeminjaman'); ?>">
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
            <a href="<?= base_url('laporan/toexcelnow3'); ?>" class="btn btn-success"><i class="fas fa-file-excel"></i> Export Excel</a>
        </div>
        <div class="col-lg-3 mb-3">
            <a href="<?= base_url('laporan/topdfnow3'); ?>" class="btn btn-warning"><i class="fas fa-file-pdf"></i> Export PDF</a>
        </div>
    </div>

    <div class="row mt-3">
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
            <h6 class="m-0 font-weight-bold text-primary">Data Tabel Peminjaman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
                            <th>Pihak</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="bg-secondary text-white" colspan="4">Total</th>
                            <th colspan="3" class="text-center text-white bg-success">Rp.<?= number_format($total, 0, ',', '.'); ?> </th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($transaksi as $t) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $t['deskripsi']; ?></td>
                                <td>Rp. <?= number_format($t['nominal'], 0, ',', '.'); ?></td>
                                <td><?= $t['pihak']; ?></td>
                                <td><span class="badge badge-success" style="font-size: 20px"><?= $t['keterangan']; ?></span></td>
                                <td><?= date('d F Y', strtotime(str_replace('/', '-', $t['tanggal']))); ?></td>
                                <td>
                                    <a href="<?= base_url('admin/editdebt/') . $t['id']; ?>" class="badge badge-primary">Edit</a>
                                    <a href="<?= base_url('admin/delPeminjaman/') . $t['id']; ?>" class="badge badge-danger" onclick="myFunction()">Delete</a>
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
                    <h5 class="modal-title" id="newUserModalLabel">Input Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?= form_open_multipart('admin/inputpeminjaman'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="">Nominal</label>
                        <select class="form-control" id="nominal" name="nominal">
                            <option>5000000</option>
                            <option>10000000</option>
                            <option>15000000</option>
                            <option>20000000</option>
                            <option>25000000</option>
                            <option>30000000</option>
                            <option>35000000</option>
                            <option>40000000</option>
                            <option>45000000</option>
                            <option>50000000</option>
                            <option>55000000</option>
                            <option>60000000</option>
                            <option>65000000</option>
                            <option>70000000</option>
                            <option>75000000</option>
                            <option>80000000</option>
                            <option>85000000</option>
                            <option>90000000</option>
                            <option>95000000</option>
                            <option>100000000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pihak</label>
                        <input type="text" class="form-control" id="pihak" name="pihak" placeholder="Pihak">
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <select class="form-control" id="keterangan" name="keterangan">
                            <option>Belum Lunas</option>
                            <option>Lunas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
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
        alert("Yakin hapus data?");
    }
</script>