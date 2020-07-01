<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-4">
                    <?= $content->nama;  ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>PTS 1</th>
                            <th>PAT 1</th>
                            <th>PTS 2</th>
                            <th>PAT 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-light">
                            <td> Rp. <?= number_format($pts1, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($pat1, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($pts2, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($pat2, 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
</div>