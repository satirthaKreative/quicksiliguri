<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>
<?php if(isset($_GET['cate_name'])){
  $getCate = explode('1A01',$_GET['cate_name']);
  $query_id = $getCate[0];
  $selectlocation = mysqli_query($conn,"DELETE FROM `location` WHERE id = '".$query_id."' ");
  if($selectlocation){
    echo "<script>window.location.href='view-location?sucmsg=Data deleted successfuly '</script>";
  } else{
    echo "<script>window.location.href='view-location?errmsg=Something went error!Try again later'</script>";
  }
} ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Free Listing</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Tables</a>
                  </li>
                  <li class="breadcrumb-item active">Free Listing Tables
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
                  <h4 class="card-title">Free Listing</h4>
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
                          <th>Membership Plan</th>
                          <th>Premium Member</th>
                          <th>Business Status</th>
                          <!-- <th>Admin Action</th> -->
                          <th>Change Status</th>
                        </tr>
                      </thead>
                      <tbody class="main_show">
                        <?php $i = 1;
                        $review_admin1 = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE prime_id = 0 OR prime_id = null ORDER BY id DESC ");
                        $total_data = mysqli_num_rows($review_admin1);
                        $page_view = 5;
                        $total_page = ceil($total_data/$page_view); 
                        if(isset($_GET['pages'])){
                          $pages = $_GET['pages'];
                        }else{
                          $pages = 1;
                        }
                        $total_pages = ceil($total_data/$page_view);
                        $select_business_list = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE prime_id = 0 OR prime_id = null ORDER BY id DESC LIMIT ".($pages-1)*$page_view.", ".$page_view." ");
                         while($fetch_company_list = mysqli_fetch_array($select_business_list)){ 
                          $select_plan_id = mysqli_query($conn,"SELECT * FROM `prime_listing` WHERE prime_months = '".$fetch_company_list['prime_id']."' ");
                          $fetch_plan_name = mysqli_fetch_array($select_plan_id);

                          ?>
                        
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $fetch_company_list['company_name']; ?></td>
                          
                          <td><?php if($fetch_company_list['prime_id']!=0){ echo $fetch_plan_name['prime_months']." months"; }else{ echo "FREE LISTING"; } ?></td>
                          <td>
                            <!-- for checking -->
                            <input type="checkbox" name="make_premium" class="make_premium" onchange="premium_state(this,<?= $fetch_company_list['id'] ?>);" /> <br>(Checked to make a premium member) <br>
                            <!-- for months -->
                            

                          </td>
                          <td><?php if($fetch_company_list['status'] == 1){ ?><a href="javascript:;" class="text-success text-bold">Active</a> <?php }else if($fetch_company_list['status'] == 0){ ?> <a href="javascript:;" class="text-danger text-bold">Deactive</a>
                            <?php } ?></td>
                          <td><?php if($fetch_company_list['status'] == 1){ ?><button type="button" class="btn btn-sm btn-warning" onclick="change_activity(0,<?= $fetch_company_list['id'] ?>)">Change To Deactive</button> <?php }else if($fetch_company_list['status'] == 0){ ?> <button type="button" onclick="change_activity(1,<?= $fetch_company_list['id'] ?>)" class="btn btn-sm btn-info">Change To Active</button>
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
            <div class="col-12 main_show" >
              <div style="text-align: center;">
                <?php for ($i=1; $i <= $total_page; $i++) {  ?><a href="free-listing?pages=<?= $i; ?>" <?php if($pages==$i){ ?> class="active" <?php } ?> id="page_id"><?= $i; ?></a> &nbsp;
                <?php } ?>
              </div>
            </div>
          </div>
<!-- Responsive tables end -->
        
        <!-- modal open -->

        <!-- Modal -->
        <!-- The Modal -->
          <div class="modal" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
              
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Premium Membership</h4>
                  <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                  <form id="premium_plans">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Choose a plan</label>
                      <input type="hidden" id="plan_id" name="plan_id">
                      <select class="form-control" name="premium_months" id="premium_months" required="">
                        <option value="">Choose A Plan</option>
                        <?php $premium_plans = mysqli_query($conn,"SELECT * FROM `prime_listing` ORDER BY prime_months ASC ");
                              while($fetch_premium_plans = mysqli_fetch_array($premium_plans)){ ?>
                          <option value="<?= $fetch_premium_plans['prime_months']; ?>"><?= $fetch_premium_plans['prime_months']." months plan"; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Choose payment type</label>
                      <select class="form-control" name="payment_types" id="payment_types" >
                        <option value="">Choose payment Type</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Cash">Cash</option>
                        <option value="Online Payment">Online Payment</option>
                      </select>
                    </div>
                    <button type="button" onclick="submit_payment_details();" class="btn btn-primary">Submit</button> <button type="button" onclick="force_modal_close();" class="btn btn-danger">Close</button>
                    <p id="sucerr"></p>
                  </form>
                </div>
              </div>
            </div>
          </div>

        <!-- modal close -->
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
<?php require_once "inc/footer.php"; ?>
<script type="text/javascript">
  function change_activity(activity,loc_id){
    // alert("test");
    $.ajax({
      url: 'ajax-company-status',
      type: 'POST',
      data: {activity:activity,loc_id:loc_id},
      dataType: 'json',
      success: function(event){
        if(event.no_error){
          $(".sucmsg").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(1000).fadeOut('slow');
          window.setTimeout(function() {
              window.location.href = 'free-listing.php';
          }, 1000);
        }else if(event.main_error){
          $(".sucmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(1000).fadeOut('slow');
        }
      }
    })
  }
  // function listing
  $(function(){
    $("#myModal").modal('hide');
  })
  function submit_payment_details(){
    $.ajax({
      url:'ajax-premium-membership',
      type: 'post',
      data: $("#premium_plans").serialize(),
      dataType: 'json',
      success: function(event){
        console.log(event);
        if(event.no_error){
          $("#sucerr").html("<b style='color:green;'>"+event.no_error+"</b>").fadeIn().delay(1000).fadeOut('slow');
          // redirecting ...
          window.setTimeout(function() {
              window.location.href = "free-listing.php";
          }, 1000);
        }else if(event.main_error){
          $("#sucerr").html("<b style='color:red;'>"+event.main_error+"</b>").fadeIn().delay(3000).fadeOut('slow');
        }
      }
    })
  }
  function premium_state(checkbox,premium_list){
    if(checkbox.checked == true){
      $("#plan_id").val(premium_list);
      $("#myModal").modal('show');
    }else{

    }
  }
  function force_modal_close(){
    $(".make_premium").prop("checked", false);
    $("#myModal").modal('hide');
  }
  function search_ajax(){
    var search_value = $("#search_ajax").val();
    $.ajax({
      url:'ajax-search-free',
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
</script>