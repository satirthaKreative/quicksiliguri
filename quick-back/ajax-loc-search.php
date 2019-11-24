<?php require_once "db/config.php"; 
extract($_POST);
$select_ajax_cate = mysqli_query($conn,"SELECT * FROM `location` WHERE location_name like '%".$_POST['search_ajax']."%' ");
$errmsg['no_error'] = '';
$j = 1;
while($fetch_ajax_cate = mysqli_fetch_array($select_ajax_cate)){
	if($fetch_ajax_cate['status'] == 1){ 
		$state = '<a href="#" class="text-bold text-success">Active</a>';
	}else if($fetch_ajax_cate['status'] == 0){ 
		$state = '<a href="#" class="text-bold text-danger">Deactive</a>';
	}
	if($fetch_ajax_cate['status'] == 1){ 
		$act_state = '<button type="button" class="btn btn-sm btn-warning" onclick="change_activity(0,'.$fetch_ajax_cate['id'].')">Change To Deactive</button>';
	}else if($fetch_ajax_cate['status'] == 0){ 
		$act_state = '<button type="button" onclick="change_activity(1,'.$fetch_ajax_cate['id'].')" class="btn btn-sm btn-info">Change To Active</button>';
	}
	$errmsg['no_error'] .= '<tr>
                          <th scope="row">'.$j.'</th>
                          <td>'.$fetch_ajax_cate['location_name'].'</td>
                          <td>'.$state.'</td>
                          <td><a href="edit-location.php?cate_name='.$fetch_ajax_cate['id'].'"1A01"'.$fetch_ajax_cate['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> <a href="view-location.php?cate_name='.$fetch_ajax_cate['id'].'"1A01"'.$fetch_ajax_cate['id'].'" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a> </td>
                          <td>'.$act_state.'</td>
                        </tr>';
$j++;
}
echo json_encode($errmsg);
?>