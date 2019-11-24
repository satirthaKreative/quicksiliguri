<?php require_once 'inc/header.php'; ?>
<?php require_once 'inc/nav.php'; ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Revenue, Hit Rate & Deals -->

<!--/ Revenue, Hit Rate & Deals -->
<!-- Emails Products & Avg Deals -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header p-1">
                <h4 class="card-title float-left">Dashboard List</h4>
                <span class="badge badge-pill badge-info float-right m-0">Approved</span>
            </div>
            <div class="card-content collapse show">
                <div class="card-footer text-center p-1">
                    <div class="row">
                        <div class="col-md-3 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                            <p class="blue-grey lighten-2 mb-0">Registered Company</p>

                            <p class="font-medium-5 text-bold-400"><?php echo mysqli_num_rows($select_company_list); ?></p>
                        </div>
                        <div class="col-md-3 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                            <p class="blue-grey lighten-2 mb-0">Prime Members</p>
                            <p class="font-medium-5 text-bold-400"><?= mysqli_num_rows($select_prime); ?></p>
                        </div>
                        <div class="col-md-3 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                            <p class="blue-grey lighten-2 mb-0">Category</p>
                            <p class="font-medium-5 text-bold-400"><?= mysqli_num_rows($select_admin_category); ?></p>
                        </div>
                        <div class="col-md-3 col-12 text-center">
                            <p class="blue-grey lighten-2 mb-0">Total Property</p>
                            <p class="font-medium-5 text-bold-400"><?= mysqli_num_rows($select_listing_final); ?></p>
                        </div>
                    </div>
                    <hr>
                    <span class="text-muted"><a href="#" class="danger darken-2">Admin</a> Statistics</span>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-12 col-lg-4">
        <div class="card pull-up border-top-info border-top-3 rounded-0">
            <div class="card-header">
                <h4 class="card-title">New Clients <span class="badge badge-pill badge-info float-right m-0">5+</span></h4>
            </div>
            <div class="card-content collapse show">
                <div class="card-body p-1">
                    <h4 class="font-large-1 text-bold-400">18.5% <i class="ft-users float-right"></i></h4>
                </div>
                <div class="card-footer p-1">
                    <span class="text-muted"><i class="la la-arrow-circle-o-up info"></i> 23.67% increase</span>
                </div>
            </div>
        </div>
    </div> -->
</div>
<!--/ Emails Products & Avg Deals -->
<!-- Chat and Recent Projects -->
<div class="row match-height">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <h5 class="card-title text-bold-700 my-2">Company Details</h5>
        <div class="card">            
            <div class="card-content">
                <div id="recent-projects" class="media-list position-relative">
                    <div class="table-responsive">
                        <table class="table table-padded table-xl mb-0" id="recent-project-table">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Company</th>
                                    <th class="border-top-0">Contact Person</th>
                                    <th class="border-top-0">Contact Number</th>
                                    <th class="border-top-0">SignUp Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($fetch_com_dash = mysqli_fetch_array($select_company_list)){ ?>
                                <tr>
                                    <td><?= $fetch_com_dash['company_name'] ?></td>
                                    <td><?= $fetch_com_dash['contact_person'] ?></td>
                                    <td><?= $fetch_com_dash['contact_number'] ?></td>
                                    <?php $old_date = $fetch_com_dash['reg_date'];              // returns Saturday, January 30 10 02:06:34
                                    $old_date_timestamp = strtotime($old_date);
                                    $new_date = date('F d,Y', $old_date_timestamp);  ?>
                                    <td><?= $new_date; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Products sell and New Orders -->
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

<?php require_once 'inc/footer.php'; ?>