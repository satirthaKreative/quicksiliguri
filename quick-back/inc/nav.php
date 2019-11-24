

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="app-assets/images/backgrounds/02.jpg">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
          <li class="nav-item mr-auto"><a class="navbar-brand" href="dashboard"><img class="brand-logo" alt="Quick-Siliguri admin logo" id="logo-dash-img" src="../images/logo.png"/>
              <h3 class="brand-text">Quick Siliguri</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item"><a href="dashboard"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>
          <!-- Category Nav -->
          <?php if(isset($_SESSION['login_id'])){ ?>
          <li class=" nav-item"><a href="#"><i class="ft-edit"></i><span class="menu-title" data-i18n="">Category</span><!-- <sapn style="float: right;" class="fa fa-arrow-right"></span> --></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="add-category.php">Add Category</a>
              </li>
              <li><a class="menu-item" href="view-category.php">View Category</a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!-- Location Nav -->
          <?php if(isset($_SESSION['login_id'])){ ?>
          <li class=" nav-item"><a href="#"><i class="ft-map"></i><span class="menu-title" data-i18n="">Location</span><!-- <sapn style="float: right;" class="fa fa-arrow-right"></span> --></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="add-location.php">Add Location</a>
              </li>
              <li><a class="menu-item" href="view-location.php">View Location</a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!-- Admin Approval Nav -->
          <?php if(isset($_SESSION['login_id'])){ ?>
          <li class=" nav-item"><a href="admin-approval.php"><i class="ft-check"></i><span class="menu-title" data-i18n="">Admin Approval</span><!-- <sapn style="float: right;" class="fa fa-arrow-right"></span> --></a>
          </li>
          <?php } ?>
          <!-- Add Business -->
          <li class=" nav-item"><a href="#"><i class="ft-plus"></i><span class="menu-title" data-i18n="">Add Business </span><!-- <sapn style="float: right;" class="fa fa-arrow-right"></span> --></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="add-business.php">Add Business</a>
              </li>
              <li><a class="menu-item" href="view-business.php">View Business</a>
              </li>
            </ul>
          </li>
          <!-- Premium Listing -->
          <?php if(isset($_SESSION['login_id'])){ ?>
          <li class=" nav-item"><a href="#"><i class="ft-list"></i><span class="menu-title" data-i18n="">Premium Plans </span><!-- <sapn style="float: right;" class="fa fa-arrow-right"></span> --></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="add-prime-listing.php">Add premium plans</a>
              </li>
              <li><a class="menu-item" href="view-prime-listing.php">View premium plans</a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <li class=" nav-item"><a href="#"><i class="ft-list"></i><span class="menu-title" data-i18n="">Business List</span><!-- <sapn style="float: right;" class="fa fa-arrow-right"></span> --></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="add-listing.php">Add listing</a>
              </li>
              <li><a class="menu-item" href="view-listing.php">View listing</a>
              </li>
            </ul>
          </li>
          <!-- Premium Listing -->
          <li class=" nav-item"><a href="company-listing.php"><i class="ft-list"></i><span class="menu-title" data-i18n="">Premium Listed</span><!-- <sapn style="float: right;" class="fa fa-arrow-right"></span> --></a>
          </li>
          <!-- Premium Listing -->
          <li class=" nav-item"><a href="free-listing.php"><i class="ft-list"></i><span class="menu-title" data-i18n="">Free Listed</span><!-- <sapn style="float: right;" class="fa fa-arrow-right"></span> --></a>
          </li>
          <!-- Property Nav -->
          <li class="nav-item"><a href="property-list.php"><i class="ft-list"></i><span class="menu-title" data-i18n="">Business List</span></a>
          </li>
          <!-- Enquiry Nav -->
          <?php if(isset($_SESSION['login_id'])){ ?>
          <li class="nav-item"><a href="enquiry.php"><i class="ft-user"></i><span class="menu-title" data-i18n="">Business Enquiry</span></a>
          </li>
          <!-- Review Nav -->
          <li class="nav-item"><a href="reviews.php"><i class="ft-user"></i><span class="menu-title" data-i18n="">Reviews</span></a>
          </li>
          <!-- employee credentials -->
          <li class="nav-item"><a href="emp-credential.php"><i class="ft-user"></i><span class="menu-title" data-i18n="">Employee Login</span></a>
          </li>
          <?php } ?>
          <!-- employee credentials -->
          <li class="nav-item"><a href="#"><i class="ft-list"></i><span class="menu-title" data-i18n="">Advertize</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="add-addvertize.php">Add Advertize</a>
              </li>
              <li><a class="menu-item" href="view-advertize.php">View Advertize</a>
              </li>
            </ul>
          </li>
          <!-- logout -->
          <li class=" nav-item"><a href="logout"><i class="ft-power"></i><span class="menu-title" data-i18n="">Logout</span></a>
          </li>
         
        </ul>
      </div>
      <div class="navigation-background"></div>
    </div>