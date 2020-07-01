        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


            <?= form_open_multipart('admin/edit'); ?>
            <div class="form-group">
                <label for="">Id</label>
                <input type="text" class="form-control" id="id" name="id" value="<?= $no['id']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $no['deskripsi']; ?>">
            </div>
            <div class="form-group">
                <label for="">Uang Sekolah</label>
                <input type="number" class="form-control" id="nominal" name="nominal" value="<?= $no['nominal']; ?>">
            </div>
            <div class="form-group">
                <label for="">BOS</label>
                <input type="number" class="form-control" id="bos" name="bos" value="<?= $no['bos']; ?>">
            </div>
            <div class="form-group">
                <label for="">Lain-lain</label>
                <input type="number" class="form-control" id="lain" name="lain" value="<?= $no['lain']; ?>">
            </div>
            <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control-file" id="tanggal" name="tanggal" value="<?= $no['tanggal']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('admin/pemasukan'); ?>" class="btn btn-danger">Cancel</a>
            </form>

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->