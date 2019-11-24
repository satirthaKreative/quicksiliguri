<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>
<?php
    if(isset($_SESSION['login_id'])){
      $dev_id = $_SESSION['login_id'];
    } else if(isset($_SESSION['emp_id'])){
      $dev_id = $_SESSION['emp_id'];
    }
    if(isset($_POST['profile_update'])){

      if($_POST['u_name'] == ''){
          $errmsg = "Enter a valid username";
          echo "<script>errFunc(".$errmsg.")</script>";
        } else if($_POST['u_address'] == ''){
          $errmsg = "Enter your valid address";
          echo "<script>errFunc(".$errmsg.")</script>";
        } else{
          if($_FILES['p_img']['size'] == 0){
            $update_profile_details = "UPDATE `admin` SET u_name = '".$_POST['u_name']."',  `u_quote` = '".mysqli_real_escape_string($conn,$_POST['u_quote'])."' , `u_address` = '".$_POST['u_address']."' WHERE id = '".$dev_id."' ";
            $exec_profile = mysqli_query($conn,$update_profile_details);
            if($exec_profile){
              $sucmsg = "Profile Details Updated Successfully"; 
              echo "<script>window.location.href='profile?sucmsg=".$sucmsg."'</script>"; 
            } else{
              $errmsg = "Something Went Wrong ! try again later";
              echo "<script>window.location.href='profile?errmsg=".$errmsg."'</script>"; 
            }
          } else{
            $newimg = uniqid().$_FILES['p_img']['name'];
            move_uploaded_file($_FILES['p_img']['tmp_name'], "uploads/".$newimg);
            $update_profile_details = "UPDATE `admin` SET u_name = '".$_POST['u_name']."', `u_img` = '".$newimg."' ,`u_quote` = '".mysqli_real_escape_string($conn,$_POST['u_quote'])."' , `u_address` = '".$_POST['u_address']."' WHERE id = '".$dev_id."' ";
            $exec_profile = mysqli_query($conn,$update_profile_details);
            if($exec_profile){
              $sucmsg = "Profile Details Updated Successfully";
              echo "<script>window.location.href='profile?sucmsg=".$sucmsg."'</script>"; 
            } else{
              $errmsg = "Something Went Wrong ! try again later";
              echo "<script>window.location.href='profile?errmsg=".$errmsg."'</script>"; 
            }
          }


        }
} ?> 

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body"><div id="user-profile">
  <div class="row">
    <div class="col-sm-12 col-xl-8">
      <div class="media d-flex m-1 ">
        <div class="align-left p-1">
          <a href="#" class="profile-image">
            <img src="uploads/<?php  if(isset($_SESSION['login_id']) || isset($_SESSION['emp_id'])){ echo $fetch_admin_profile['u_img']; } ?>" class="rounded-circle img-border height-100" alt="Card image">
          </a>
        </div>
        <div class="media-body text-left  mt-1">
          <h3 class="font-large-1 white"><?php if(isset($_SESSION['login_id'])){ echo $_SESSION['login_name']; }else if(isset($_SESSION['emp_id'])){ echo $_SESSION['emp_name']; } ?>
            <span class="font-medium-1 white"><?php if(isset($_SESSION['login_id'])){ echo "(admin)"; }else if(isset($_SESSION['emp_id'])){ echo "(employee)"; } ?></span>
          </h3>
          <p class="white">
            <i class="ft-map-pin white"> </i> <?php  if(isset($_SESSION['login_id'])){ echo $fetch_admin_profile['u_address']; } ?> </p>
          <p class="black text-bold-300 d-none d-sm-block "><?php  if(isset($_SESSION['login_id'])){ echo $fetch_admin_profile['u_quote']; } ?></p>
          


        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-9 col-lg-7 col-md-12">
      <!--Project Timeline div starts-->
      <div id="timeline">
        <div class="card">
          <div class="card-header">
            <div class="card-title-wrap bar-primary">
              <div class="card-title">Admin Credentials</div>
            </div>
          </div>
            <div class="col-xl-12 col-lg-12">
              <?php if(isset($_GET['sucmsg'])){ ?>
                <div class="alert alert-success">
                  <p><?= $_GET['sucmsg']; ?></p>
                </div>
              <?php } else if(isset($_GET['errmsg'])){ ?>
                <div class="alert alert-success">
                  <p><?= $_GET['errmsg']; ?></p>
                </div>
              <?php } ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="horz-layout-basic">Admin Profile</h4>
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
                    <!-- <p>This is one column basic horizontal form with labels on left and form controls on right in one line. Add <code>.form-horizontal</code> class to the form tag to have horizontal form styling. -->
                  </div>
                            <form class="form form-horizontal" action="" id="profile_details" enctype="multipart/form-data" method="post">
                              <div class="form-body">                         

                      <h4 class="form-section"><i class="ft-clipboard"></i> Profile Details</h4>
                                  <!-- <?php admin_profile($conn); echo $fetchProfile['u_name'];  ?> -->
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput5">Profile Name</label>
                                    <div class="col-md-9">
                                        <input type="text" id="projectinput5" class="form-control" placeholder="profile Name" name="u_name" value="<?php if(isset($_SESSION['login_name'])){
                                           echo $_SESSION['login_name'];
                                        }else if(isset($_SESSION['emp_name'])){
                                           echo $_SESSION['emp_name'];
                                        } ?>" required="required">
                                    </div>
                                  </div>
                                <div class="form-group row">
                                  <label class="col-md-3 label-control" for="projectinput5">Profile Address</label>
                                  <div class="col-md-9">
                                        <input type="text" id="projectinput5" class="form-control" placeholder="profile address" name="u_address" value="<?php  if(isset($_SESSION['login_id'])){ echo $fetch_admin_profile['u_address']; }else if(isset($_SESSION['emp_id'])){ echo $fetch_admin_profile['u_address']; } ?>" required="required">
                                  </div>
                                </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control">Profile Image</label>
                        <div class="col-md-9">
                          <label id="projectinput8" class="file center-block">
                            <input type="file" id="file" name="p_img">
                            <span class="file-custom"></span>
                          </label>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput9">Quote</label>
                        <div class="col-md-9">
                          <textarea id="projectinput9" rows="5" class="form-control" name="u_quote" placeholder="About You"><?php  if(isset($_SESSION['login_id'])){ echo $fetch_admin_profile['u_quote']; }else if(isset($_SESSION['emp_id'])){ echo $fetch_admin_profile['u_quote']; } ?></textarea>
                        </div>
                      </div>
                    </div>

                                <div class="form-actions right">
                                    <!-- <button type="button" class="btn btn-danger mr-1">
                                      <i class="ft-x"></i> Cancel
                                    </button> -->
                                    <button type="submit" class="btn btn-primary" id="profile_submit" name="profile_update">
                                        <i class="la la-check-square-o"></i> Save
                                    </button>
                                </div>
                            </form>
                          <form class="form form-horizontal" id="change_password">
                            <div class="form-body">                         

                    <h4 class="form-section"><i class="ft-clipboard"></i> Change Password</h4>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput5">New Password</label>
                                    <div class="col-md-9">
                                      <input type="password" id="projectinput5" class="form-control" placeholder="password" name="u_pass" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput5">Re-type Password</label>
                                    <div class="col-md-9">
                                      <input type="password" id="projectinput5" class="form-control" placeholder="confirm password" name="cu_pass" required="required">
                                    </div>
                                </div>

                              <div class="form-actions right">
                                  <!-- <button type="button" class="btn btn-danger mr-1">
                                    <i class="ft-x"></i> Cancel
                                  </button> -->
                                  <button type="button" class="btn btn-primary" onclick="change_pass()">
                                      <i class="la la-check-square-o"></i> Save
                                  </button>
                              </div>
                              <div class="sucmsg" style="display: none;text-align: center"></div>
                          </form>
                        </div>
                    </div>
                </div>
          </div>
        </div>
      </div>
      <!--Project Timeline div ends-->
    </div>
  </div>
