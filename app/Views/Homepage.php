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
        <div id="flash3" data-flash="<?= esc(session()->getFlashdata('notif')); ?>"></div>
        <div id="flash4" data-flash="<?= esc(session()->getFlashdata('pesanhompage')); ?>"></div>
        
        <!-- <div class="row">
            <div class="col-md-8">
                <h2>About Us</h2>
                <p>Welcome to our website! We are a company dedicated to providing excellent services to our customers.</p>
            </div>
            <div class="col-md-4">
                <h2>Latest News</h2>
                <ul>
                    <li>New product launch coming soon!</li>
                    <li>We've expanded our services</li>
                    <li>Check out our summer discounts</li>
                </ul>
            </div>
        </div> -->
    </div>
</div>
<?= $this-> endSection(); ?>


        
