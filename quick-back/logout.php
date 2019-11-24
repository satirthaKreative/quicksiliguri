<?php 

require_once 'db/config.php';
if(isset($_SESSION['login_id'])&& !isset($_SESSION['emp_id'])){
session_unset('login_id');
echo "<script>window.location.href='login'</script>";
}
if(isset($_SESSION['emp_id'])&& !isset($_SESSION['login_id'])){
	session_unset('emp_id');
	echo "<script>window.location.href='employee'</script>";
}
?>
