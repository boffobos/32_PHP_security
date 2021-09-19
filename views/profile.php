<?php include_once 'inc/header.php'; ?>

<?php if(!in_array('vk', $_SESSION['user']['rights'])) : ?>
<table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">#</th>
              
            </tr>
          </thead>
          <tbody>
              <?php foreach($data as $key => $value) : ?>
            <tr>
              <td><?php echo '<strong>' . $key . '</strong>'; ?></td>
              <td><?php echo $value; ?></td>
            </tr>
            <?php endforeach; ?>
            
          </tbody>
        </table>
  <?php else : ?>
    <img src="<?php echo URLROOT . '/views/img/social.jpg' ?>" height="500" width="100%" >
  <?php endif; ?>

<?php include_once 'inc/footer.php'; ?>