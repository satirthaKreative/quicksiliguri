<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>
<!-- <?php $links = $_SERVER['PHP_SELF']; echo $links."fgyrwuyergfuyyf bfyucewgfrbvgeyrfywenxfywgefywgufycrgwefr"; ?> -->
<?php $select_category = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `category` ON listing_details.property_type = category.id WHERE category.category_name = '".$_GET['category']."' ");  
?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title"><?= $_GET['category']; ?> List</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Tables</a>
                  </li>
                  <li class="breadcrumb-item active"><?= $_GET['category']; ?> List
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
                  <h4 class="card-title"><?= $_GET['category']; ?> List</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <input type="text" name="search_ajax" id="search_ajax" class="form-control bd-search" placeholder="Search ..." onkeyup="search_ajax('<?= $_GET['category']; ?>')">
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table" >
                      <thead class="bg-primary white">
                        <tr>
                          <th>#</th>
                          <th><?= $_GET['category']; ?> Image</th>
                          <th><?= $_GET['category']; ?> Name</th>
                          <th><?= $_GET['category']; ?> Address</th>
                          <th><?= $_GET['category']; ?> Price</th>
                          <th>Added By</th>
                        </tr>
                      </thead>
                      <tbody class="main_show">
                        <?php 
                        $review_admin1 = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `category` ON listing_details.property_type = category.id INNER JOIN company_reg ON company_reg.id = listing_details.user_id WHERE category.category_name like '%".$_GET['category']."%' ");
                        $total_data = mysqli_num_rows($review_admin1);
                        if($total_data>0){
                        $page_view = 5;
                        $total_page = ceil($total_data/$page_view); 
                        if(isset($_GET['pages'])){
                          $pages = $_GET['pages'];
                        }else{
                          $pages = 1;
                        }
                        $total_pages = ceil($total_data/$page_view);
                        //echo "SELECT * FROM `customer_reviews` INNER JOIN listing_details ON customer_reviews.property_id = listing_details.id LIMIT ".($pages-1)*$page_view.", ".$page_view." ";
                        $review_admin = mysqli_query($conn,"SELECT * FROM `listing_details` INNER JOIN `category` ON listing_details.property_type = category.id INNER JOIN company_reg ON company_reg.id = listing_details.user_id WHERE category.category_name like '%".$_GET['category']."%' LIMIT ".($pages-1)*$page_view.", ".$page_view." ");
                        $j = 1;

                        while($fetch_re_admin = mysqli_fetch_array($review_admin)){ 

                         ?>
                        <tr>
                          <th scope="row"><?= $j; ?></th>
                          <td><img src="../user/uploads/property/<?= $fetch_re_admin['property_image']; ?>" width="200px;"></td>
                          <td ><?= $fetch_re_admin['property_name']; ?></td>
                          <td><?= $fetch_re_admin['property_address']; ?></td>
                          <td>&#x20b9; <?= $fetch_re_admin['property_price']; ?></td>
                          <td><?= $fetch_re_admin['company_name']; ?></td>
                        </tr>
                        <?php $j++; } }else{ ?>
                          <tr>
                            <th colspan="6" id="star-yellow"><i class="fa fa-times"></i> No data available</th>
                          </tr>
                        <?php } ?>
                      </tbody>
                      <tbody id="ajax_show">
                        
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>
            </div>
              <div class="col-12 main_show">
                <div style="text-align: center;">

                  <?php if($total_data>0){ for ($i=1; $i <= $total_page; $i++) {  ?><a href="property-view?pages=<?= $i; ?>&category=<?= $_GET['category']; ?>" <?php if($pages==$i){ ?> class="active" <?php } ?> id="page_id"><?= $i; ?></a> &nbsp;
                  <?php } } ?>
                </div>
              </div>
          </div>
<!-- Responsive tables end -->
        </div>
      </div>
    </div>
    <style type="text/css"> 
      #star-yellow{ color: #ffc600 !important; text-align: center!important;}
      #page_id{ padding: 9px;background: blue;border-radius: 50px;color: #fff; }
      .active{ background:#18aa4e; }
    </style>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
<?php require_once "inc/footer.php"; ?>
<script type="text/javascript">
  $(document).ready( function () {
      $('#myTable').DataTable();
  } );
  function search_ajax(category){
    // alert(category);
    var search_value = $("#search_ajax").val();
    $.ajax({
      url:'ajax-search-business-cate',
      type: 'post',
      data: {search_value:search_value,category:category},
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