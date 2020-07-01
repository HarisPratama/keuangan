<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-4">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sumber Dana</th>
                            <?php if ($content->role == 'Prioritas') : ?>
                                <th>Keringanan</th>
                            <?php endif; ?>
                            <th>Januari</th>
                            <th>Februari</th>
                            <th>Maret</th>
                            <th>April</th>
                            <th>Mei</th>
                            <th>Juni</th>
                            <th>Juli</th>
                            <th>Agustus</th>
                            <th>September</th>
                            <th>Oktober</th>
                            <th>November</th>
                            <th>Desember</th>
                            <th>SPP Wajib</th>
                            <th>Total SPP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-light">
                            <td>Dana SendirI</td>
                            <?php if ($content->role == 'Prioritas') : ?>
                                <td> Rp. <?= number_format($content->keringanan, 0, ',', '.') ?></td>
                            <?php endif; ?>
                            <td> Rp. <?= number_format($spp_sendiri->januari, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($spp_sendiri->februari, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($spp_sendiri->maret, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($spp_sendiri->april, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($spp_sendiri->mei, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($spp_sendiri->juni, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($spp_sendiri->juli, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($spp_sendiri->agustus, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($spp_sendiri->september, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($spp_sendiri->oktober, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($spp_sendiri->november, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($spp_sendiri->desember, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($content->total_spp - $content->keringanan - $total_spp->total, 0, ',', '.') ?></td>
                            <td> Rp. <?= number_format($content->total_spp - $total_spp->total, 0, ',', '.') ?></td>
                        </tr>
                        <?php if ($content->role == 'KJP') : ?>
                            <tr class="bg-success text-white">
                                <td>Dana KJP</td>
                                <?php if ($content->role == 'Prioritas') : ?>
                                    <td></td>
                                <?php endif; ?>
                                <td> Rp. <?= number_format($spp_kjp->januari, 0, ',', '.') ?></td>
                                <td> Rp. <?= number_format($spp_kjp->februari, 0, ',', '.') ?></td>
                                <td> Rp. <?= number_format($spp_kjp->maret, 0, ',', '.') ?></td>
                                <td> Rp. <?= number_format($spp_kjp->april, 0, ',', '.') ?></td>
                                <td> Rp. <?= number_format($spp_kjp->mei, 0, ',', '.') ?></td>
                                <td> Rp. <?= number_format($spp_kjp->juni, 0, ',', '.') ?></td>
                                <td> Rp. <?= number_format($spp_kjp->juli, 0, ',', '.') ?></td>
                                <td> Rp. <?= number_format($spp_kjp->agustus, 0, ',', '.') ?></td>
                                <td> Rp. <?= number_format($spp_kjp->september, 0, ',', '.') ?></td>
                                <td> Rp. <?= number_format($spp_kjp->oktober, 0, ',', '.') ?></td>
                                <td> Rp. <?= number_format($spp_kjp->november, 0, ',', '.') ?></td>
                                <td> Rp. <?= number_format($spp_kjp->desember, 0, ',', '.') ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>