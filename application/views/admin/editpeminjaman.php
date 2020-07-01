        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <div class="row">
                <div class="col-lg-4 border bg-white mb-3 shadow">
                    <?= form_open_multipart('admin/edit3'); ?>
                    <div class="form-group">
                        <label for="">Id</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $no['id']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Uraian</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $no['deskripsi']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="">Nominal</label>
                        <select class="form-control" id="nominal" name="nominal">
                            <option value="5000000" <?= $no['nominal'] == 5000000 ? ' selected="selected"' : ''; ?>>5000000</option>
                            <option value="10000000" <?= $no['nominal'] == 10000000 ? ' selected="selected"' : ''; ?>>10000000</option>
                            <option value="15000000" <?= $no['nominal'] == 15000000 ? ' selected="selected"' : ''; ?>>15000000</option>
                            <option value="20000000" <?= $no['nominal'] == 20000000 ? ' selected="selected"' : ''; ?>>20000000</option>
                            <option value="25000000" <?= $no['nominal'] == 25000000 ? ' selected="selected"' : ''; ?>>25000000</option>
                            <option value="30000000" <?= $no['nominal'] == 30000000 ? ' selected="selected"' : ''; ?>>30000000</option>
                            <option value="35000000" <?= $no['nominal'] == 35000000 ? ' selected="selected"' : ''; ?>>35000000</option>
                            <option value="40000000" <?= $no['nominal'] == 40000000 ? ' selected="selected"' : ''; ?>>40000000</option>
                            <option value="45000000" <?= $no['nominal'] == 45000000 ? ' selected="selected"' : ''; ?>>45000000</option>
                            <option value="50000000" <?= $no['nominal'] == 50000000 ? ' selected="selected"' : ''; ?>>50000000</option>
                            <option value="55000000" <?= $no['nominal'] == 55000000 ? ' selected="selected"' : ''; ?>>55000000</option>
                            <option value="60000000" <?= $no['nominal'] == 60000000 ? ' selected="selected"' : ''; ?>>60000000</option>
                            <option value="65000000" <?= $no['nominal'] == 65000000 ? ' selected="selected"' : ''; ?>>65000000</option>
                            <option value="70000000" <?= $no['nominal'] == 70000000 ? ' selected="selected"' : ''; ?>>70000000</option>
                            <option value="75000000" <?= $no['nominal'] == 75000000 ? ' selected="selected"' : ''; ?>>75000000</option>
                            <option value="80000000" <?= $no['nominal'] == 80000000 ? ' selected="selected"' : ''; ?>>80000000</option>
                            <option value="85000000" <?= $no['nominal'] == 85000000 ? ' selected="selected"' : ''; ?>>85000000</option>
                            <option value="90000000" <?= $no['nominal'] == 90000000 ? ' selected="selected"' : ''; ?>>90000000</option>
                            <option value="95000000" <?= $no['nominal'] == 95000000 ? ' selected="selected"' : ''; ?>>95000000</option>
                            <option value="100000000" <?= $no['nominal'] == 100000000 ? ' selected="selected"' : ''; ?>>100000000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pihak</label>
                        <input type="number" class="form-control" id="pihak" name="pihak" value="<?= $no['pihak']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <select class="form-control" id="keterangan" name="keterangan">
                            <option value="Belum Lunas" <?= $no['keterangan'] == 'Belum Lunas' ? ' selected="selected"' : ''; ?>>Belum Lunas</option>
                            <option value="Lunas" <?= $no['keterangan'] == 'Lunas' ? ' selected="selected"' : ''; ?>>Lunas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control-file" id="tanggal" name="tanggal" value="<?= $no['tanggal']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('admin/peminjaman'); ?>" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->