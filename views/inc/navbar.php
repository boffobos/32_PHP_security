<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3 fixed-top" aria-label="First navbar example">
  <div class="container">
      <a class="navbar-brand" href="<?php echo URLROOT?>"><?php echo SITENAME?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?php echo URLROOT?>">Home</a>
          </li>
        <?php if(isLoggedIn()) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT?>/index.php?page=users&action=profile">About</a>
          </li>
        <?php endif; ?>
        <?php if(isset($_SESSION['user']['rights'])) : ?>
          <li class="nav-item">
            <a class="nav-link <?php if(in_array('edit', $_SESSION['user']['rights'])){echo '';} else { echo ' disabled';}; ?>" href="<?php echo URLROOT?>/index.php?page=users&action=list">Users List</a>
          </li>
        <?php endif; ?>  
        <?php if(isLoggedIn()) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT . '/index.php?page=users&action=feedback'; ?>">Feedback</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT . '/index.php?page=users&action=login'; ?>">Feedback</a>
          </li>
        <?php endif; ?>  
        </ul>
        
        <ul class="navbar-nav ms-auto">
          <?php if(isset($_SESSION['user'])) : ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Welcome <?php echo $_SESSION['user']['name'] . '!'; ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo URLROOT?>/index.php?page=users&action=logout">Log out</a>
            </li>
          <?php else : ?>  
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo URLROOT?>/index.php?page=users&action=register">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT?>/index.php?page=users&action=login">Login</a>
            </li>
          <?php endif;?>
        </ul>
      </div>
  </div>
</nav>