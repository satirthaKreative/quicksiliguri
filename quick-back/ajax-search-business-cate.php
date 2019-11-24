<?php require_once "db/config.php"; 
extract($_POST);
$search_value = mysqli_real_escape_string($conn,$_POST['search_value']);
$category = mysqli_real_escape_string($conn,$_POST['category']);
   $error_msg['no_error'] = '';
   $insertQuery = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `category` ON listing_details.property_type = category.id INNER JOIN company_reg ON company_reg.id = listing_details.user_id WHERE category.category_name LIKE '%".$category."%' AND (company_reg.company_name LIKE '%".$search_value."%' OR listing_details.property_name LIKE '%".$search_value."%' OR listing_details.property_address LIKE '%".$search_value."%') ");
   $i = 1;
   if(mysqli_num_rows($insertQuery)>0){
   while($fetchQuery = mysqli_fetch_array($insertQuery)){
   		$error_msg['no_error'] .= '<tr><th scope="row">'.$i.'</th><td><img src="../user/uploads/property/'.$fetchQuery['property_image'].'" width="200px;"></td> <td >'.$fetchQuery['property_name'].'</td><td>'.$fetchQuery['property_address'].'</td><td>&#x20b9; '.$fetchQuery['property_price'].'</td><td>'.$fetchQuery['company_name'].'</td></tr>';
   } } else{
      $error_msg['no_error'] .= '<tr><td colspan="5">No data with this corresponding input</td></tr>';
   }
echo json_encode($error_msg);
?>