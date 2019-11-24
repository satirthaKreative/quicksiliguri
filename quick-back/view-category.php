<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>
<?php if(isset($_GET['cate_name'])){
  $getCate = explode('1A01',$_GET['cate_name']);
  $query_id = $getCate[0];
  $selectCategory = mysqli_query($conn,"DELETE FROM `category` WHERE id = '".$query_id."' ");
  if($selectCategory){
    echo "<script>window.location.href='view-category?sucmsg=Data deleted successfuly '</script>";
  } else{
    echo "<script>window.location.href='view-category?errmsg=Something went error!Try again later'</script>";
  }
} 
?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Category</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Tables</a>
                  </li>
                  <li class="breadcrumb-item active">Category Tables
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
                  <h4 class="card-title">Category</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="col-lg-6 col-lg-offset-3">
                    <?php if(isset($_GET['sucmsg'])){ ?>
                        <p style="color: green;" class="suc_err"><i class="fa fa-check"></i><?= $_GET['sucmsg']; ?></p>
                    <?php } else if(isset($_GET['errmsg'])){ ?>
                        <p style="color: red;" class="suc_err"><i class="fa fa-times"></i><?= $_GET['errmsg']; ?></p>
                    <?php } ?>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <input type="text" name="search_ajax" id="search_ajax" class="form-control bd-search" placeholder="Search Category..." onkeyup="check_auto_cate();"> 
                        <div class="auto_fill_div" style="display: none;">
                          
                        </div>
                      </div>
                      <div class="col-2">
                        <input type="button" class="btn btn-info" name="submit_ajax_form" value="submit" onclick="search_ajax()">
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="bg-primary white">
                        <tr>
                          <th>#</th>
                          <th>Category Name</th>
                          <th>Category Details</th>
                          <!-- <th>Category Icons</th> -->
                          <th>Admin Action</th>
                        </tr>
                      </thead>
                      <tbody id="main_div">
                        <?php $i = 1; while($view_admin_category = mysqli_fetch_array($select_admin_category)){ ?>
                        
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $view_admin_category['category_name']; ?></td>
                          <td><?= $view_admin_category['category_about']; ?></td>
                          <td><a href="edit-category.php?cate_name=<?php echo $view_admin_category['id']."1A01".$view_admin_category['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> <a href="view-category.php?cate_name=<?php echo $view_admin_category['id']."1A01".$view_admin_category['id']; ?>" onclick="return confirm('Are u sure to delete that category ?')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>
                        </tr>
                        <?php $i++; } ?>
                      </tbody>
                      <tbody id="show_ajax" style="display: none;">
                        
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
  $(function(){
    window.setTimeout(function(){
      $(".suc_err").hide();
    },2000);
  })
  function search_ajax(){
    var search_ajax = $("#search_ajax").val()
    $.ajax({
      url: 'ajax-cate-search',
      type: 'post',
      dataType: 'json',
      data:{search_ajax:search_ajax},
      success: function(event){
        console.log(event);
        if(event.no_error){
          $("#main_div").hide();
          $("#show_ajax").show();
          $("#show_ajax").empty();
          $("#show_ajax").append(event.no_error);
        }else{
          $("#show_ajax").empty();
          $("#show_ajax").hide();
          $("#main_div").show();
        }
      }
    })
  }
  function check_auto_cate(){
    var auto_fill_div = $("#search_ajax").val();
    //alert(auto_fill_div);
    $.ajax({
      url:'auto-com-page',
      type:'post',
      dataType:'json',
      data: {auto_fill_div:auto_fill_div},
      success: function(event){
        console.log(event);
        if(event.no_error){
          $(".auto_fill_div").show();
          $(".auto_fill_div").empty();
          $(".auto_fill_div").append(event.no_error);
        }else{
          $(".auto_fill_div").hide();
          $(".auto_fill_div").empty();
        }
      }
    })
  }
  function data_choose(data){
    var data1 = data.value;
    console.log(data1);
    $("#search_ajax").val(data1);
    $(".auto_fill_div").hide();
  }
</script>