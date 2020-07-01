<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-4">
                    <?= $content->nama;  ?>
                </div>
                <?php if ($content->role == 'Prioritas') : ?>
                    <div class="col-md-4">
                        <a href="<?= base_url("/siswa/editkeringanan/$content->nisn") ?>" class="btn btn-info mb-3 font-weight-bold" data-toggle="modal" data-target="#newUserModal">Input Keringanan</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>OSIS</th>
                            <th>Tabungan</th>
                            <th>SAT</th>
                            <th>Koperasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-light">
                            <td> Rp. <?= number_format($total_osis, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($total_tabungan, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($total_sat, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($total_koperasi, 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal input -->
    <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newUserModalLabel">Input Keringanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?= form_open('siswa/inputkeringanan'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">NISN</label>
                        <!-- <input type="text" class="form-control" id="slug" required> -->
                        <?= form_input(['type' => 'number', 'name' => 'keringanan', 'class' => 'form-control', 'value' => $content->nisn, 'id' => 'keringanan', 'readonly' => true]) ?>
                        <?= form_error('keringanan'); ?>
                    </div>
                    <div class="form-group">
                        <label for="">Keringanan</label>
                        <!-- <input type="text" class="form-control" id="slug" required> -->
                        <?= form_input(['type' => 'number', 'name' => 'keringanan', 'class' => 'form-control', 'id' => 'keringanan', 'required' => true]) ?>
                        <?= form_error('keringanan'); ?>
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
</div>