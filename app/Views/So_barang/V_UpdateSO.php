<?= $this->extend('Layout'); ?>
<?= $this->section('content'); ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">QA Kalkual</h1>
            </div>
        </div>
        <div id="flash" data-flash="<?= esc(session()->getFlashdata('pesan')); ?>"> </div>
        <div id="flash2" data-flash="<?= esc(session()->getFlashdata('alert')); ?>"> </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Update SO
                        </button>
                    </div>
                    
                    <div class="panel-body">
                        <div class="table-responsive">
                            <h3 class="text-center">Riwayat Melakukan Stock Opname Barang</h3>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tanggal Terakhir SO</th>
                                        <th class="text-center">Keterangan</th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($so as $dd) : ?>
                                    <tr class="odd gradeX">
                                        <td><?= $dd['tanggal_so']; ?></td>
                                        <td><?= $dd['keterangan']; ?></td>
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
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Update Riwayat SO</h5>
            </div>
            <div class="modal-body">
                <form role="form" action="<?= base_url('/submit_update_so')?>">
                    <div class="form-group">
                        <label>Tanggal SO</label>
                        <input type="date" class="form-control <?= session('validation')['tanggal_so'] ?? '' ? 'is-invalid' : ''; ?>" name="tanggal_so" value="">
                        <p class="help-block">Masukan Kode barang</p>
                        <small>
                            <span class="text-danger"><?= session('validation')['tanggal_so'] ?? ''; ?></span>
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input class="form-control <?= session('validation')['keterangan'] ?? '' ? 'is-invalid' : ''; ?>" name="keterangan" value="">
                        <p class="help-block">Masukan Nama barang</p>
                        <small>
                            <span class="text-danger"><?= session('validation')['keterangan'] ?? ''; ?></span>
                        </small>
                    </div>
                    <button type="submit" id="tombolsubmit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>