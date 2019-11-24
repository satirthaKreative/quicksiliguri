<?php require_once "../../quick-back/db/config.php"; ?>
<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$test_months = $_POST['lastname'];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="GnhOjTbke9";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
	       $_SESSION['pay_suc'] = 1;
           $_SESSION['test_months'] = $test_months;
           echo "<script>window.location.href='../../user/add-listing'</script>";
		   } else {
          "<h3>Thank You. Your order status is ". $status .".</h3>";
          "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
           $_SESSION['pay_suc'] = 1;
           $_SESSION['test_months'] = $test_months;
          echo "<script>window.location.href='../../user/add-listing'</script>";
		   }
?>	