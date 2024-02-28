<?php require APPROOT . '/views/inc/header.php' ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-lig"><i class="fa fa-backward"></i>Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Edit Post</h2>
    <p>Create a post with this form</p>
    <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
<div class="form-group">
    <label for="title">Tittle: <sup>*</sup></label>
    <input type="text" name="title" class="form-control form-control-lg is-invalid <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>
    <?php if(isset($data['title'])) echo $data['title']; ?>">
    <span class="invalid-feedback"><?php if(isset($data['title_err'])) echo $data['title_err']; ?></span>
</div>
<div class="form-group">
    <label for="body">Body: <sup>*</sup></label>
    <textarea name="body" class="form-control form-control-lg is-invalid <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?><?php echo $data['body']; ?>"></textarea>
    <span class="invalid-feedback"><?php if(isset($data['name_err'])) echo $data['name_err']; ?></span>
</div>
</div>
<input type="submit" class="btn btn-success" value="submit">
</form>
</div>
<?php require APPROOT . '/views/inc/footer.php' ?>