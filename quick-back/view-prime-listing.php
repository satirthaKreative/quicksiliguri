<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>
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
            <h3 class="content-header-title">Prime Listing</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Tables</a>
                  </li>
                  <li class="breadcrumb-item active">Listing Tables
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
                  <h4 class="card-title">Prime Listing</h4>
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
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="bg-primary white">
                        <tr>
                          <th>#</th>
                          <th>Prime plans</th>
                          <th>Prime Cost</th>
                          <th>Prime Plan Status</th>
                          <th>Admin Action</th>
                          <th>Change Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; while($view_prime = mysqli_fetch_array($select_admin_prime)){ ?>
                        
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $view_prime['prime_months']; ?> months</td>
                          <td><?= $view_prime['prime_pay']; ?> </td>
                          <td><?php if($view_prime['status'] == 1){ ?><a href="#" class="text-success text-bold">Active</a> <?php }else if($view_prime['status'] == 0){ ?> <a href="#" class="text-danger text-bold">Deactive</a>
                            <?php } ?></td>
                          <td><a href="edit-prime-listing.php?cate_name=<?php echo $view_prime['id']."1A01".$view_prime['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> <!-- <a href="view-prime-listing.php?cate_name=<?php echo $view_prime['id']."1A01".$view_prime['id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a> --> <!-- <a href="view-category.php?cate_name=<?php echo $view_admin_category['id']."1A01".$view_admin_category['id']; ?>" onclick="confirm('Are u sure to change the status ?')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a> --></td>
                          <td><?php if($view_prime['status'] == 1){ ?><button type="button" class="btn btn-sm btn-warning" onclick="change_activity(0,<?= $view_prime['id'] ?>)">Change To Deactive</button> <?php }else if($view_prime['status'] == 0){ ?> <button type="button" onclick="change_activity(1,<?= $view_prime['id'] ?>)" class="btn btn-sm btn-info">Change To Active</button>
                            <?php } ?></td>
                        </tr>
                        <?php $i++; } ?>
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
      url: 'ajax-prime-status',
      type: 'POST',
      data: {activity:activity,loc_id:loc_id},
      dataType: 'json',
      success: function(event){
        if(event.no_error){
          $(".sucmsg").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
          window.setTimeout(function() {
              window.location.href = 'view-prime-listing.php';
          }, 5000);
        }else if(event.main_error){
          $(".sucmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
        }
      }
    })
  }
</script>