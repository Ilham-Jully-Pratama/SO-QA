<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Laporan Barang Masuk</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div> 

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Data Monitoring Stock
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="flash" data-flash="<?= esc(session()->getFlashdata('pesan')); ?>"></div>
                        <div id="flash2" data-flash="<?= esc(session()->getFlashdata('alert')); ?>"></div>
                        <!-- tabel cari barang -->
                        <div class="form-inline">
                                <form class="form-inline" action="<?= site_url('/cari_brg_masuk') ?>" method="post">
                                    <div class="form-group d-flex flex-column">
                                        <label> Tanggal Awal </label>
                                        <input type="date" class="form-control <?= session('validation') && isset(session('validation')['tgl_awal']) ? (session('validation')['tgl_awal'] ? 'is-invalid' : '') : ''; ?>" style="margin-bottom: 5px; margin-right: 10px;" name="tgl_awal">
                                        <!-- <small class="help-block text-danger"><?= session('validation') && isset(session('validation')['tgl_awal']) ? session('validation')['tgl_awal'] : ''; ?> </small> -->
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                         <label> Tanggal Akhir</label>
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
                                            <th style="white-space: nowrap;">Tanggal Input </th>
                                            <th style="white-space: nowrap;">Keterangan</th>
                                            <th style="white-space: nowrap;">Nama</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($barang as $dd) : ?>
                                        <tr class="odd gradeX">
                                            <td ><?= $dd['kodebarang']; ?></td>
                                            <td><?= $dd['namabarang']; ?></td>
                                            <td><?= $dd['satuan']; ?></td>
                                            <td><?= $dd['jumlah']; ?></td>
                                            <td><?= $dd['tanggal_masuk']; ?></td>
                                            <td style="white-space: nowrap;"><?= $dd['Keterangan']; ?></td>
                                            <td style="white-space: nowrap;"><?= $dd['nama']; ?></td>
                                            <?php if(in_groups(['supervisor','admin_qa'])) :?>
                                            <td><a type="button" class="btn btn-info" href="<?= base_url('/ubah_brg_masuk' . $dd['kodebarang']) ?>" id="buttonupdate" style="margin:auto;height:20%"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                                            <td>
                                                <form action="<?= site_url('/delete_brg_masuk'.$dd['id']) ?>" method="post">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" id="tombolhapusdata" class="btn btn-danger "style="margin:auto;height:20%"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </form>
                                            </td>
                                            <?php endif ?>
                                        </tr>
                                    <?php endforeach; ?>   
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
