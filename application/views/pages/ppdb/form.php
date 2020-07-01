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
                            <label for="">OSIS</label>
                            <?= form_input(['type' => 'text', 'name' => 'osis', 'value' => $input->osis, 'class' => 'form-control', 'id' => 'osis']) ?>
                            <?= form_error('osis') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tabungan</label>
                            <?= form_input(['type' => 'text', 'name' => 'tabungan', 'value' => $input->tabungan, 'class' => 'form-control', 'id' => 'tabungan']) ?>
                            <?= form_error('tabungan'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">SAT</label>
                            <?= form_input(['type' => 'text', 'name' => 'sat', 'value' => $input->sat, 'class' => 'form-control', 'id' => 'sat']) ?>
                            <?= form_error('sat'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Koperasi</label>
                            <?= form_input(['type' => 'text', 'name' => 'koperasi', 'value' => $input->koperasi, 'class' => 'form-control', 'id' => 'koperasi']) ?>
                            <?= form_error('koperasi'); ?>
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