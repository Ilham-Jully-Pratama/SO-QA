<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Informasi QA Validasi </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-red">
                    <div class="panel-heading"> Barang Akan Habis </div>
                    <div class="panel-body">
                        <p> Jumlah barang yang akan habis :</p><h2 style="color: red;"><?= $jumlahdata; ?></h2>
                        <p> Lihat lebih lanjut detail barang yang akan habis </p>
                    </div>
                    <div class="panel-footer">
                        <a type="button" class="btn btn-danger" href="<?= base_url('/baranghabis_validasi')?>" style="margin:auto;height:20%; color: white;">Lihat Detail</a>
                    </div>
                 </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading"> Barang Akan Expired  </div>
                   
                    <div class="panel-body">
                        <p> Jumlah barang yang akan ED :</p><h2 style="color: red;"><?= $jumlahdataed; ?></h2>
                        <p> Lihat lebih lanjut barang yang akan ED </p>
                    </div>
                    <div class="panel-footer">
                        <a type="button" class="btn btn-warning" href="<?= base_url('/baranged_validasi')?>" style="margin:auto;height:20%; color: white;">Lihat Detail</a>
                    </div>
                 </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?= $this-> endSection(); ?>