</div>

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
</div>
<?php require_once "inc/footer.php"; ?>
<script type="text/javascript">
  function change_pass(){
    // alert('change password');
    $.ajax({
      url: 'ajax-change-pass',
      type: 'post',
      data: $("#change_password").serialize(),
      dataType: 'json',
      success: function(event){
        if(event.no_error){
          $(".sucmsg").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
        }else if(event.main_error){
          $(".sucmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
        }
      }
    })
  }

  function errFunc(data){
    $(".sucmsg").html("<b style='color:red'>"+data+"</b>").fadeIn().delay(5000).fadeOut('slow');
  }

  function sucFunc(data){
    $(".sucmsg").html("<b style='color:green'>"+data+"</b>").fadeIn().delay(5000).fadeOut('slow');
  }

</script>
<!-- <script type="text/javascript">
  $("#profile_details").submit(function(e){

            e.preventDefault();
            var formData = new FormData(this);
      alert('Profile Submit IN Ajax');
      $.ajax({
        url: 'ajax-change-profile.php',
        type: 'POST',
        data: formData,
        dataType: 'text',
        success: function(event){
          alert(event);
          if(event.no_error){
            $(".sucmsg").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
          }else if(event.main_error){
            $(".sucmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
          }
        }
      })

  })
</script> -->