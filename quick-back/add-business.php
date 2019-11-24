<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>
<?php 
if(isset($_POST['save'])){ 
  $check_exist = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE contact_number = '".mysqli_real_escape_string($conn,$_POST['contact_no'])."' AND company_name = '".mysqli_real_escape_string($conn,$_POST['business_name'])."' ");
  if(mysqli_num_rows($check_exist)<1){
  $start_date = date('Y-m-d');
  $end_date =  date('Y-m-d', strtotime("+3 months", strtotime($start_date)));
  $insertQuery = mysqli_query($conn,"INSERT INTO `company_reg` SET company_name = '".mysqli_real_escape_string($conn,$_POST['business_name'])."', contact_person = '".mysqli_real_escape_string($conn,$_POST['contact'])."', contact_number = '".mysqli_real_escape_string($conn,$_POST['contact_no'])."', prime_id = '".mysqli_real_escape_string($conn,$_POST['business_prime'])."', prime_start_date = '".mysqli_real_escape_string($conn,$start_date)."', prime_end_date = '".mysqli_real_escape_string($conn,$end_date)."',payment_mode = '".mysqli_real_escape_string($conn,$_POST['Payment_type'])."' ");
    $last_id = mysqli_insert_id($conn);
    if($_FILES['user_image']['size']!=0){
      extract($_POST);
      $filemain = $_FILES['user_image']['name'];
      $valid_ext = ['png','jpeg','jpg'];
      $location = "../user/uploads/property/".$filemain;
      $file_extension = pathinfo($location, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);
      // Check extension
      if(in_array($file_extension,$valid_ext)){
        // Compress Image
        if(compressImage($_FILES['user_image']['tmp_name'],$location,60)){
            $business_details = mysqli_query($conn,"INSERT INTO `listing_details` SET user_id = '".$last_id."', property_name = '".$_POST['business_name']."', `property_type`='".$_POST['business_type']."',`property_address`='".mysqli_real_escape_string($conn,$_POST['business_address'])."',`property_details`='".mysqli_real_escape_string($conn,$_POST['business_details'])."',`property_price`='".mysqli_real_escape_string($conn,$_POST['business_price'])."',`property_open_time`='".mysqli_real_escape_string($conn,$_POST['business_open'])."',`property_image`='".$filemain."',`map_links`='".mysqli_real_escape_string($conn,$_POST['business_map'])."',`property_close_time`='".mysqli_real_escape_string($conn,$_POST['business_close'])."' "); 
          }
        }
    }// multiple image upload

    if($_FILES['files']['size'] != 0){
      extract($_POST);
      $valid_ext = ['png','jpeg','jpg'];
      foreach($_FILES['files']['name'] as $key=>$val){
        $filename = $_FILES['files']['name'][$key];
      // Location
      $location = "../user/uploads/property/other_property/".$filename;

      // file extension
      $file_extension = pathinfo($location, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);

      // Check extension
      if(in_array($file_extension,$valid_ext)){

        // Compress Image
        if(compressImage($_FILES['files']['tmp_name'][$key],$location,60)){
          $fetch_last_id = mysqli_query($conn,"SELECT * FROM `listing_details` ORDER BY id DESC LIMIT 1 ");
          $fetch_list = mysqli_fetch_array($fetch_last_id);
          $insertOtherProperty = mysqli_query($conn,"INSERT INTO `property_images` SET `property_id` = '".$fetch_list."' , `property_images` = '".$filename."'  ");
            }
        }
      }
    }
  if($business_details){
    $msg = "Insert Successfully";
  }else{
    $errmsg = "Something went wrong ! Try again";
  }
  }else{
    $errmsg = "This Business alert registered !!!";
  } 
}
//compress image compress
  function compressImage($source, $destination, $quality) {

    $info = getimagesize($source);
    list($width,$height) = getimagesize($source);
    // echo $width;
    // echo $height;
    $max_width = 1280;
    $max_height = 720;
    if($width == $max_width && $height == $max_height ){
      if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

      elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

      elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

      imagejpeg($image, $destination, $quality);
      return true;
    }else{
      return false;
    }
  }
