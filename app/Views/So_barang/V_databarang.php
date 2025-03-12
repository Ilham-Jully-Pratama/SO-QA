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
        <div id="flash" data-flash="<?= esc(session()->getFlashdata('pesan')); ?>"> </div>
        <div id="flash2" data-flash="<?= esc(session()->getFlashdata('alert')); ?>"> </div>
        
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Data Monitoring Stock
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="d-flex">
                                <a class="btn btn-success d-flex align-items-center" href="<?= base_url('/tambah_data_barang')?>" id="buttontambahbarang" style="margin: 6px;">
                                    <i class="fa fa-plus"></i> Tambah Data
                                </a>
                                <form action="<?= site_url('/databarang') ?>" method="get" class="d-flex gap-2"> 
                                    <input type="text" class="form-control" name="katakunci" placeholder="Cari" style="width: 200px; margin: 6px;">
                                    <button class="btn btn-warning" type="submit"  style="margin: 6px;">Cari</button>
                                </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tabel-databarang">
                                <thead class="text-center">
                                    <tr>
                                        <th style="white-space: nowrap;text-align: center; vertical-align: middle;">Kodebarang</th>
                                        <th style="white-space: nowrap;text-align: center; vertical-align: middle;">Nama Barang</th>
                                        <th style="white-space: nowrap;text-align: center; vertical-align: middle;">Merek</th>
                                        <th style="white-space: nowrap;text-align: center; vertical-align: middle;">Satuan</th>
                                        <th style="white-space: nowrap;text-align: center; vertical-align: middle;">Jumlah</th>
                                        <th style="white-space: nowrap;text-align: center; vertical-align: middle;">Expired</th>
                                        <th style="white-space: nowrap;text-align: center; vertical-align: middle;">COA</th>
                                        <th style="white-space: nowrap;text-align: center; vertical-align: middle;">MSDS</th>
                                        <th style="white-space: nowrap;text-align: center; vertical-align: middle;">Tanggal Update</th>
                                        <th style="white-space: nowrap; text-align: center; vertical-align: middle;">Tanggal Kedatangan</th>
                                        <th style="white-space: nowrap; text-align: center; vertical-align: middle;">Nama</th>
                                        <?php if(in_groups(['supervisor','admin_kalkual'])) :?>
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
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;"><?= $dd['kodebarang']; ?></td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"><?= $dd['namabarang']; ?></td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"><?= $dd['merek']; ?></td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"><?= $dd['satuan']; ?></td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"><?= $dd['jumlah']; ?></td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;"><?= $dd['expired']; ?></td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;">
                                            <a href="<?= $dd['coa']; ?>"><?= esc('Lihat COA'); ?></a>
                                        </td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;">
                                            <a href="<?= $dd['msds']; ?>"><?= esc('Lihat MSDS'); ?></a>
                                        </td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"><?= $dd['tanggal']; ?></td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"><?= $dd['tanggal_datang']; ?></td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"><?= $dd['nama']; ?></td>
                                        <?php if(in_groups(['supervisor','admin_kalkual'])) :?>
                                        <td>
                                            <a type="button" class="btn btn-info" href="<?= base_url('/ubahbarang' . $dd['kodebarang']) ?>" id="buttonupdate" style="margin:auto;height:20%"><i class="fa fa-pencil" aria-hidden="true"></i></a>     
                                        </td>
                                        <td>
                                            <form action="<?= site_url('/delete_barang'.$dd['id']) ?>" method="post">
                                                
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" id="tombolhapusdata" class="btn btn-danger "style="margin:auto;height:20%"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                        <td><a type="button" class="btn btn-success" href="<?= base_url('/barang_masuk' . $dd['kodebarang']) ?>" id="buttonmasuk" style="margin:auto;height:20%">Masuk</a></td>
                                        <?php endif ?>
                                        <td><a type="button" class="btn btn-warning" href="<?= base_url('/barang_keluar' . $dd['kodebarang']) ?>" id="buttonkeluar" style="margin:auto;height:20%">Keluar</a></td> 
                                       
                                    </tr>
                                <?php endforeach; ?>   
                                </tbody>
                            </table>
                            <?= $pager->links()?>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    <!-- /.container-fluid -->
    </div>
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
