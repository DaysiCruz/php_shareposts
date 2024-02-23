<?php require APPROOT . '/views/inc/header.php' ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-lig"><i class="fa fa-backward"></i>Back</a>
<div class="card card-body bg-light w-5 mt-5">
    <h2>Add Posts </h2>
    <p>Create a post with this form</p>
    <form action="<?php echo URLROOT; ?>/posts/add" method="post">
<div class="form-group">
    <label for="tittle">Tittle: <sup>*</sup></label>
    <input type="text" name="tittle" class="form-control form-control-lg is-invalid <?php echo (!empty($data['tittle_err'])) ? 'is-invalid' : ''; ?>
    <?php echo $data['tittle']; ?>">
    <span class="invalid-feedback"><?php echo $data['tittle_err']; ?></span>
</div>
<div class="form-group">
    <label for="body">Body: <sup>*</sup></label>
    <textarea name="body" class="form-control form-control-lg is-invalid <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?><?php echo $data['body']; ?></textarea>
    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
</div>
</div>
<input type="submit" class="btn btn-success" value="submit">
</form>
</div>
<?php require APPROOT . '/views/inc/footer.php' ?>