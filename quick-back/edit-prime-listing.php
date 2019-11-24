<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>
<?php if(isset($_GET['cate_name'])){
  $getCate = explode('1A01',$_GET['cate_name']);
  $query_id = $getCate[0];
  $selectloc = mysqli_query($conn,"SELECT * FROM `prime_listing` WHERE id = '".$query_id."' ");
  $fetchloc = mysqli_fetch_array($selectloc);
} ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Prime Plans Forms</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Form</a>
                  </li>
                  <li class="breadcrumb-item active"><a href="#">Add Prime Plans</a>
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
                  <h4 class="card-title" id="horz-layout-basic">Prime Plans</h4>
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
                      <form class="form form-horizontal" id="cate-form">
                        <div class="form-body">                         

                            <h4 class="form-section"><i class="ft-clipboard"></i> prime Details</h4>
                            <input type="hidden" name="prime_id" value="<?= $query_id; ?>">
                            <div class="location_group">
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput5">prime listing</label>
                                  <div class="col-md-9">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <input type="number" id="projectinput5" class="form-control form_cate" placeholder="No of Months" name="prime_months" value="<?= $fetchloc['prime_months'] ?>" min=1>
                                        <p>* Prime Plans in months</p>
                                      </div>
                                      <div class="col-md-6">
                                        <input type="text" id="projectinput5" class="form-control form_cate" placeholder="amount" value="<?= $fetchloc['prime_pay'] ?>" name="prime_pay">
                                        <p>* Price of Plans</p>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>

                          <div class="form-actions right">
                              
                              <button type="button" onclick="submit_location();" name="location_submit" class="btn btn-primary">
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
  function submit_location(){
    $.ajax({
      url: 'ajax-prime-edit',
      type: 'post',
      data: $("#cate-form").serialize(),
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

 
</script>