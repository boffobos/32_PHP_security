<?php include_once 'inc/header.php'; ?>
<h1>Welcome<?php echo isset($_SESSION['user']['name']) ? ', ' . $_SESSION['user']['name'] : '' ;?>!</h1>
<?php include_once 'inc/footer.php'; ?>