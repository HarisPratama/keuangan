<!-- Begin Page Content -->
<div class="container-fluid">
    <div role="main" class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <span>Formulir</span>
                    </div>
                    <div class="card-body">
                        <?=
                            form_open($form_action, ['method' => 'POST']);
                        ?>
                        <?= isset($input->id) ?
                            form_hidden('id', $input->id) : '';
                        ?>
                        <div class="form-group">
                            <label for="">Rombel</label>
                            <?= form_dropdown('id_kelas', getDropDownList('kelas', ['id', 'rombel']), $input->id_kelas, ['class' => 'form-control', 'id' => 'kelas']) ?>
                            <?= form_error('id_kelas') ?>
                        </div>
                        <label for="">Nama</label>
                        <div class="form-group">
                            <select name="nisn_siswa" id="nama" class="form-control">
                                <option value="">Pilih Nama</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">PTS 1</label>
                            <?= form_input(['type' => 'text', 'name' => 'pts1', 'value' => $input->pts1, 'class' => 'form-control', 'id' => 'pts1']) ?>
                            <?= form_error('pts1') ?>
                        </div>
                        <div class="form-group">
                            <label for="">PAT 1</label>
                            <?= form_input(['type' => 'text', 'name' => 'pat1', 'value' => $input->pat1, 'class' => 'form-control', 'id' => 'pat1']) ?>
                            <?= form_error('pat1'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">PTS 2</label>
                            <?= form_input(['type' => 'text', 'name' => 'pts2', 'value' => $input->pts2, 'class' => 'form-control', 'id' => 'pts2']) ?>
                            <?= form_error('pts2'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">PAT 2</label>
                            <?= form_input(['type' => 'text', 'name' => 'pat2', 'value' => $input->pat2, 'class' => 'form-control', 'id' => 'pat2']) ?>
                            <?= form_error('pat2'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <?= form_input('keterangan', $input->keterangan, ['class' => 'form-control', 'id' => 'keterangan']) ?>
                            <?= form_error('keterangan'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $input->tanggal ?>" required>
                            <?= form_error('tanggal'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>