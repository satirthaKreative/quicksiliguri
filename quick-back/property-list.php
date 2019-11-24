<?php require_once "inc/header.php"; ?>
<?php require_once "inc/nav.php"; ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Business Category</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Tables</a>
                  </li>
                  <li class="breadcrumb-item active">Business Category
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
                  <h4 class="card-title">Business Category</h4>
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
                      <?php while($fetch_category = mysqli_fetch_array($select_admin_category)){ ?>

                      <div class="col-md-3" id="pd32">
                        <a href="property-view.php?category=<?= $fetch_category['category_name']; ?>" id="color-white">
                          <div class="col-md-12 btn btn-info" id="pd40">
                            <i class="fa fa-list" id="color-white"></i><br><?= $fetch_category['category_name']; ?>
                          </div>
                        </a>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                </div>
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
      #pd32{
        padding: 10px 10px;
        margin: 20px;

      }
      #pd40{
        padding: 40px;
      }
      #color-white{
        color: #fff;
      }
    </style>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
<?php require_once "inc/footer.php"; ?>
<script type="text/javascript">
  $(document).ready( function () {
      $('#myTable').DataTable();
  } );
</script>