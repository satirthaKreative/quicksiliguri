<?php

$MERCHANT_KEY = "BqGC88Rp";
$SALT = "GnhOjTbke9";
// Merchant Key and Salt as provided by Payu.

$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['lastname'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style type="text/css">
      #form-pay{
        background: #eee;
        margin-top: 20px;
        padding: 0px 100px;
        border-radius: 18px;
      }
      #img_id{
        padding: 40px;
      }
    </style>
  <script>

    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()" >
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-sm-offset-1" id="form-pay">
          <div class="col-md-12">
            <img src="payumoney_logo.png" class="center-block" id="img_id">
          </div>
          <!-- <h2>PayU Form</h2> -->
          <br/>
          <?php if($formError) { ?>
          
            <span style="color:red">Please fill all mandatory fields.</span>
            <br/>
            <br/>
          <?php } ?>
          <form action="<?php echo $action; ?>" method="post" name="payuForm">
            <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
            <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-6 ">
                <div class="form-group">
                  <label for="email">Amount:</label>
                  <input name="amount" value="<?php echo (!isset($_GET['price'])) ? '' : $_GET['price']; ?>" class="form-control" readonly/>
                </div>
              </div>
              <div class="col-md-6 ">
                <div class="form-group">
                  <label for="email">Contact Name:</label>
                  <input name="firstname" id="firstname" value="<?php echo (!isset($_GET['name'])) ? '' : $_GET['name']; ?>" class="form-control" />
                </div>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-6 ">
                  <div class="form-group">
                    <label for="email">Email address:</label>
                    <input name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" class="form-control"  />
                  </div>
                </div>
                <div class="col-md-6 ">
                  <div class="form-group">
                    <label for="email">Contact Number:</label>
                    <input name="phone" value="<?php echo (!isset($_GET['contact'])) ? '' : $_GET['contact']; ?>"  class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Address:</label>
                    <input name="address1" value="<?php if(isset($_GET['address'])){ echo $_GET['address']; }else{ echo ''; } ?>" class="form-control" />
                  </div>
                </div>
                <div class="col-md-6 ">
                  <div class="form-group">
                    <label for="email">Optional Address:</label>
                    <input name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 ">
                  <div class="form-group">
                    <label for="email">City:</label>
                    <input name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" class="form-control" />
                  </div>
                </div>
                <div class="col-md-6 ">
                  <input type="hidden" name="lastname" id="lastname" value="<?= $_GET['plans']; ?>" />
                  <input type="hidden" name="surl" value="https://quicksiliguri.com/user/payment/success" size="64" />
                  <input type="hidden" name="furl" value="https://quicksiliguri.com/user/payment/failure" size="64" />
                  <input type="hidden" name="curl" value="" />
                  <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                  <div class="form-group">
                    <label for="email">State:</label>
                    <input name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 ">
                  <div class="form-group">
                    <label for="email">Country:</label>
                    <input name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" class="form-control" />
                  </div>
                </div>
                <div class="col-md-6 ">
                  <div class="form-group">
                    <label for="email">Zipcode:</label>
                    <input name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="email">Plan Info:</label>
                <textarea name="productinfo" class="form-control" readonly=""><?php if(isset($_GET['plans'])){ echo $_GET['plans']." Months Plans"; }else{ echo ''; } ?></textarea>
              </div>
            </div>
            <div class="col-sm-12">
              <?php if(!$hash) { ?><input type="submit" class="btn btn-info btn-lg center-block" value="Send Money"  />
              <?php } ?>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
