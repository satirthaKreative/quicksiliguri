<?php require_once "db/config.php"; 
extract($_POST);
   $select_emp1 = mysqli_query($conn,"SELECT * FROM `admin` WHERE user_status = 0 "); 
   $fetch_emp = mysqli_fetch_array($select_emp1);
   if($fetch_emp['u_name'] == $_POST['u_name'] && $fetch_emp['u_org_pass'] == $_POST['u_pass'] ){
      $error_msg['main_error'] = 'You need to change the credentails';
   }else{
      $update_emp1 = mysqli_query($conn,"UPDATE `admin` SET u_name = '".$_POST['u_name']."', u_pass = '".md5($_POST['u_pass'])."', u_org_pass = '".$_POST['u_pass']."' WHERE user_status = 0 ");

      if($update_emp1){
         $error_msg['no_error'] = 'successfully updated';
      }else{
         $error_msg['main_error'] = 'Something went error! Try again';
      }
   }
echo json_encode($error_msg);
?>