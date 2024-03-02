<?php require APPROOT . '/views/inc/header.php' ?>
<div class="jumbotron jumbotron-fluid text-center mt-5 pt-5">
    <div class="container col-lg-8 bg-primary-subtle border --bs-success-border-subtle rounded-3">
    <h1 class="display-3"><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['description']; ?></p>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php' ?>