<?php require APPROOT . '/views/inc/header.php' ?>
<div class="jumbotron jumbotron-fluid text-center mt-5 pt-4">
    <div class="container me-md-3">
    <h1><?php echo $data['title']; ?></h1>
    <p><?php echo $data['description']; ?></p>
    <p>Version: <strong><?php echo APPVERSION; ?></strong></p>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php' ?>