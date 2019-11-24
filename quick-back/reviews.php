<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>
<?php 
$total_array = []; $select_array = mysqli_query($conn,"SELECT * FROM `listing_details` "); 
while($fetch_array = mysqli_fetch_array($select_array)){
      $total_array[] = $fetch_array['property_name'];
}
?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Reviews</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Tables</a>
                  </li>
                  <li class="breadcrumb-item active">Review Tables
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
                  <h4 class="card-title">Reviews</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>
                <input type="hidden" name="data_list_prop" id="data_list_prop" value="<?= $data_list_prop; ?>">
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6 ui-widget">
                        <input type="text" name="search_ajax" id="search_ajax" class="form-control bd-search" placeholder="Search property ..." > 
                      </div>
                      <input type="hidden" name="">
                      <div class="col-2">
                        <input type="text" placeholder="from date" name="datepicker1" class="datepicker form-control bd-search" id="datepicker1">
                      </div>
                      <div class="col-2">
                        <input type="text" placeholder="end date" name="datepicker2" class="datepicker form-control bd-search" id="datepicker2">
                      </div>
                      <div class="col-2">
                        <input type="button" class="btn btn-info" name="submit_ajax_form" value="submit" onclick="search_ajax()">
                      </div>

                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table" >
                      <thead class="bg-primary white">
                        <tr>
                          <th>#</th>
                          <th>Reviewer</th>
                          <th>Reviews</th>
                          <th>Review Rating</th>
                          <th>Mail Address</th>
                          <th>Property Name</th>
                          <!-- <th>Customer Id</th> -->
                          <!-- <th>Review Status</th> -->
                          <!-- <th>Admin Action</th> -->
                        </tr>
                      </thead>
                      <tbody id="main_div">
                        <?php 
                        $review_admin1 = mysqli_query($conn,"SELECT * FROM `customer_reviews` INNER JOIN listing_details ON customer_reviews.property_id = listing_details.id ");
                        $total_data = mysqli_num_rows($review_admin1);
                        $page_view = 25;
                        $total_page = ceil($total_data/$page_view); 
                        if(isset($_GET['pages'])){
                          $pages = $_GET['pages'];
                        }else{
                          $pages = 1;
                        }
                        $total_pages = ceil($total_data/$page_view);
                        $review_admin = mysqli_query($conn,"SELECT * FROM `customer_reviews` INNER JOIN listing_details ON customer_reviews.property_id = listing_details.id LIMIT ".($pages-1)*$page_view.", ".$page_view." ");
                        $j = 1;

                        while($fetch_re_admin = mysqli_fetch_array($review_admin)){ 

                         ?>
                        <tr>
                          <th scope="row"><?= $j; ?></th>
                          <td><?= $fetch_re_admin['customer_name']; ?></td>
                          <td style="width: 50%"><?= $fetch_re_admin['customer_review']; ?></td>
                          <td><?php for($i=1;$i<=$fetch_re_admin['customer_rating'];$i++){ ?> <i class="fa fa-star" id="star-yellow"></i> <?php } ?><?php for($i=1;$i<=(5-$fetch_re_admin['customer_rating']);$i++){ ?> <i class="fa fa-star"></i> <?php } ?></td>
                          <td><?= $fetch_re_admin['customer_email']; ?></td>
                          <td><?= $fetch_re_admin['property_name']; ?></td>
                        </tr>
                        <?php $j++; } ?>
                        
                      </tbody>
                      <tbody id="show_ajax" style="display: none;">
                        
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>
            </div>
              <div class="col-12">
                <div style="text-align: center;">
                  <?php for ($i=1; $i <= $total_page; $i++) {  ?><a href="reviews?pages=<?= $i; ?>" <?php if($pages==$i){ ?> class="active" <?php } ?> id="page_id"><?= $i; ?></a> &nbsp;
                  <?php } ?>
                </div>
              </div>
          </div>
<!-- Responsive tables end -->
        </div>
      </div>
    </div>
    <style type="text/css"> 
      #star-yellow{ color: #ffc600; }
      #page_id{ padding: 9px;background: blue;border-radius: 50px;color: #fff; }
      .active{ background:#18aa4e; }
    </style>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
<?php require_once "inc/footer.php"; ?>
<script type="text/javascript">
  $(document).ready( function () {
      $('#myTable').DataTable();
  } );

  function search_ajax(){
    var search_ajax = $("#search_ajax").val();
    var datepicker1 = $("#datepicker1").val();
    var datepicker2 = $("#datepicker2").val();
    $.ajax({
      url: 'ajax-new-search',
      type: 'post',
      dataType: 'json',
      data:{search_ajax:search_ajax,datepicker1:datepicker1,datepicker2:datepicker2,reviews:1},
      success: function(event){
        console.log(event);
        if(event.no_error){
          $("#main_div").hide();
          $("#show_ajax").show();
          $("#show_ajax").empty();
          $("#show_ajax").append(event.no_error);
        }else if(event.main_error){
          $("#main_div").hide();
          $("#show_ajax").show();
          $("#show_ajax").empty();
          $("#show_ajax").append(event.main_error);
        }else{
          $("#show_ajax").empty();
          $("#show_ajax").hide();
          $("#main_div").show();
        }
      }
    })
  }
  function data_choose(data){
    var data1 = data.value;
    $("#search_ajax").val(data1);
    $(".auto_fill_div").hide();
  }
  $(function() {
    var jsArray = <?php echo json_encode($total_array); ?>;
    var availableTags = jsArray;
    $( "#search_ajax" ).autocomplete({
      source: availableTags
    });
  });
</script>
