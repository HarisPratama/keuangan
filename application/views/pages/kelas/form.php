<!-- Begin Page Content -->
<div class="container-fluid">
    <div role="main" class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <span>Formulir Kelas</span>
                    </div>
                    <div class="card-body">
                        <?=
                            form_open($form_action, ['method' => 'POST']);
                        ?>
                        <?= isset($input->id) ?
                            form_hidden('id', $input->id) : '';
                        ?>
                        <div class="form-group">
                            <label for="">ID Kelas</label>
                            <!-- <input type="text" class="form-control" id="title" onkeyup="createSlug()" required autofocus> -->
                            <?= form_input('id_kelas', $input->id_kelas, ['class' => 'form-control', 'id' => 'id_kelas', 'required' => true, 'autofocus' => true]) ?>
                            <?= form_error('id_kelas'); ?>
                            <!-- <small class="form-text text-danger">Kategori harus diisi</small> -->
                        </div>
                        <div class="form-group">
                            <label for="">Rombel</label>
                            <!-- <input type="text" class="form-control" id="title" onkeyup="createSlug()" required autofocus> -->
                            <?= form_input('rombel', $input->rombel, ['class' => 'form-control', 'id' => 'rombel', 'required' => true, 'autofocus' => true]) ?>
                            <?= form_error('rombel'); ?>
                            <!-- <small class="form-text text-danger">Kategori harus diisi</small> -->
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <?= form_close(); ?>
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('kelas') ?>" class="btn btn-warning">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>