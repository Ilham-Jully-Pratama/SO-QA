<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Form Barang Masuk Validasi </h1>
                        </div> 
                        <!-- /.col-lg-12 -->
                    </div>
                    <div id="flash2" data-flash="<?= esc(session()->getFlashdata('pesan')); ?>">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Input Barang Masuk Validasi
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <?php foreach ($masuk as $dd) : ?>
                                            <form role="form" method="post" action="<?= base_url('/submit_barang_masuk_validasi')?>">
                                                <div class="form-group">
                                                    <label>Kode Barang</label>
                                                    <input class="form-control" name="kodebarang" value="<?= $dd['kodebarang']; ?>" readonly>
                                                    <p class="help-block">Masukan Kode barang </p>
                                                </div>
                                                    
                                                <div class="form-group">
                                                    <label> Nama Barang </label>
                                                    <input class="form-control" name="namabarang" value="<?= $dd['namabarang']; ?>" readonly>
                                                    <p class="help-block">Masukan Nama barang </p>
                                                </div>
                                                <div class="form-group">
                                                    <label> Merek </label>
                                                    <input class="form-control" name="merek" value="<?= $dd['merek']; ?>" readonly>
                                                    <p class="help-block">Masukan Nama barang </p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Satuan</label>
                                                    <input class="form-control" name="satuan" value="<?= $dd['satuan']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jumlah</label>
                                                    <input class="form-control <?= session('validation') && isset(session('validation')['jumlahbarang']) ? (session('validation')['jumlahbarang'] ? 'is-invalid' : '') : ''; ?>" name="jumlahbarang" type="number">
                                                    <p class="help-block">Jumlah Saat ini : <?= $dd['jumlah']; ?> </p>
                                                    <small>
                                                        <span class="text-danger"><?= session('validation') && isset(session('validation')['jumlahbarang']) ? session('validation')['jumlahbarang'] : ''; ?></span>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Input</label>
                                                    <input class="form-control  <?= session('validation') && isset(session('validation')['tanggal']) ? (session('validation')['tanggal'] ? 'is-invalid' : '') : ''; ?>" type="date"name="tanggal">
                                                    <p class="help-block">Tanggal Input Barang keluar</p>
                                                    <small>
                                                        <span class="text-danger"><?= session('validation') && isset(session('validation')['tanggal']) ? session('validation')['tanggal'] : ''; ?></span>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Expired</label>
                                                    <input class="form-control" type="date"name="expired" value="<?= $dd['expired']; ?>" readonly>
                                                    <p class="help-block">Expired</p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Keterangan </label>
                                                    <input class="form-control  <?= session('validation') && isset(session('validation')['keterangan']) ? (session('validation')['keterangan'] ? 'is-invalid' : '') : ''; ?>" type="text"name="keterangan">
                                                    <p class="help-block">Keterangan</p>
                                                    <small>
                                                        <span class="text-danger"><?= session('validation') && isset(session('validation')['keterangan']) ? session('validation')['keterangan'] : ''; ?></span>
                                                    </small>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input class="form-control"name="nama" value="<?=user()-> username; ?>" readonly>
                                                    <p class="help-block">Nama PIC</p>
                                                </div>
                                                <button type="submit" id="tombolsubmit"class="btn btn-success">Submit Button</button>
                                                <button type="reset" class="btn btn-danger">Reset Button</button>
                                            </form>
                                        <?php endforeach; ?> 
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
