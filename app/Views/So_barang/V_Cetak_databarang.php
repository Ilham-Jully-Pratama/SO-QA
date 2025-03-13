 <head>
        <link href="<?= base_url() ?>/css/metisMenu.min.css" rel="stylesheet">
        <!-- DataTables CSS -->
        <link href="<?= base_url() ?>/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="<?= base_url() ?>/css/dataTables/dataTables.responsive.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= base_url() ?>/css/startmin.css" rel="stylesheet">
        <style>
    /* Tambah border untuk seluruh tabel */
    .table {
        border-collapse: collapse; /* Pastikan border menyatu */
        width: 100%;
    }
    
    .table, .table th, .table td {
        border: 2px solid black !important; /* Border lebih tegas */
    }
    
    .table th, .table td {
        padding: 12px; /* Tambah padding agar lebih lebar */
        text-align: center; /* Rata tengah semua teks */
        vertical-align: middle; /* Posisi teks sejajar tengah */
    }
</style>


 </head>     
      
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center">Data Barang Kalkual</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-nowrap">Kode Barang</th>
                                        <th class="text-nowrap">Nama Barang</th>
                                        <th class="text-nowrap">Satuan</th>
                                        <th class="text-nowrap">Jumlah</th>
                                        <th class="text-nowrap">Tanggal Update</th>
                                        <th class="text-nowrap">Tanggal Kedatangan</th>
                                        <th class="text-nowrap">Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($barang as $dd) : ?>
                                        <tr>
                                            <td class="text-nowrap"><?= esc($dd['kodebarang']); ?></td>
                                            <td class="text-nowrap"><?= esc($dd['namabarang']); ?></td>
                                            <td><?= esc($dd['satuan']); ?></td>
                                            <td><?= esc($dd['jumlah']); ?></td>
                                            <td class="text-nowrap"><?= esc($dd['tanggal']); ?></td>
                                            <td class="text-nowrap"><?= esc($dd['tanggal_datang']); ?></td>
                                            <td class="text-nowrap"><?= esc($dd['nama']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>   
                                </tbody>
                            </table>
                        </div> <!-- /table-responsive -->
                    </div> <!-- /panel-body -->
                </div> <!-- /panel -->
            </div> <!-- /col-lg-12 -->
        </div> <!-- /row -->
    </div> <!-- /container-fluid -->
</div>
