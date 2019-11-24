<?php require_once "quick-back/db/config.php"; ?>
<!-- <?php error_reporting(0); ?> -->
<?php
   

if(isset($_POST['comp_reg'])){
            $_SESSION['company_name'] = $_POST['comp_name'];
            $_SESSION['contact_name'] = $_POST['contact_name'];
            $_SESSION['contact_no'] = $_POST['contact_no'];
            $otp  = rand(100000,999999);
            $_SESSION['otp'] = $otp;
        //Your authentication key
        $authKey = "296237AFZLprtzK5d8e479b";

        //Multiple mobiles numbers separated by comma
        $mobileNumber = $_POST['contact_no'];

        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "quicks";

        //Your message to send, Add URL encoding here.
        $message = urlencode($otp);

        //Define route 
        //$route = "default";
        //Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            //'route' => $route
        );

        //API URL
        $url="http://api.msg91.com/api/sendhttp.php";

        // init the resource
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);

        //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }

        curl_close($ch);

        if($output!=''){ 
            echo "<script>window.location.href='otp-verify.php?suc=otp sent to your mobile number'</script>";
         }
}

if(isset($_POST['comp_reg1'])){
            $_SESSION['company_name'] = $_POST['comp_name'];
            $_SESSION['contact_name'] = $_POST['contact_name'];
            $_SESSION['contact_no'] = $_POST['contact_no'];
            $otp  = rand(100000,999999);
            $_SESSION['otp'] = $otp;
        //Your authentication key
        $authKey = "296237AFZLprtzK5d8e479b";

        //Multiple mobiles numbers separated by comma
        $mobileNumber = $_POST['contact_no'];

        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "quicks";

        //Your message to send, Add URL encoding here.
        $message = urlencode($otp);

        //Define route 
        //$route = "default";
        //Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            //'route' => $route
        );

        //API URL
        $url="http://api.msg91.com/api/sendhttp.php";

        // init the resource
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);

        //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }

        curl_close($ch);

        if($output!=''){ 
            echo "<script>window.location.href='login-otp.php?suc=otp sent to your mobile number'</script>";
         }
}
?>

