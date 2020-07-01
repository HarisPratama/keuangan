        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


            <?= form_open_multipart('admin/edit2'); ?>
            <div class="form-group">
                <label for="">Id</label>
                <input type="text" class="form-control" id="id" name="id" value="<?= $no['id']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $no['deskripsi']; ?>">
            </div>
            <div class="form-group">
                <label for="">BOS</label>
                <input type="number" class="form-control" id="bos" name="bos" value="<?= $no['bos']; ?>">
            </div>
            <div class="form-group">
                <label for="">BRS</label>
                <input type="number" class="form-control" id="brs" name="brs" value="<?= $no['brs']; ?>">
            </div>
            <div class="form-group">
                <label for="">Lain-lain</label>
                <input type="number" class="form-control" id="lain" name="lain" value="<?= $no['lain']; ?>">
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="">Pilih Kategori</label>
                <select class="form-control" id="kategori" name="kategori">
                    <option value="Sarpras" <?= $no['kategori'] == 'Sarpras' ? ' selected="selected"' : ''; ?>>Sarpras</option>
                    <option value="Belanja Harian" <?= $no['kategori'] == 'Belanja Harian' ? ' selected="selected"' : ''; ?>>Belanja Harian</option>
                    <option value="TAL" <?= $no['kategori'] == 'TAL' ? ' selected="selected"' : ''; ?>>TAL</option>
                    <option value="Gaji" <?= $no['kategori'] == 'Gaji' ? ' selected="selected"' : ''; ?>>Gaji</option>
                    <option value="Air" <?= $no['kategori'] == 'Air' ? ' selected="selected"' : ''; ?>>Air</option>
                    <option value="Insentif Pengawas" <?= $no['kategori'] == 'Insentif Pengawas' ? ' selected="selected"' : ''; ?>>Insentif Pengawas</option>
                    <option value="Iuran RT" <?= $no['kategori'] == 'Iuran RT' ? ' selected="selected"' : ''; ?>>Iuran RT</option>
                    <option value="OSIS" <?= $no['kategori'] == 'OSIS' ? ' selected="selected"' : ''; ?>>OSIS</option>
                    <option value="Iuran Sampah" <?= $no['kategori'] == 'Iuran Sampah' ? ' selected="selected"' : ''; ?>>Iuran Sampah</option>
                    <option value="Bulanan" <?= $no['kategori'] == 'Bulanan' ? ' selected="selected"' : ''; ?>>Bulanan</option>
                    <option value="Pengelolaan Website" <?= $no['kategori'] == 'Pengelolaan Website' ? ' selected="selected"' : ''; ?>>Pengelolaan Website</option>
                    <option value="Service AC dan lainnya" <?= $no['kategori'] == 'Service AC dan lainnya' ? ' selected="selected"' : ''; ?>>Service AC dan lainnya</option>
                    <option value="ATK" <?= $no['kategori'] == 'ATK' ? ' selected="selected"' : ''; ?>>ATK</option>
                    <option value="Lain-lain" <?= $no['kategori'] == 'Lain-lain' ? ' selected="selected"' : ''; ?>>Lain-lain</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control-file" id="tanggal" name="tanggal" value="<?= $no['tanggal']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('admin/pengeluaran'); ?>" class="btn btn-danger">Cancel</a>
            </form>

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->