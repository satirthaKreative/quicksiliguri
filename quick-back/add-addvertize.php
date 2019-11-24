<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>
<?php error_reporting(0); ?>
<?php  
  if(isset($_POST['save_img'])){
    if($_FILES['promo_image']['size'] != 0){
       extract($_POST);
             $filemain = $_FILES['promo_image']['name'];
             $valid_ext = ['png','jpeg','jpg'];
             $location = "uploads/promotional/images/".$filemain;
             $file_extension = pathinfo($location, PATHINFO_EXTENSION);
             $file_extension = strtolower($file_extension);
             // Check extension
             if(in_array($file_extension,$valid_ext)){
               // Compress Image
              if(compressImage($_FILES['promo_image']['tmp_name'],$location,60)){
                $i_image = $filemain;
              }else{
                $i_image = '';
              }
            }
    }
    $promo_video = mysqli_real_escape_string($conn,$_POST['promo_video']);
    $pay_t = mysqli_real_escape_string($conn,$_POST['pay_t']);
    if(isset($filemain)){
      $insertAdvertize = mysqli_query($conn,"INSERT INTO `advertize` SET p_image = '".$filemain."', p_video = '".$promo_video."?autoplay=1',business_name = '".$_POST['business_name']."',owner_name = '".$_POST['owner_name']."', pay_type = '".$pay_t."' ");
    }else{
      $insertAdvertize = mysqli_query($conn,"INSERT INTO `advertize` SET p_video = '".$promo_video."?autoplay=1',business_name = '".$_POST['business_name']."',owner_name = '".$_POST['owner_name']."', pay_type = '".$pay_t."' ");
    }
    if($insertAdvertize){
      echo "<script>window.location.href='view-advertize.php'</script>";
    }else{
      $errmsg = "<p class='text_data' style='color:red;'><i class='fa fa-times'></i> Something went wrong ! Try again</p>";
    }
  }
  //compress image compress
  function compressImage($source, $destination, $quality) {

      $info = getimagesize($source);
      if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

      elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

      elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

      imagejpeg($image, $destination, $quality);
  }
?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Promotional Advertize</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Form</a>
                  </li>
                  <li class="breadcrumb-item active"><a href="#">Add Advertize</a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Basic form layout section start -->
<section id="horizontal-form-layouts">
  <div class="row">
      <div class="col-xl-8 col-lg-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title" id="horz-layout-basic">Advertize</h4>
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
                      <form class="form form-horizontal" id="cate-form" method="post" enctype="multipart/form-data">
                        <div class="form-body">                         

                            <h4 class="form-section"><i class="ft-clipboard"></i> Promotional Advertize Details</h4>
                            <?php if(isset($errmsg)){
                              echo $errmsg;
                            } ?>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput5">Business Name</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput5" class="form-control form_cate" placeholder="Business Name" name="business_name" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput5">Owner Name</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput5" class="form-control form_cate" placeholder="Owner Name" name="owner_name">
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput5">Promotional Banner</label>
                                <div class="col-md-9">
                                  <input type="file" id="projectinput5" class="form-control form_cate" name="promo_image">
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput5">Video link</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput5" class="form-control form_cate" placeholder="youtube video link" name="promo_video">
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput5">Payment Type</label>
                                <div class="col-md-9">
                                  <select name="pay_t" id="projectinput5" class="form-control form_cate" required="required">
                                    <option value="">Choose Payment Type</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Cash">Cash</option>
                                  </select>
                                </div>
                            </div>

                        </div>

                          <div class="form-actions right">
                              
                              <button type="submit" name="save_img" class="btn btn-primary">
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
  $(function(){
    window.setTimeOut(function(){
      $(".text_data").hide();
    },3000)
  })
</script>