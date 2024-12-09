<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<div id="page-wrapper">
<div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Form Ubah Barang </h1>
                        </div> 
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Ubah Data Barang 
                                </div>
                                <div class="panel-body">
                                <div id="flash2" data-flash="<?= esc(session()->getFlashdata('pesan')); ?>">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <?php foreach ($masuk as $dd) : ?>
                                            <form role="form" action="<?= site_url('/submit_ubah_barang'.$dd['id']) ?>">
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
                                                    <label> Merek Barang </label>
                                                    <input class="form-control <?= session('validation') && isset(session('validation')['merek']) ? (session('validation')['merek'] ? 'is-invalid' : '') : ''; ?>" name="merek" value="<?= $dd['merek']; ?>">
                                                    <p class="help-block">Masukan Nama barang </p>
                                                    <small>
                                                        <span class="text-danger"><?= session('validation') && isset(session('validation')['merek']) ? session('validation')['merek'] : ''; ?></span>
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
                                                    <label>Tanggal Kedatangan</label>
                                                    <input class="form-control <?= session('validation') && isset(session('validation')['tanggal_kedatangan']) ? (session('validation')['tanggal_kedatangan'] ? 'is-invalid' : '') : ''; ?>"name="tanggal_kedatangan" type="date"value="<?= $dd['tanggal_datang']; ?>">
                                                    <p class="help-block">Jumlah barang </p>
                                                    <small>
                                                        <span class="text-danger"><?= session('validation') && isset(session('validation')['tanggal_kedatanagan']) ? session('validation')['tanggal_kedatangan'] : ''; ?></span>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Expired</label>
                                                    <input class="form-control <?= session('validation') && isset(session('validation')['expired']) ? (session('validation')['expired'] ? 'is-invalid' : '') : ''; ?>" type="date"name="expired" value="<?= $dd['expired']; ?>">
                                                    <p class="help-block">Expired barang </p>
                                                    <small>
                                                        <span class="text-danger"><?= session('validation') && isset(session('validation')['expired']) ? session('validation')['expired'] : ''; ?></span>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>COA</label>
                                                    <input class="form-control <?= session('validation') && isset(session('validation')['coa']) ? (session('validation')['coa'] ? 'is-invalid' : '') : ''; ?>"name="coa" type="text"value="<?= $dd['coa']; ?>">
                                                    <p class="help-block">Jumlah barang </p>
                                                    <small>
                                                        <span class="text-danger"><?= session('validation') && isset(session('validation')['coa']) ? session('validation')['coa'] : ''; ?></span>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>MSDS</label>
                                                    <input class="form-control <?= session('validation') && isset(session('validation')['msds']) ? (session('validation')['msds'] ? 'is-invalid' : '') : ''; ?>"name="msds" type="text"value="<?= $dd['msds']; ?>">
                                                    <p class="help-block">Jumlah barang </p>
                                                    <small>
                                                        <span class="text-danger"><?= session('validation') && isset(session('validation')['msds']) ? session('validation')['msds'] : ''; ?></span>
                                                    </small>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input class="form-control"name="nama" value="<?=user()-> username; ?>" readonly>
                                                    <p class="help-block">Nama PIC</p>
                                                </div>
                                                <button type="submit" id="tombolsubmit"class="btn btn-success">Submit Button</button>
                                                <button type="reset" class="btn btn-danger">Reset Button</button>
                                                <button type="button" class="btn btn-warning" onclick="window.location.href='<?= site_url('/databarang'); ?>';">Kembali</button>

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
