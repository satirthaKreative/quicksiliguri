<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>
<?php 
$total_array = []; $select_array = mysqli_query($conn,"SELECT * FROM `listing_details` "); 
while($fetch_array = mysqli_fetch_array($select_array)){
      $total_array[] = $fetch_array['property_name'];
}
?>
<?php if(isset($_GET['cate_name'])){
  $getCate = explode('1A01',$_GET['cate_name']);
  $query_id = $getCate[0];
  $selectlocation = mysqli_query($conn,"DELETE FROM `prime_listing` WHERE id = '".$query_id."' ");
  if($selectlocation){
    echo "<script>window.location.href='view-prime-listing?sucmsg=Data deleted successfuly '</script>";
  } else{
    echo "<script>window.location.href='view-prime-listing?errmsg=Something went error!Try again later'</script>";
  }
} ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Edit Business List</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Tables</a>
                  </li>
                  <li class="breadcrumb-item active">Edit Business List
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Basic Tables start -->
          <!-- Table head options with primary background start -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Edit Business List</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="sucmsg" style="display: none;text-align: center;"></div>
                <div class="card-content collapse show">
                  <div class="col-lg-6 col-lg-offset-3">
                    <?php if(isset($_GET['sucmsg'])){ ?>
                        <p style="color: green;"><i class="fa fa-check"></i><?= $_GET['sucmsg']; ?></p>
                    <?php } else if(isset($_GET['errmsg'])){ ?>
                        <p style="color: red;"><i class="fa fa-times"></i><?= $_GET['errmsg']; ?></p>
                    <?php } ?>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <input type="text" name="search_ajax" id="search_ajax" class="form-control bd-search" placeholder="Search ..." onkeyup="search_ajax()">
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="bg-primary white">
                        <tr>
                          <th>#</th>
                          <th>Business Name</th>
                          <th>Business Contact</th>
                          <th>Edit Action</th>
                          <th>Change Status</th>
                        </tr>
                      </thead>
                      <tbody class="main_show">
                        <?php $i = 1; 
                        $select_admin_prime1 = mysqli_query($conn,"SELECT * FROM `company_reg` ORDER BY id DESC ");
                        while($view_prime1 = mysqli_fetch_array($select_admin_prime1)){ ?>
                        
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $view_prime1['company_name']; ?></td>
                          <td><?= $view_prime1['contact_number']; ?> </td>
                          <td><a href="edit-list.php?edit_id=<?php echo $view_prime1['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></td>
                          <td><?php if($view_prime1['admin_approval'] == 1){ ?><button type="button" class="btn btn-sm btn-info" onclick="change_activity(0,<?= $view_prime1['id'] ?>)"> Active</button> <?php }else if($view_prime1['admin_approval'] == 0){ ?> <button type="button" onclick="change_activity(1,<?= $view_prime1['id'] ?>)" class="btn btn-sm btn-warning"> Deactive</button>
                            <?php } ?></td>
                        </tr>
                        <?php $i++; } ?>
                      </tbody>
                      <tbody id="ajax_show">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
<!-- Responsive tables end -->
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
<?php require_once "inc/footer.php"; ?>
<script type="text/javascript">
  function change_activity(activity,loc_id){
    // alert("test");
    $.ajax({
      url: 'ajax-list-status',
      type: 'POST',
      data: {activity:activity,loc_id:loc_id},
      dataType: 'json',
      success: function(event){
        if(event.no_error){
          $(".sucmsg").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
          window.setTimeout(function() {
              window.location.href = 'view-listing.php';
          }, 5000);
        }else if(event.main_error){
          $(".sucmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
        }
      }
    })
  }
  function search_ajax(){
     var search_value = $("#search_ajax").val();
     $.ajax({
       url:'ajax-search-list-d',
       type: 'post',
       data: {search_value:search_value},
       dataType: 'json',
       success: function(event){
         console.log(event);
         if(event.no_error){
          $(".main_show").hide();
          $("#ajax_show").empty();
          $("#ajax_show").append(event.no_error);
         }else if(event.main_error){
           
         }
       }
     })
   }
  $(function() {
    var jsArray = <?php echo json_encode($total_array); ?>;
    var availableTags = jsArray;
    $( "#search_ajax" ).autocomplete({
      source: availableTags
    });
  });
</script>