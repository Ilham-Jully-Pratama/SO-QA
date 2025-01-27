<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Welcome <?=user()-> username; ?> </h1>
            </div>
        </div>
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
                                
                                    <tr class="odd gradeX">
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;"></td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"></td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"></td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"></td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"></td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;"></td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;">
                                            
                                        </td>
                                        <td style="white-space: nowrap; text-align: center; vertical-align: middle;">
                                            
                                        </td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"></td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"></td>
                                        <td style="white-space: nowrap;text-align: center; vertical-align: middle;"></td>
                                        <?php if(in_groups(['supervisor','admin_kalkual'])) :?>
                                        <td>
                                            
                                        </td>
                                        <td>
                                           
                                        </td>
                                        <td><a type="button" class="btn btn-success"  id="buttonmasuk" style="margin:auto;height:20%">Masuk</a></td>
                                        <?php endif ?>
                                        <td><a type="button" class="btn btn-warning"  id="buttonkeluar" style="margin:auto;height:20%">Keluar</a></td> 
                                       
                                    </tr>
                              
                                </tbody>
                            </table>
                           
                        
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tabel-databarang').DataTable({
            "searching": true,
            "paging": true,
            "lengthChange": true
        });
    });
</script>
<?= $this-> endSection(); ?>


        
