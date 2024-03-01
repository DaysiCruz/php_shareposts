<?php require APPROOT . '/views/inc/header.php' ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-lig"><i class="fa fa-backward"></i>Back</a>
<br>
<h1><?php echo $data['post']->title ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
Written by <?php echo $data['user']->name; ?> on <?php if(isset($data['post'])) echo $data['post']->created_at; ?></div>
    <p><?php if(isset($data['post'])) echo $data['post']->body; ?></p>
    <?php if(isset($data['post'])) if($data['post']->user_id == $_SESSION['user_id']) : ?>
        <hr>
        <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>"class="btn btn-dark">Edit</a>

    <form class="d-grid gap-2 d-md-flex justify-content-md-end" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
        <input type="submit" value="delete" class="btn btn-danger me-md-2">
    </form>
        
        <?php endif ; ?>
    
<?php require APPROOT . '/views/inc/footer.php' ?>