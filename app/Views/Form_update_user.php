<?= $this-> extend('Layout'); ?>
<?= $this-> section('content'); ?>
<div id="page-wrapper">
<div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Form Update User </h1>
                        </div> 
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Ubah data User
                                </div>
                                <div class="panel-body">
                                <div id="flash2" data-flash="<?= esc(session()->getFlashdata('alert')); ?>">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <?php foreach ($users as $dd) : ?>
                                            <form role="form" action="<?= site_url('/simpan_update_user'.$dd['id']) ?>" method="post">
                                                <div class="form-group">
                                                    <label>ID</label>
                                                    <input class="form-control"  name="id" value="<?= $dd['id']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input class="form-control"  name="username" value="<?= $dd['username']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email </label>
                                                    <input class="form-control" name="email" value="<?= $dd['email']; ?>"readonly>
                                                    <p class="help-block">Masukan Nama barang </p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <select class="form-control" name="role">
                                                        <option value="1" <?= ($dd['role'] == 'admin_kalkual') ? 'selected' : ''; ?>>admin kalkual</option>
                                                        <option value="2" <?= ($dd['role'] == 'user') ? 'selected' : ''; ?>>user</option>
                                                        <option value="3" <?= ($dd['role'] == 'supervisor') ? 'selected' : ''; ?>>supervisor</option>
                                                        <option value="5" <?= ($dd['role'] == 'admin_qa') ? 'selected' : ''; ?>>admin QA</option> <!-- Menampilkan nama satuan -->
                                                    </select>
                                                </div>
                                                <button type="submit" id="tombolsubmit"class="btn btn-success">Submit Button</button>
                                                <button type="reset" class="btn btn-danger">Reset Button</button>
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
