<?php 
    require_once 'inc/header.php'
?>
    
<main class="form-signin">
  <form action="?page=users&action=login" method="POST">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
    <input type="hidden" name="form_token" value="<?php if(!empty($data['token'])) echo $data['token'];?>">
    <input type="email" name="email" class="form-control<?php if(!empty($data['email_err'])) echo ' is-invalid';?>" value="<?php echo empty($data['email']) ? '' : ($data['email']);?>" id="floatingInput" placeholder="name@example.com" >
      <label for="floatingInput">Email address</label>
      <?php if(!empty($data['email_err'])) echo '<span class="invalid-feedback">' . $data['email_err'] . '</span>';?>
    </div>
    <div class="form-floating">
    <input type="password" name ="password" class="form-control<?php if(!empty($data['password_err'])) echo ' is-invalid';?>" value="<?php echo empty($data['password']) ? '' : ($data['password']);?>" id="floatingPassword" placeholder="Password" >
      <label for="floatingPassword">Password<?php if(!empty($data['password_err'])) echo '<span class="invalid-feedback">' . $data['password_err'] . '</span>';?></label>
      <?php if(!empty($data['password_err'])) echo '<span class="invalid-feedback">' . $data['password_err'] . '</span>';?>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" name="remember" value="true"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
  </form>
  <div class="w-100"></div>
  <div class="row oauth mt-3 mx-auto">
    <div class="col d-flex justify-content-between">
        <a href="<?php echo URLROOT . '/index.php?page=users&action=vklogin' ?>"><button type="button" class="btn btn-secondary col mx-1">Log in via VK</button></a>
        <a href="#"><button type="button" class="btn btn-secondary col mx-1 disabled">Log in via FB</button></a> 
        <a href="#"><button type="button" class="btn btn-secondary col mx-1 disabled">Log in via Apple</button></a> 
    </div>
  </div>
</main>

<?php 
    require_once 'inc/footer.php'
?>