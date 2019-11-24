<?php require_once "db/config.php"; 

//change pass ajax

extract($_POST);
$u_cate = strtolower($_POST['category']);
$u_about_cate = $_POST['about_cate'];
$cate_icon = $_POST['cate_icon'];
if($u_cate == ''){
	$error_msg['main_error'] = "Enter a category";
}else{

	$insertQuery = "UPDATE `category` SET category_name = '".mysqli_real_escape_string($conn,$u_cate)."' , category_about = '".$u_about_cate."', category_icon = '".mysqli_real_escape_string($conn,$cate_icon)."'  WHERE id = '".mysqli_real_escape_string($conn,$_POST['cate_id'])."'  ";
	$updateQuery = mysqli_query($conn,$insertQuery);
	if($updateQuery){
		$error_msg['no_error'] = "Category Updated Successfully";
	}else{
		$error_msg['main_error'] = "Something Went Wrong! Try again later";
	}

}

echo json_encode($error_msg);

?>