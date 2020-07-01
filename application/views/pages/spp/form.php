<!-- Begin Page Content -->
<div class="container-fluid">
    <div role="main" class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <span>Form Input SPP</span>
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
                        <label for="" class="font-weight-bold">Nama</label>
                        <div class="form-group">
                            <select name="nisn_siswa" id="nama" class="form-control">
                                <option value="">Pilih Nama</option>
                            </select>
                            <?= form_error('nisn_siswa') ?>
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">Dana KJP</label>
                            <?= form_input(['type' => 'text', 'name' => 'kjp', 'value' => $input->kjp, 'class' => 'form-control', 'id' => 'kjp']) ?>
                            <?= form_error('kjp') ?>
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">Dana Sendiri</label>
                            <?= form_input(['type' => 'text', 'name' => 'nominal', 'value' => $input->nominal, 'class' => 'form-control', 'id' => 'nominal']) ?>
                            <?= form_error('nominal'); ?>
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                <option>Januari</option>
                                <option>Februari</option>
                                <option>Maret</option>
                                <option>April</option>
                                <option>Mei</option>
                                <option>Juni</option>
                                <option>Juli</option>
                                <option>Agustus</option>
                                <option>September</option>
                                <option>Oktober</option>
                                <option>November</option>
                                <option>Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">Tanggal</label>
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