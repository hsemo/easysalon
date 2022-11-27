<?php
session_start();
$errno = $_GET['errno'];
$error = $_GET['error'];

$title = "Error";
include('header.php');
?>

<div class="f-container">
	<div class="alert alert-danger" role="alert">
		<?php echo '[ERROR] '.$errno.': '.$error; ?>
	</div>
</div>

<?php
include('footer.php');
?>