?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Business List Forms</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Form</a>
                  </li>
                  <li class="breadcrumb-item active"><a href="#">Add Business</a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Basic form layout section start -->
}
<section id="horizontal-form-layouts">
  <div class="row">
      <div class="col-xl-12 col-lg-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title" id="horz-layout-basic">Business Add</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                      <ul class="list-inline mb-0">
                          <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                          <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                          <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                          <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                      </ul>
                  </div>
              </div>
              <div class="card-content collpase show">
                  <div class="card-body">
            <div class="card-text">
              
            </div>
                      <form class="form form-horizontal" method="post" id="cate-form" enctype="multipart/form-data">
                          <div >
                            <?php if(isset($msg)){ echo '<p style="color:green;"><i class="fa fa-check"></i>' .$msg.'</p>'; }else if(isset($errmsg)){ echo '<p style="color:red;"><i class="fa fa-times"></i>' .$errmsg.'</p>'; } ?>
                          </div>
                          <div class="form-body">                         

                              <h4 class="form-section"><i class="ft-clipboard"></i> Business Details</h4>
                              <!-- contact name -->
                              <div class="row">
                                      <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12 col-xs-12">
                                      <!-- Business Type -->
                                      <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput5">Business Type<sup class="text-danger">*</sup></label>
                                          <div class="col-md-8">
                                            <select class="form-control" required="" name="business_type">
                                              <option value="">Choose a category</option>
                                              <?php while($fetch_business_category = mysqli_fetch_array($select_admin_category)){  ?>
                                              <option value="<?= $fetch_business_category[0]; ?>"><?= $fetch_business_category['category_name']; ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                      </div>
                                      <!-- business name -->
                                      <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput5">Business Name<sup class="text-danger">*</sup></label>
                                          <div class="col-md-8">
                                            <input type="text" id="projectinput5" class="form-control form_cate" placeholder="Business Name" required="required" name="business_name">
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput5">Contact Name</label>
                                          <div class="col-md-8">
                                            <input type="text" id="projectinput5" class="form-control form_cate" placeholder="contact Name" name="contact">
                                          </div>
                                      </div>
                                      <!-- contact number  -->
                                      <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput5">Contact Number<sup class="text-danger">*</sup></label>
                                          <div class="col-md-8">
                                            <input type="text" id="projectinput5" class="form-control form_cate" placeholder="contact number" name="contact_no">
                                          </div>
                                      </div>
                                      <!-- business category -->
                                      <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput5">Business Address</label>
                                          <div class="col-md-8">
                                            <input type="text" id="projectinput5" class="form-control form_cate" placeholder="Business Address" name="business_address">
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput9">Business Details</label>
                                          <div class="col-md-8">
                                            <textarea id="projectinput9" rows="5" class="form-control form_cate" name="business_details" placeholder="Business Details"></textarea>
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                        <label class="col-md-4 label-control" for="projectinput5">Upload Image<sup class="text-danger">*</sup></label>
                                          <div class="col-md-8">
                                            <input type="file" id="projectinput5" class="form-control form_cate" placeholder="Business main image" name="user_image" required="required">
                                            <small style="color: red;">* Size Must be (1280*720)</small><br/><small>* must add a property main image</small>
                                          </div>

                                      </div>

                                  </div>
                                <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12 col-xs-12">

                                  <div class="form-group row">
                                    <label class="col-md-4 label-control" for="projectinput5">Cost</label>
                                      <div class="col-md-8">
                                        <input type="number" id="projectinput5" class="form-control form_cate" placeholder="Business Cost" name="business_price">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-4 label-control" for="projectinput5">Business Open-On</label>
                                      <div class="col-md-8">
                                        <input type="time" id="projectinput5" class="form-control form_cate" placeholder="Business Open Timing" name="business_open">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-4 label-control" for="projectinput5">Business Close-On</label>
                                      <div class="col-md-8">
                                        <input type="time" id="projectinput5" class="form-control form_cate" placeholder="Business Close Timing" name="business_close">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-4 label-control" for="projectinput5">Map Address</label>
                                      <div class="col-md-8">
                                        <input type="text" id="projectinput5" class="form-control form_cate" placeholder="Business map address" name="business_map">
                                      </div>
                                  </div>
                                  <!-- Business Type -->
                                  <div class="form-group row">
                                    <label class="col-md-4 label-control" for="projectinput5">Choose a Plan</label>
                                      <div class="col-md-8">
                                        <select class="form-control" required="" name="business_prime">
                                          <option value="0">Free Listing</option>
                                          <?php while($fetch_admin_prime = mysqli_fetch_array($select_admin_prime)){  ?>
                                          <option value="<?= $fetch_admin_prime['prime_months']; ?>"><?= $fetch_admin_prime['prime_months']." months plan"; ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-4 label-control" for="projectinput5">Payment Type</label>
                                      <div class="col-md-8">
                                        <select class="form-control" required="" name="Payment_type">
                                          <option value="">Choose a category</option>
                                          <option value="Cheque">Cheque</option>
                                          <option value="Cash">Cash</option>
                                          <option value="Online Payment">Online Payment</option>
                                        </select>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-4 label-control" for="projectinput5">Upload Others Image</label>
                                      <div class="col-md-8">
                                        <input type="file" id="projectinput5" class="form-control form_cate" placeholder="Business main image" name="files[]" multiple="multiple">
                                        <small style="color: red;">* Size Must be (1280*720)</small><br/><small>* You can upload others photograph of your property</small>
                                      </div>
                                  </div>


                                </div>

                              </div>
                        </div>

                          <div class="form-actions right">
                              
                              <button type="submit" name="save" class="btn btn-primary">
                                  <i class="la la-check-square-o"></i> Save
                              </button>
                          </div>
                      </form>
                      <div class="sucmsg" style="display: none;text-align: center;"></div>
                  </div>
              </div>

          </div>

    </div>
  </div>
</section>
<!-- // Basic form layout section end -->
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    
<?php require_once "inc/footer.php"; ?>
<script type="text/javascript">
  function submit_category(){
    $.ajax({
      url: 'ajax-cate-add',
      type: 'post',
      data: $("#cate-form").serialize(),
      dataType: 'json',
      success: function(event){
        if(event.no_error){
          $(".sucmsg").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
          $(".form_cate").val('');
        }else if(event.main_error){
          $(".sucmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
        }
      }
    })
  }
</script>