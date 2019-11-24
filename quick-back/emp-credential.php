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
            <h3 class="content-header-title">Login Credential</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Tables</a>
                  </li>
                  <li class="breadcrumb-item active">Employee Login Credential
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
                  <h4 class="card-title">Credentials</h4>
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
                    <div class="col-6">
                      <button type="button" onclick="chng_log();" class="btn btn-primary">Change Login Credentials</button>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="bg-primary white">
                        <tr>
                          <th>#</th>
                          <th>User Name</th>
                          <th>Password</th>
                          <!-- <th>Admin Action</th>
                          <th>Change Status</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;$select_emp = mysqli_query($conn,"SELECT * FROM `admin` WHERE user_status = 0 "); while($view_location = mysqli_fetch_array($select_emp)){ ?>
                        
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $view_location['u_name']; ?></td>
                          <td><?= $view_location['u_org_pass'] ?></td>
                        </tr>
                        <?php $i++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal" id="myModal">
              <div class="modal-dialog">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Change Credentials</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <!-- Modal body -->
                  <div class="modal-body">
                    <form id="form_emp_credential">
                      <?php $select_emp1 = mysqli_query($conn,"SELECT * FROM `admin` WHERE user_status = 0 "); $fetch_emp = mysqli_fetch_array($select_emp1); ?>
                      <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username" value="<?= $fetch_emp['u_name'] ?>" name="u_name">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" value="<?= $fetch_emp['u_org_pass']; ?>" placeholder="Enter Password" name="u_pass">
                      </div>
                      <button type="button" onclick="change_credential();"  class="btn btn-primary">Submit</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                       <p class="sucmsg"></p>
                    </form>
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
  $(function(){
    $("#myModal").modal('hide');
  })
  function chng_log(){
    $("#myModal").modal('show');
  }
  function change_credential(){
    $.ajax({
      url: 'ajax-emp_credential',
      type: 'POST',
      data: $("#form_emp_credential").serialize(),
      dataType: 'json',
      success: function(event){
        console.log(event);
        if(event.no_error){
          $(".sucmsg").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(3000).fadeOut('slow');
          window.setTimeout(function() {
              window.location.href = 'emp-credential.php';
          }, 3000);
        }else if(event.main_error){
          $(".sucmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(3000).fadeOut('slow');
        }
      }
    })
  }
</script>