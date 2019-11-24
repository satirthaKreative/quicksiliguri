<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>


    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Category Forms</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Form</a>
                  </li>
                  <li class="breadcrumb-item active"><a href="#">Add Category</a>
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
                  <h4 class="card-title" id="horz-layout-basic">Category</h4>
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

                            <h4 class="form-section"><i class="ft-clipboard"></i> Category Details</h4>

                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput5">Category</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput5" class="form-control form_cate" placeholder="Category Name" name="category">
                                </div>
                            </div>


                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput9">About Category</label>
                                <div class="col-md-9">
                                  <textarea id="projectinput9" rows="5" class="form-control form_cate" name="about_cate" placeholder="About Category"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput5">Category Icon</label>
                                <div class="col-md-9">
                                  <select name="cate_icon" id="select_d" class="form-control form_cate">
                                    <option value="">Choose a icon</option>
                                    <?php while($fetch_icon =mysqli_fetch_array($select_icon)): ?>
                                      <option value="<?= $fetch_icon['cate_icon']; ?>"><?= $fetch_icon['icon_value']; ?></option>
                                    <?php endwhile; ?>
                                  </select>
                                  <!-- <input type="text" id="projectinput5" class="form-control form_cate" placeholder="Category Name" name="category"> -->
                                </div>
                            </div>

                        </div>

                          <div class="form-actions right">
                              
                              <button type="button" class="btn btn-primary" onclick="submit_category()">
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
    $("#select_d").select2();
  })
</script>