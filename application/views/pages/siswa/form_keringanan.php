<!-- Begin Page Content -->
<div class="container-fluid">
    <div role="main" class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <span><?= $input->nama ?></span>
                    </div>
                    <div class="card-body">
                        <?=
                            form_open($form_action, ['method' => 'POST']);
                        ?>
                        <?= isset($input->id) ?
                            form_hidden('id', $input->id) : '';
                        ?>
                        <?= isset($input->id_kelas) ?
                            form_hidden('id_kelas', $input->id_kelas) : '';
                        ?>
                        <?= isset($input->nama) ?
                            form_hidden('nama', $input->nama) : '';
                        ?>
                        <?= isset($input->nisn) ?
                            form_hidden('nisn', $input->nisn) : '';
                        ?>
                        <?= isset($input->id_siswa_role) ?
                            form_hidden('id_siswa_role', $input->id_siswa_role) : '';
                        ?>
                        <div class="form-group">
                            <label for="">Keringanan</label>
                            <!-- <input type="text" class="form-control" id="slug" required> -->
                            <?= form_input(['type' => 'number', 'name' => 'keringanan', 'value' => $input->keringanan, 'class' => 'form-control', 'id' => 'keringanan',]) ?>
                            <?= form_error('keringanan'); ?>
                        </div>
                        <?= isset($input->total_spp) ?
                            form_hidden('total_spp', $input->total_spp) : '';
                        ?>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <?= form_close(); ?>
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url("siswa/detail_spp/$input->nisn") ?>" class="btn btn-warning">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>