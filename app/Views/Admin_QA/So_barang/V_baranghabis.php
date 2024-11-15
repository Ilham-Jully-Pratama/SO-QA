<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Barang & Reagen QA yang Habis</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
       
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Data Monitoring Stock
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <div class="table-responsive">
                            <h3 class="text-center">Barang Akan Habis</h3>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th class="text-center">Kodebarang</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Jumlah</th>
                                                                       
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($itemcount)): ?>    
                                    <?php foreach ($itemcount as $dd) : ?>
                                        <tr class="odd gradeX">
                                            <td><?= $dd['kodebarang']; ?></td>
                                            <td><?= $dd['namabarang']; ?></td>
                                            <td><?= $dd['satuan']; ?></td>
                                            <td><?= $dd['jumlah']; ?></td>                                                                                       
                                        </tr>
                                    <?php endforeach; ?>  
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data yang akan habis</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<script>
    // Ambil semua tombol hapus
    const tombolHapus = document.querySelectorAll('#tombolhapusdata');
    tombolHapus.forEach(tombol => {
        tombol.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah pengiriman form
            Swal.fire({
                title: "Konfirmasi",
                text: "Yakin Akan Hapus Data ini",
                icon: "info",
               
                iconColor:"red",
                allowOutsideClick: true,
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengklik OK, kirim form
                    event.target.form.submit();
                }
            });
        });
    });
</script>


<!-- /#page-wrapper -->

<?= $this-> endSection(); ?>
