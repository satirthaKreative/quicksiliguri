<?php 
require_once "../quick-back/db/config.php"; 
extract($_POST);
$_SESSION['price_name'] = $_POST['name'];
$_SESSION['price_contact'] = $_POST['contact'];
$_SESSION['price_email'] = $_POST['email'];
$_SESSION['price_address'] = $_POST['address'];
$_SESSION['price_plans'] = $_POST['plans'];
$_SESSION['price_price'] = $_POST['price']; 
$sucmsg['suc_msg'] = 'test';
echo json_encode($sucmsg); 
?>