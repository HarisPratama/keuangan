   <!-- Begin Page Content -->
   <div class="container-fluid">

       <!-- Page Heading -->
       <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

       <div class="row">
           <div class="row">
               <div class="col-lg">
                   <form method="get" action="<?= base_url('laporan/topdfMonth'); ?>">
                       <div class="form-group row">
                           <div class="col-lg-4 mb-3 mb-sm-0">
                               <input type="date" class="form-control" id="startdate" name="startdate" value="">
                           </div>
                           <div class="col-lg-4 mb-3 mb-sm-0">
                               <input type="date" class="form-control" id="enddate" name="enddate" value="">
                           </div>
                           <div class="col-lg-4">
                               <button type="submit" class="btn btn-danger" target="_blank">Cetak Laporan</button>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>

   </div>
   <!-- /.container-fluid -->

   </div>
   <!-- End of Main Content -->