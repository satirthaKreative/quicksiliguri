<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>

<?php 
$selectEditCompany = mysqli_query($conn,"SELECT * FROM `company_reg` WHERE id = '".$_GET['edit_id']."' "); 
$fetchEditCompany = mysqli_fetch_array($selectEditCompany);
?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Listing Details</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Form</a>
                  </li>
                  <li class="breadcrumb-item active"><a href="#">Edit Listing</a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Basic form layout section start -->
<section id="horizontal-form-layouts">
  <div class="row">
      <div class="col-xl-10 col-lg-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title" id="horz-layout-basic">Edit Listing</h4>
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

                            <h4 class="form-section"><i class="ft-clipboard"></i>Edit Listing Details</h4>

                            <div class="location_group">
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput5">Business Listing</label>
                                  <div class="col-md-7">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <input type="hidden" name="business_id" value="<?= $_GET['edit_id']; ?>">
                                        <input type="text" id="projectinput5" class="form-control form_cate" placeholder="business name" value="<?= $fetchEditCompany['company_name']; ?>" name="business_name">
                                      </div>
                                      <div class="col-md-5">
                                        <input type="text" id="projectinput5" class="form-control form_cate" placeholder="business contact"  value="<?= $fetchEditCompany['contact_number']; ?>" name="business_contact">
                                      </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>

                          <div class="form-actions right">
                              
                              <button type="button" onclick="submit_prime();" name="location_submit" class="btn btn-primary">
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
  function submit_prime(){
    $.ajax({
      url: 'ajax-list-edit',
      type: 'post',
      data: $("#cate-form").serialize(),
      dataType: 'json',
      success: function(event){
        if(event.no_error){
          $(".sucmsg").html("<b style='color:green'>"+event.no_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
          setTimeout(function(){
            location.reload();
          },2000)
        }else if(event.main_error){
          $(".sucmsg").html("<b style='color:red'>"+event.main_error+"</b>").fadeIn().delay(5000).fadeOut('slow');
        }
      }
    })
  }

  function add_prime_member(){
    // alert('test');
    var prime_id = 1;
    $(".location_group").append('<div class="form-group row" id="prime'+prime_id+'"><label class="col-md-3 label-control" for="projectinput5">Business Listing</label><div class="col-md-7"><div class="row"><div class="col-md-6"><input type="text" id="projectinput5" class="form-control form_cate" placeholder="business name" name="business_name[]"></div><div class="col-md-5"><input type="text" id="projectinput5" class="form-control form_cate" placeholder="business contact" name="business_contact[]"></div></div></div><div class="col-md-2"><button type="button" class="btn btn-sm btn-info" onclick="add_prime_member()"><i class="fa fa-plus"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove_prime('+prime_id+')"><i class="fa fa-times"></i></button></div></div>');
    prime_id = prime_id + 1;
  }

  function remove_prime(data){
    $("#prime"+data).remove();
  }
</script>