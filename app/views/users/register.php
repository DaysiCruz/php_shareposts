<?php require APPROOT . '/views/inc/header.php' ?>
<div class="row">
    <div class="colm-md-6 mx.auto">
        <div class="card card-body bg-light mt-5">
    <h2>Create an Account</h2>
    <p>Please fill out this form register with us</p>
    <form action="<?php echo URLROOT; ?>/users/register" method="post">
<div class="form-group">
    <label for="name">Name: <sup>*</sup></label>
    <input type="text name="name"" class="form-control form-control-lg is-invalid <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>
    <?php echo $data['name']; ?>">
    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
</div>
<div class="form-group">
    <label for="name">Email: <sup>*</sup></label>
    <input type="email" name="name" class="form-control form-control-lg is-invalid <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>
    <?php echo $data['name']; ?>">
    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
</div>
<div class="form-group">
    <label for="name">Password: <sup>*</sup></label>
    <input type="password" name="password" class="form-control form-control-lg is-invalid <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>
    <?php echo $data['name']; ?>">
    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
</div>
<div class="form-group">
    <label for="name">confirm Password: <sup>*</sup></label>
    <input type="text name="name"" class="form-control form-control-lg is-invalid <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>
    <?php echo $data['name']; ?>">
    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
</div>
<div class="row">
    <div class="col">
    <input type="submit" value="Register" class="btn btn-success btn-block">
    </div>
    <div class="col">
        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account login </a>
    </div>
</div>
</form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php' ?>