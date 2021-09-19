<?php 
    include_once 'inc/header.php';
?>


<main class="form-signin">
  <form class='' action="?page=users&action=register" method="POST">
    <h1 class="h3 mb-3 fw-normal">Please feel fields</h1>

    <div class="form-floating">
      <input type="text" name="full_name" class="form-control<?php if(!empty($data['full_name_err'])) echo ' is-invalid';?>" value="<?php echo empty($data['full_name']) ? '' : $data['full_name'];?>" id="floatingName" placeholder="John Doe" >
      <label for="floatingName">Full Name<?php if(!empty($data['full_name_err'])) echo '<span class="invalid-feedback">' . $data['full_name_err'] . '</span>';?></label>
      <?php if(!empty($data['full_name_err'])) echo '<span class="invalid-feedback">' . $data['full_name_err'] . '</span>';?>
    </div>
    <div class="form-floating">
      <input type="email" name="email" class="form-control<?php if(!empty($data['email_err'])) echo ' is-invalid';?>" value="<?php echo empty($data['email']) ? '' : ($data['email']);?>" id="floatingInput" placeholder="name@example.com" >
      <label for="floatingInput">Email address</label>
      <?php if(!empty($data['email_err'])) echo '<span class="invalid-feedback">' . $data['email_err'] . '</span>';?>
    </div>
    <div class="form-floating">
      <input type="password" name ="password" class="form-control<?php if(!empty($data['password_err'])) echo ' is-invalid';?>" value="<?php echo empty($data['password']) ? '' : ($data['password']);?>" id="floatingPassword" placeholder="Password" >
      <label for="floatingPassword">Password<?php if(!empty($data['password_err'])) echo '<span class="invalid-feedback">' . $data['password_err'] . '</span>';?></label>
      <?php if(!empty($data['password_err'])) echo '<span class="invalid-feedback">' . $data['password_err'] . '</span>';?>
    </div>
    <div class="form-floating">
      <input type="password" name ="confirm_password" class="form-control<?php if(!empty($data['confirm_password_err'])) echo ' is-invalid';?>" value="<?php echo empty($data['confirm_password']) ? '' : $data['confirm_password'];?>" id="floatingConfirmPassword" placeholder="Password" >
      <label for="floatingConfirmPassword">Confirm Password<?php if(!empty($data['confirm_password_err'])) echo '<span class="invalid-feedback">' . $data['confirm_password_err'] . '</span>';?></label>
      <?php if(!empty($data['confirm_password_err'])) echo '<span class="invalid-feedback">' . $data['confirm_password_err'] . '</span>';?>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
    <p class="text-muted">Have an account?<a href="?page=users&action=login" class="text-reset"> Log in...</a></p>
  </form>
</main>


<?php include_once 'inc/footer.php'; ?>