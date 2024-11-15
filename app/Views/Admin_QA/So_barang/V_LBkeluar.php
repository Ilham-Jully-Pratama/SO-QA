<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Laporan Barang Keluar</h1>
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
                        <div id="flash2" data-flash="<?= esc(session()->getFlashdata('alert')); ?>"></div>
                        <div class="form-inline">
                                <form class="form-inline" action="<?= site_url('/cari_brg_keluar') ?>" method="post">
                                    <div class="form-group d-flex flex-column">
                                        <label> Tanggal Awal </label>
                                        <input type="date" class="form-control <?= session('validation') && isset(session('validation')['tgl_awal']) ? (session('validation')['tgl_awal'] ? 'is-invalid' : '') : ''; ?>" style="margin-bottom: 5px; margin-right: 10px;" name="tgl_awal">
                                        <!-- <small class="help-block text-danger"><?= session('validation') && isset(session('validation')['tgl_awal']) ? session('validation')['tgl_awal'] : ''; ?> </small> -->
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label> Tanggal Akhir </label>
                                        <input type="date" class="form-control <?= session('validation') && isset(session('validation')['tgl_akhir']) ? (session('validation')['tgl_akhir'] ? 'is-invalid' : '') : ''; ?>" style="margin-bottom: 5px; margin-right: 10px;" name="tgl_akhir">
                                        <!-- <small class="help-block text-danger"><?= session('validation') && isset(session('validation')['tgl_akhir']) ? session('validation')['tgl_akhir'] : ''; ?></small> -->
                                    </div>
                                        <button type="submit" class="btn btn-success" style="margin-top: -5px;" name="filter"><i class="fa fa-search" aria-hidden="true"></i></button>                                   
                                </form>                                
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap;">Kodebarang</th>
                                        <th style="white-space: nowrap;">Nama Barang</th>
                                        <th style="white-space: nowrap;">Satuan</th>
                                        <th style="white-space: nowrap;">Jumlah</th>
                                        <th style="white-space: nowrap;">Tanggal Input</th>
                                        <th style="white-space: nowrap;">Keterangan</th>
                                        <th style="white-space: nowrap;">Nama</th>
                                        <th style="white-space: nowrap;">Update</th>
                                        <th style="white-space: nowrap;">Delete</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($barang as $dd) : ?>
                                    <tr class="odd gradeX">
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;"><?= $dd['kodebarang']; ?></td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;"><?= $dd['namabarang']; ?></td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;"><?= $dd['satuan']; ?></td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;"><?= $dd['jumlah']; ?></td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;"><?= $dd['tanggal_keluar']; ?></td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle; "><?= $dd['keterangan']; ?></td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;"><?= $dd['nama']; ?></td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;"><a type="button" data-toggle="modal" class="btn btn-info" data-target="#modalkode" data-kode="<?php echo $dd['kodebarang']; ?>" data-nama="<?php echo $dd['namabarang']; ?>" data-satuan="<?php echo $dd['satuan']; ?>" data-jumlah="<?php echo $dd['jumlah']; ?>" id="buttonupdate" style="margin:auto;height:20%"><i class="fa fa-solid fa-file" aria-hidden="true"></i></a></td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;">
                                            <form action="<?= site_url('/delete_brg_keluar'.$dd['id']) ?>" method="post">
                                                
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
