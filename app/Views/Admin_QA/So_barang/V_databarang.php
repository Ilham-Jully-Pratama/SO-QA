<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= esc($title) ?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div id="flash" data-flash="<?= esc(session()->getFlashdata('pesan')); ?>">
        <div id="flash2" data-flash="<?= esc(session()->getFlashdata('alert')); ?>">
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            Terakhir melakukan stock opname
                            <span class="text-danger">
                                (<?= $terakhir_so ? date('d-m-Y', strtotime($terakhir_so['tanggal_so'])) : 'Belum ada data' ?>)
                            </span>
                            <a href="<?= base_url('/update_so_adminqa')?>">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i> Lihat Detail
                            </a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="d-flex">
                                <a class="btn btn-success" href="<?= base_url('/tambah_data_barangadminqa')?>" id="buttontambahbarang" style="margin: 6px;">
                                    <i class="fa fa-plus"></i> Tambah Data
                                </a>
                        </div>
                        <div>
                            <form action="<?= site_url('/databarangadminqa') ?>" method="get"> 
                                <input type="text" class="form-control" name="katakunci" placeholder="Kata Kunci Nama Barang" style="width: 200px; margin: 6px;">
                                <button class="btn btn-warning" type="submit"  style="margin: 6px;">Cari</button>
                            </form>
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead class="text-center">
                                    <tr>
                                        <th>Kodebarang</th>
                                        <th style="white-space: nowrap;">Nama Barang</th>
                                        <th style="white-space: nowrap;">Merek</th>
                                        <th>Satuan</th>
                                        <th>Jumlah</th>
                                        <th style="white-space: nowrap;">Tanggal Update</th>
                                        <th style="white-space: nowrap;">Tanggal Kedatangan</th>
                                        <th style="white-space: nowrap;">Nama</th>
                                        <?php if(in_groups(['supervisor','admin_qa'])) :?>
                                        <th>Update</th>
                                        <th>Delete</th>
                                        <th colspan="2" class="text-center">Aksi</th>
                                        <?php else: ?>
                                        <th>Aksi</th> <!-- Tampilkan hanya untuk peran lain -->
                                        <?php endif ?>
        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($barang as $dd) : ?>
                                    <tr class="odd gradeX">
                                        <td style="white-space: nowrap;"><?= $dd['kodebarang']; ?></td>
                                        <td style="white-space: nowrap;"><?= $dd['namabarang']; ?></td>
                                        <td style="white-space: nowrap;"><?= $dd['merek']; ?></td>
                                        <td><?= $dd['satuan']; ?></td>
                                        <td><?= $dd['jumlah']; ?></td>
                                        <td style="white-space: nowrap;"><?= $dd['tanggal']; ?></td>
                                        <td style="white-space: nowrap;"><?= $dd['tanggal_datang']; ?></td>
                                        <td style="white-space: nowrap;"><?= $dd['nama']; ?></td>
                                        <?php if(in_groups(['supervisor','admin_qa'])) :?>
                                        <td>
                                            <a type="button" class="btn btn-info" href="<?= base_url('/ubah_barang_admin' . $dd['kodebarang']) ?>" id="buttonupdate" style="margin:auto;height:20%"><i class="fa fa-pencil" aria-hidden="true"></i></a>     
                                        </td>
                                        <td>
                                            <form action="<?= site_url('/hapus_barang'.$dd['id']) ?>" method="post">
                                                
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" id="tombolhapusdata" class="btn btn-danger "style="margin:auto;height:20%"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                        <td><a type="button" class="btn btn-success" href="<?= base_url('/brg_masuk' . $dd['kodebarang']) ?>" id="buttonmasuk" style="margin:auto;height:20%">Masuk</a></td>
                                        <?php endif ?>
                                        <td><a type="button" class="btn btn-warning" href="<?= base_url('/brg_keluar' . $dd['kodebarang']) ?>" id="buttonkeluar" style="margin:auto;height:20%">Keluar</a></td> 
                                       
                                    </tr>
                                <?php endforeach; ?>   
                                </tbody>
                            </table>
                            <?php if ($pager) : ?>
                                <?= $pager->links() ?>
                            <?php endif; ?>
                        </div>
                        <a class="btn btn-danger" href="<?= base_url('/printdatabarang_admin')?>" id="buttontambahbarang" style="margin: 6px;"
                        target="_blank" rel="noopener noreferrer">
                            <i class="fa fa-print"></i> Print
                        </a>
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
