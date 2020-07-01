<!-- Begin Page Content -->
<div class="container-fluid">
    <div role="main" class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <span>Formulir Siswa</span>
                    </div>
                    <div class="card-body">
                        <?=
                            form_open($form_action, ['method' => 'POST']);
                        ?>
                        <?= isset($input->id) ?
                            form_hidden('id', $input->id) : '';
                        ?>
                        <div class="form-group">
                            <label for="">Siswa</label>
                            <!-- <input type="text" class="form-control" id="title" onkeyup="createSlug()" required autofocus> -->
                            <?= form_input('nama', $input->nama, ['class' => 'form-control', 'id' => 'nama', 'onkeyup' => 'createSlug()', 'required' => true, 'autofocus' => true]) ?>
                            <?= form_error('nama'); ?>
                            <!-- <small class="form-text text-danger">Kategori harus diisi</small> -->
                        </div>
                        <div class="form-group">
                            <label for="">NISN</label>
                            <!-- <input type="text" class="form-control" id="title" onkeyup="createSlug()" required autofocus> -->
                            <?= form_input('nisn', $input->nisn, ['class' => 'form-control', 'id' => 'nisn', 'onkeyup' => 'createSlug()', 'required' => true, 'autofocus' => true]) ?>
                            <?= form_error('nisn'); ?>
                            <!-- <small class="form-text text-danger">Kategori harus diisi</small> -->
                        </div>
                        <div class="form-group">
                            <label for="">Rombel</label>
                            <?= form_dropdown('id_kelas', getDropDownList('kelas', ['id', 'rombel']), $input->id_kelas, ['class' => 'form-control']) ?>
                            <?= form_error('id_kelas') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <?= form_dropdown('id_siswa_role', getDropDownList('siswa_role', ['id', 'role']), $input->id_siswa_role, ['class' => 'form-control']) ?>
                            <?= form_error('id_siswa_role') ?>
                        </div>
                        <?php if ($input->id_siswa_role == 3) : ?>
                            <div class="form-group">
                                <label for="">Keringanan</label>
                                <!-- <input type="text" class="form-control" id="slug" required> -->
                                <?= form_input(['type' => 'number', 'name' => 'keringanan', 'value' => $input->keringanan, 'class' => 'form-control', 'id' => 'keringanan',]) ?>
                                <?= form_error('keringanan'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="">Total SPP</label>
                            <!-- <input type="text" class="form-control" id="slug" required> -->
                            <?= form_input(['type' => 'number', 'name' => 'total_spp', 'value' => $input->total_spp, 'class' => 'form-control', 'id' => 'total_spp', 'required' => true]) ?>
                            <?= form_error('total_spp'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <?= form_close(); ?>
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('siswa/menajemen_siswa') ?>" class="btn btn-warning">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>