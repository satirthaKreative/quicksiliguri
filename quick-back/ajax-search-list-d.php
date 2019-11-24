<?php require_once "db/config.php"; 
extract($_POST);
$search_value = mysqli_real_escape_string($conn,$_POST['search_value']);
   $error_msg['no_error'] = '';
   $insertQuery = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE company_name like '%".$search_value."%' ORDER BY id DESC ");
   $i = 1;
   if(mysqli_num_rows($insertQuery)>0){
   while($fetchQuery = mysqli_fetch_array($insertQuery)){
          if($fetchQuery['admin_approval'] == 1){ 
            $button_Add = '<button type="button" class="btn btn-sm btn-info" onclick=change_activity(0,'.$fetchQuery["id"].')> Active</button>'; 
          }else if($fetchQuery['admin_approval'] == 0){ 
            $button_Add = '<button type="button" onclick=change_activity(1,'.$fetchQuery["id"].') class="btn btn-sm btn-warning"> Deactive</button>';
          }


          $error_msg['no_error'] .= "<tr><td>".$i."</td><td>".$fetchQuery['company_name']."</td><td>".$fetchQuery['contact_number']."</td><td><a href='edit-list.php?edit_id=".$fetchQuery['id']." class='btn btn-sm btn-info'><i class='fa fa-edit'></i></a></td><td>".$button_Add."</td></tr>"; 
   $i++; 
}
}else{
   $error_msg['no_error'] .= '<tr><td colspan="5">No data with this corresponding input</td></tr>';
}
  

echo json_encode($error_msg);

?>
