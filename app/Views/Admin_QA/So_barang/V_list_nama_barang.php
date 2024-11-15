<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Daftar Nama Barang </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Nama Barang
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="flash2" data-flash="<?= esc(session()->getFlashdata('alert')); ?>"></div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                       
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Delete</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($barang as $dd) : ?>
                                    <tr class="odd gradeX">
                                        <td class="text-center"><?= $dd['namabarang']; ?></td>    
                                        <td class="text-center">
                                        <form action="<?= site_url('/deletedaftarnamabarang_adminqa'.$dd['id']) ?>" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" id="tombolhapusdata" class="btn btn-danger "style="margin:auto;height:20%"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?> 
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
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            "searching": true,
            "paging": true,
            "lengthChange": true
        });
    });
</script>
<!-- /#page-wrapper -->

<?= $this-> endSection(); ?>
