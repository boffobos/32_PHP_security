<?php include_once 'inc/header.php'; ?>

 <?php flash('feedback_success'); ?>
 <?php flash('feedback_fail'); ?>


<form action="" method="POST">
    <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($data['email'])) echo $data['email'] ?>" placeholder="name@example.com">
    </div>
    <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?php if(isset($data['name'])) echo $data['name'] ?>" placeholder="John Doe">
    </div>
    <div class="mb-3">
    <label for="feedback" class="form-label">Enter feedback here</label>
    <textarea class="form-control" id="feedback" name="feedback" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include_once 'inc/footer.php'; ?>