<?php require_once "db/config.php"; ?>
<?php 

// admin profile 
function admin_profile($conn){
	$selectProfile = mysqli_query($conn,"SELECT * FROM `admin` WHERE id = '".$_SESSION['login_id']."' ");
	$fetchProfile = mysqli_fetch_array($selectProfile);
	return $fetchProfile;
}

?>