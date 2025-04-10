<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<div id="page-wrapper">
<div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Form Ubah Barang Admin QA </h1>
                        </div> 
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Ubah Data Barang Admin QA
                                </div>
                                <div class="panel-body">
                                <div id="flash2" data-flash="<?= esc(session()->getFlashdata('pesan')); ?>">
                                    <div class="row"> 
                                        <div class="col-lg-6"> 
                                                <?php foreach ($masuk as $dd) : ?>
                                                    <form role="form" action="<?= site_url('/submit_ubahbarang_adminqa'.$dd['id']) ?>" method="post">
                                                        <div class="form-group">
                                                            <label>Kode Barang</label>
                                                            <input class="form-control <?= session('validation') && isset(session('validation')['kodebarang']) ? (session('validation')['kodebarang'] ? 'is-invalid' : '') : ''; ?>" name="kodebarang" value="<?= $dd['kodebarang']; ?>">
                                                            <p class="help-block">Masukan Kode barang </p>
                                                            <small>
                                                                <span class="text-danger"><?= session('validation') && isset(session('validation')['kodebarang']) ? session('validation')['kodebarang'] : ''; ?></span>
                                                            </small>
                                                        </div>  
                                                        <div class="form-group">
                                                            <label> Nama Barang </label>
                                                            <input class="form-control <?= session('validation') && isset(session('validation')['namabarang']) ? (session('validation')['namabarang'] ? 'is-invalid' : '') : ''; ?>" name="namabarang" value="<?= $dd['namabarang']; ?>">
                                                            <p class="help-block">Masukan Nama barang </p>
                                                            <small>
                                                                <span class="text-danger"><?= session('validation') && isset(session('validation')['namabarang']) ? session('validation')['namabarang'] : ''; ?></span>
                                                            </small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Satuan</label>
                                                            <input class="form-control <?= session('validation') && isset(session('validation')['satuan']) ? (session('validation')['satuan'] ? 'is-invalid' : '') : ''; ?>" name="satuan" value="<?= $dd['satuan']; ?>">
                                                            <small>
                                                                <span class="text-danger"><?= session('validation') && isset(session('validation')['satuan']) ? session('validation')['satuan'] : ''; ?></span>
                                                            </small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jumlah</label>
                                                            <input class="form-control <?= session('validation') && isset(session('validation')['jumlahbarang']) ? (session('validation')['jumlahbarang'] ? 'is-invalid' : '') : ''; ?>"name="jumlahbarang" type="number"value="<?= $dd['jumlah']; ?>">
                                                            <p class="help-block">Jumlah barang </p>
                                                            <small>
                                                                <span class="text-danger"><?= session('validation') && isset(session('validation')['jumlahbarang']) ? session('validation')['jumlahbarang'] : ''; ?></span>
                                                            </small>
                                                        </div>                                            
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input class="form-control"name="nama" value="<?=user()-> username; ?>" readonly>
                                                            <p class="help-block">Nama PIC</p>
                                                        </div>
                                                    <button type="submit" id="tombolsubmit"class="btn btn-success">Submit Button</button>
                                                    <button type="reset" class="btn btn-danger">Reset Button</button>
                                                    <button type="button" class="btn btn-warning" onclick="window.location.href='<?= site_url('/databarangadminqa'); ?>';">Kembali</button>
                                                </form>
                                                <?php endforeach; ?> 
                                            </div>
                                    </div>
                                       
                                           
                                    <!-- </div> -->
                                           
                                            
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
