<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Form Tambah List Nama Barang </h1>
                        </div> 
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Input Barang Masuk
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form role="form" action="<?= site_url('/submitnamabarang') ?>" method="post">
                                                <div class="form-group">
                                                    <label>Nama Barang</label>
                                                    <input class="form-control <?= session('validation') && isset(session('validation')['namabarang']) ? (session('validation')['namabarang'] ? 'is-invalid' : '') : ''; ?>"name="namabarang" type="text" placeholder="Input Nama Barang Yang akan Di daftarkan">
                                                    <small>
                                                        <span class="text-danger"><?= session('validation') && isset(session('validation')['namabarang']) ? session('validation')['namabarang'] : ''; ?></span>
                                                    </small>  
                                                </div>
                                                <button type="submit" id="tombolsubmit"class="btn btn-success">Submit Button</button>
                                                <button type="reset" class="btn btn-danger">Reset Button</button>
                                            </form>
                                       
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                </div>
                <!-- /.container-fluid -->
</div>
<script>
    const tombol = document.querySelector('#tombolsubmit')
    tombol.addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah pengiriman form
        Swal.fire({
            title: "Konfirmasi",
            text: "Pastikan Data Sudah Benar",
            icon: "warning",
            iconColor:"red",
            allowOutsideClick: true,
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengklik OK, kirim form
                event.target.form.submit();
            }
        });
    })
</script>
<?= $this-> endSection(); ?>
