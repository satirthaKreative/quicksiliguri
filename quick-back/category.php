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
      <div class="col-xl-6 col-lg-12">
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
                      <form class="form form-horizontal">
                        <div class="form-body">                         

                <h4 class="form-section"><i class="ft-clipboard"></i> Project Details</h4>

                            <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput5">Company</label>
                  <div class="col-md-9">
                                  <input type="text" id="projectinput5" class="form-control" placeholder="Company Name" name="company">
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Interested in</label>
                              <div class="col-md-9">
                                  <select id="projectinput6" name="interested" class="form-control">
                                      <option value="none" selected="" disabled="">Interested in</option>
                                      <option value="design">design</option>
                                      <option value="development">development</option>
                                      <option value="illustration">illustration</option>
                                      <option value="branding">branding</option>
                                      <option value="video">video</option>
                                  </select>
                                </div>
                            </div>
 -->
                            <!-- <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput7">Budget</label>
                              <div class="col-md-9">
                                  <select id="projectinput7" name="budget" class="form-control">
                                      <option value="0" selected="" disabled="">Budget</option>
                                      <option value="less than 5000$">less than 5000$</option>
                                      <option value="5000$ - 10000$">5000$ - 10000$</option>
                                      <option value="10000$ - 20000$">10000$ - 20000$</option>
                                      <option value="more than 20000$">more than 20000$</option>
                                  </select>
                                </div>
                            </div> -->

                <div class="form-group row">
                  <label class="col-md-3 label-control">Select File</label>
                  <div class="col-md-9">
                    <label id="projectinput8" class="file center-block">
                      <input type="file" id="file">
                      <span class="file-custom"></span>
                    </label>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput9">About Project</label>
                  <div class="col-md-9">
                    <textarea id="projectinput9" rows="5" class="form-control" name="comment" placeholder="About Project"></textarea>
                  </div>
                </div>
              </div>

                          <div class="form-actions right">
                              
                              <button type="submit" class="btn btn-primary">
                                  <i class="la la-check-square-o"></i> Save
                              </button>
                          </div>
                      </form>
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