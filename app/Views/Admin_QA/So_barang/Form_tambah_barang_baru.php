<?php
date_default_timezone_set('Asia/Jakarta'); // Mengatur zona waktu
?>

<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<div id="page-wrapper">
    <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Form Tambah Data Barang </h1>
                        </div> 
                        <!-- /.col-lg-12 -->
                    </div>
                    <div id="flash2" data-flash="<?= esc(session()->getFlashdata('alert')); ?>">
                    <div id="flash" data-flash="<?= esc(session()->getFlashdata('pesan')); ?>">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Input Data Barang 
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        
                                            <form role="form" action="<?= site_url('/submitbarangbaruadmin') ?>">
                                                <div class="form-group">
                                                    <label>Kode Barang</label>
                                                    <input class="form-control  <?= session('validation') && isset(session('validation')['kodebarang']) ? (session('validation')['kodebarang'] ? 'is-invalid' : '') : ''; ?>" name="kodebarang" placeholder="Terdiri Dari Kombinasi NO Lot">
                                                    <p class="help-block">Masukan Kode barang </p>                                                   
                                                    <small></small>
                                                        <span class="text-danger"><?= session('validation') && isset(session('validation')['kodebarang']) ? session('validation')['kodebarang'] : ''; ?></span>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama barang</label>
                                                    <select class="form-control <?= session('validation') && isset(session('validation')['namabarang']) ? (session('validation')['satuan'] ? 'is-invalid' : '') : ''; ?>" name="namabarang">
                                                        <option value="">Pilih Nama Barang</option> 
                                                        <?php foreach ($barang as $namabarang): ?> 
                                                            <option><?= esc($namabarang['namabarang']); ?></option> <!-- Menampilkan nama satuan -->
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <span class="text-danger"><?= session('validation') && isset(session('validation')['namabarang']) ? session('validation')['namabarang'] : ''; ?></span>
                                                </div>
                                                <a type="button" class="btn btn-primary" href="<?= base_url('/daftarnamabarang_adminqa')?>" id="buttontambahbarang" style="margin:auto;height:20%;margin-bottom:10px;"><i class="fa fa-plus" aria-hidden="true"></i>Tambah Nama Barang </a>
                                                <a type="button" class="btn btn-danger" href="<?= base_url('/hapusnamabarang_adminqa')?>" id="buttontambahbarang" style="margin:auto;height:20%;margin-bottom:10px;"><i class="fa fa-plus" aria-hidden="true"></i>Hapus Nama Barang </a>
                                                <!-- di isi sesuai dengan nama di label input -->
                                                <div class="form-group">
                                                    <label>Satuan</label>
                                                    <select class="form-control <?= session('validation') && isset(session('validation')['satuan']) ? (session('validation')['satuan'] ? 'is-invalid' : '') : ''; ?>" name="satuan">
                                                        <option value="">Pilih Satuan</option> 
                                                        <option >ml</option>
                                                        <option >Pcs</option>
                                                        <option >Vial</option> 
                                                    </select>
                                                    <span class="text-danger"><?= session('validation') && isset(session('validation')['satuan']) ? session('validation')['satuan'] : ''; ?></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jumlah</label>
                                                    <input class="form-control <?= session('validation') && isset(session('validation')['jumlahbarang']) ? (session('validation')['jumlahbarang'] ? 'is-invalid' : '') : ''; ?>" name="jumlahbarang" type="number" min="0" step="1">
                                                    <p class="help-block">Jumlah barang </p>
                                                    <small>
                                                        <span class="text-danger"><?= session('validation') && isset(session('validation')['jumlahbarang']) ? session('validation')['jumlahbarang'] : ''; ?></span>
                                                    </small>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Input</label>
                                                    <input class="form-control" type="datetime-local" name="tanggal" id="tanggalInput" value="<?= date('Y-m-d\TH:i', time()); ?>" readonly>
                                                    <p class="help-block">Tanggal Input Data Baru </p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Datang Barang</label>
                                                    <input class="form-control  <?= session('validation') && isset(session('validation')['tanggal_datang']) ? (session('validation')['tanggal_datang'] ? 'is-invalid' : '') : ''; ?>" type="date" name="tanggal_datang" id="tanggaldatang">
                                                    <p class="help-block">Tanggal Input Data Baru </p>
                                                    <small>
                                                        <span class="text-danger"><?= session('validation') && isset(session('validation')['tanggal_datang']) ? session('validation')['tanggal_datang'] : ''; ?></span>
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
</div>
<script>
    const tombol = document.querySelector('#tombolsubmit')
    tombol.addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah pengiriman form
        Swal.fire({
            title: "PERHATIAN",
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
