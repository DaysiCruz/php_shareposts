<?php require APPROOT . '/views/inc/header.php' ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light w-5 mt-5">
    <h2>Create an Account</h2>
    <p>Please fill out this form register with us</p>
    <form action="<?php echo URLROOT; ?>/users/register" method="post">
<div class="form-group">
    <label for="name">Name: <sup>*</sup></label>
    <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
</div>
<div class="form-group">
    <label for="email">Email: <sup>*</sup></label>
    <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
</div>
<div class="form-group">
    <label for="password">Password: <sup>*</sup></label>
    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
</div>
<div class="form-group">
    <label for="text">confirm Password: <sup>*</sup></label>
    <input type="password" name="confirmPassword" class="form-control form-control-lg  <?php echo (!empty($data['confirmPassword_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirmPassword']; ?>">
    <span class="invalid-feedback"><?php echo $data['confirmPassword_err']; ?></span>
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