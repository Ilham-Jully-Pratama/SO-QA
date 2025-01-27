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
                        <div style="display: flex;">
                            <a type="button" class="btn btn-success" href="<?= base_url('/tambah_data_barang')?>" id="buttontambahbarang" style="height:20%;margin-bottom:10px;"><i class="fa fa-plus" aria-hidden="true"></i>Tambah Data </a>
                            <input type="text" style="height:20%;margin-bottom:10px; margin-left:10px;" id="searchInput" placeholder=" Cari Data">
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
<!-- <script>
        // Ambil elemen input dan tabel
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('tabel-databarang');
        const rows = table.getElementsByTagName('tr');

        // Fungsi untuk mencari data di tabel
        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase(); // Ambil nilai pencarian dan ubah ke lowercase

            // Loop untuk setiap baris tabel
            for (let i = 1; i < rows.length; i++) { // Mulai dari i = 1 untuk melewati header
                const cells = rows[i].getElementsByTagName('td');
                let found = false;

                // Loop untuk setiap sel di baris
                for (let j = 0; j < cells.length; j++) {
                    const cellText = cells[j].textContent.toLowerCase();
                    if (cellText.indexOf(filter) > -1) {
                        found = true; // Jika ditemukan, set flag found menjadi true
                    }
                }

                // Tampilkan atau sembunyikan baris tergantung apakah ditemukan atau tidak
                if (found) {
                    rows[i].style.display = ''; // Tampilkan baris
                } else {
                    rows[i].style.display = 'none'; // Sembunyikan baris
                }
            }
        });
</script> -->
<script> 
    $(document).ready(function() {
    var table = $('#tabel-databarang').DataTable({
        "searching": false,  // Nonaktifkan pencarian default DataTables
        "paging": true,      // Aktifkan pagination
        "lengthChange": true // Izinkan perubahan jumlah baris per halaman
    });

    // Fungsi untuk pencarian kustom yang akan mencari di seluruh tabel
    $('#searchInput').on('keyup', function() {
        var searchTerm = this.value.toLowerCase(); // Ambil kata kunci pencarian

        // Looping setiap baris dalam tabel
        $('#tabel-databarang tbody tr').each(function() {
            var row = $(this);  // Ambil baris
            var rowText = row.text().toLowerCase(); // Ambil teks seluruh baris

            // Cek apakah rowText mengandung kata pencarian
            if (rowText.indexOf(searchTerm) !== -1) {
                row.show();  // Tampilkan baris jika ditemukan
            } else {
                row.hide();  // Sembunyikan baris jika tidak ditemukan
            }
        });

        // Redraw tabel untuk mereset pagination setelah pencarian
        table.draw();
    });
});
</script>
<!-- /#page-wrapper -->

<?= $this-> endSection(); ?>
