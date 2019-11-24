<?php require_once "db/config.php"; ?>
<?php require_once "func/function.php"; ?>
<?php require_once "inc/query.php"; ?>
<?php require_once "inc/function.php"; ?>
<?php 
  if(!isset($_SESSION['login_id']) && !isset($_SESSION['emp_id'])){
        echo "<script>window.location.href='login'</script>";
  }
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  
<!-- Mirrored from themeselection.com/demo/chameleon-admin-template/html/ltr/vertical-menu-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Aug 2018 07:30:05 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Quick-Siliguri</title>
    <link rel="apple-touch-icon" href="../images/symbol.png">
    <link rel="shortcut icon" type="image/x-icon" href="../images/symbol.png">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="app-assets/fonts/line-awesome/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/toggle/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/switch.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-switch.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/chartist-plugin-tooltip.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.min.css">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/chat-application.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/dashboard-analytics.min.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END Custom CSS-->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../images/favicon.png">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
  </head>
  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light"> 
      <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="collapse navbar-collapse show" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
              <!-- <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li> -->
              <!-- <li class="dropdown nav-item mega-dropdown d-none d-md-block"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Mega</a>
                <ul class="mega-dropdown-menu dropdown-menu row">
                  <li class="col-md-2">
                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="ft-link"></i> Quick Links</h6>
                    <ul>
                      <li><a class="my-1" href="index.html"><i class="ft-home mr-1"></i> Dashboard</a></li>
                      <li><a class="my-1" href="email-application.html"><i class="ft-layers mr-1"></i> Email Application</a></li>
                      <li><a class="my-1" href="chat-application.html"><i class="ft-message-square mr-1"></i> Chat Application</a></li>
                      <li><a class="my-1" href="form-wizard.html"><i class="ft-edit mr-1"></i> Form Wizard</a></li>
                      <li><a class="my-1" href="table-bootstrap.html"><i class="ft-grid mr-1"></i> Tables</a></li>
                      <li><a class="my-1" href="chartist-charts.html"><i class="ft-bar-chart mr-1"></i> Chartist</a></li>
                      <li><a class="my-1" href="gallery-grid.html"><i class="ft-sidebar mr-1"></i> Gallery Page</a></li>
                    </ul>
                  </li>
                  <li class="col-md-3">
                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="ft-star"></i> My Bookmarks</h6>
                    <ul class="ml-2">
                      <li class="list-style-circle"><a class="my-1" href="card-advanced.html">
                                                Advanced Cards</a></li>
                      <li class="list-style-circle"><a class="my-1" href="layout-content-detached-left-sidebar.html">
                                                Left sidebar</a></li>
                      <li class="list-style-circle"><a class="my-1" href="layout-content-detached-left-sticky-sidebar.html">
                                                Sticky left sidebar</a></li>
                      <li class="list-style-circle"><a class="my-1" href="layout-content-detached-right-sidebar.html">
                                                Right sidebar</a></li>
                      <li class="list-style-circle"><a class="my-1" href="layout-content-detached-right-sticky-sidebar.html">
                                                Sticky right sidebar</a></li>
                      <li class="list-style-circle"><a class="my-1" href="layout-fixed-navbar-navigation.html">
                                                Fixed Navbar & Navigation</a></li>
                      <li class="list-style-circle"><a class="my-1" href="layout-fixed-navbar-footer.html">
                                                Fixed Navbar & Footer                  </a></li>
                    </ul>
                  </li>
                  <li class="col-md-3">
                    <h6 class="dropdown-menu-header text-uppercase"><i class="ft-layers"></i> Recent Products</h6>
                    <div class="carousel slide pt-1" id="carousel-example" data-ride="carousel">
                      <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"><img class="d-block w-100" src="app-assets/images/carousel/08.jpg" alt="First slide"></div>
                        <div class="carousel-item"><img class="d-block w-100" src="app-assets/images/carousel/03.jpg" alt="Second slide"></div>
                        <div class="carousel-item"><img class="d-block w-100" src="app-assets/images/carousel/01.jpg" alt="Third slide"></div>
                      </div><a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev"><span class="la la-angle-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next"><span class="la la-angle-right icon-next" aria-hidden="true"></span><span class="sr-only">Next</span></a>
                      <h5 class="pt-1">Special title treatment</h5>
                      <p>Jelly beans sugar plum.</p>
                    </div>
                  </li>
                  <li class="col-md-4">
                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="ft-thumbs-up"></i> Get in touch</h6>
                    <form class="form form-horizontal pt-1">
                      <div class="form-body">
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label" for="inputName1">Name</label>
                          <div class="col-sm-9">
                            <div class="position-relative has-icon-left">
                              <input class="form-control" id="inputName1" type="text" placeholder="John Doe">
                              <div class="form-control-position pl-1"><i class="ft-user"></i></div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label" for="inputContact1">Contact</label>
                          <div class="col-sm-9">
                            <div class="position-relative has-icon-left">
                              <input class="form-control" id="inputContact1" type="text" placeholder="(123)-456-7890">
                              <div class="form-control-position pl-1"><i class="ft-smartphone"></i></div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label" for="inputEmail1">Email</label>
                          <div class="col-sm-9">
                            <div class="position-relative has-icon-left">
                              <input class="form-control" id="inputEmail1" type="email" placeholder="john@example.com">
                              <div class="form-control-position pl-1"><i class="ft-mail"></i></div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label" for="inputMessage1">Message</label>
                          <div class="col-sm-9">
                            <div class="position-relative has-icon-left">
                              <textarea class="form-control" id="inputMessage1" rows="2" placeholder="Simple Textarea"></textarea>
                              <div class="form-control-position pl-1"><i class="ft-message-circle"></i></div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 mb-1">
                            <button class="btn btn-danger float-right" type="button"><i class="ft-arrow-right"></i> Submit</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </li>
                </ul>
              </li> -->
              <!-- <li class="dropdown d-none d-md-block mr-1"><a class="dropdown-toggle nav-link" id="apps-navbar-links" href="#" data-toggle="dropdown">
                                 Apps</a>
                <div class="dropdown-menu">
                  <div class="arrow_box"><a class="dropdown-item" href="email-application.html"><i class="ft-user"></i> Email</a><a class="dropdown-item" href="chat-application.html"><i class="ft-mail"></i> Chat</a><a class="dropdown-item" href="project-summary.html"><i class="ft-briefcase"></i> Project Summary            </a><a class="dropdown-item" href="full-calender.html"><i class="ft-calendar"></i> Calendar            </a></div>
                </div>
              </li> -->
              <li class="nav-item dropdown navbar-search"><a class="nav-link dropdown-toggle hide" data-toggle="dropdown" href="dashboard"><b>Dashboard</b></a>
                <!-- <ul class="dropdown-menu">
                  <li class="arrow_box">
                    <form>
                      <div class="input-group search-box">
                        <div class="position-relative has-icon-right full-width">
                          <input class="form-control" id="search" type="text" placeholder="Search here...">
                          <div class="form-control-position navbar-search-close"><i class="ft-x"></i></div>
                        </div>
                      </div>
                    </form>
                  </li>
                </ul> -->
              </li>
            </ul>
            <ul class="nav navbar-nav float-right">         
              <!-- <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language"></span></a>
                <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                  <div class="arrow_box"><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> Chinese</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-ru"></i> Russian</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-es"></i> Spanish</a></div>
                </div>
              </li>
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell bell-shake" id="notification-navbar-link"></i><span class="badge badge-pill badge-sm badge-danger badge-default badge-up badge-glow">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <div class="arrow_box_right">
                    <li class="dropdown-menu-header">
                      <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6>
                    </li>
                    <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left align-self-center"><i class="ft-share info font-medium-4 mt-2"></i></div>
                          <div class="media-body">
                            <h6 class="media-heading info">New Order Received</h6>
                            <p class="notification-text font-small-3 text-muted text-bold-600">Lorem ipsum dolor sit amet!</p><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">3:30 PM</time></small>
                          </div>
                        </div></a><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left align-self-center"><i class="ft-save font-medium-4 mt-2 warning"></i></div>
                          <div class="media-body">
                            <h6 class="media-heading warning">New User Registered</h6>
                            <p class="notification-text font-small-3 text-muted text-bold-600">Aliquam tincidunt mauris eu risus.</p><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">10:05 AM</time></small>
                          </div>
                        </div></a><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left align-self-center"><i class="ft-repeat font-medium-4 mt-2 danger"></i></div>
                          <div class="media-body">
                            <h6 class="media-heading danger">New Purchase</h6>
                            <p class="notification-text font-small-3 text-muted text-bold-600">Lorem ipsum dolor sit ametest?</p><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Yesterday</time></small>
                          </div>
                        </div></a><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left align-self-center"><i class="ft-shopping-cart font-medium-4 mt-2 primary"></i></div>
                          <div class="media-body">
                            <h6 class="media-heading primary">New Item In Your Cart</h6><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                          </div>
                        </div></a><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left align-self-center"><i class="ft-heart font-medium-4 mt-2 info"></i></div>
                          <div class="media-body">
                            <h6 class="media-heading info">New Sale</h6><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                          </div>
                        </div></a></li>
                    <li class="dropdown-menu-footer"><a class="dropdown-item info text-right pr-1" href="javascript:void(0)">Read all</a></li>
                  </div>
                </ul>
              </li>
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail">             </i></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <div class="arrow_box_right">
                    <li class="dropdown-menu-header">
                      <h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span></h6>
                    </li>
                    <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left"><span class="avatar avatar-sm rounded-circle"><img src="app-assets/images/portrait/small/avatar-s-6.png" alt="avatar"></span></div>
                          <div class="media-body">
                            <h6 class="media-heading text-bold-700">Sarah Montery<i class="ft-circle font-small-2 success float-right"></i></h6>
                            <p class="notification-text font-small-3 text-muted text-bold-600">Everything looks good. I will provide...</p><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">3:55 PM</time></small>
                          </div>
                        </div></a><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left"><span class="avatar avatar-sm rounded-circle"><span class="media-object rounded-circle text-circle bg-warning">E</span></span></div>
                          <div class="media-body">
                            <h6 class="media-heading text-bold-700">Eliza Elliot<i class="ft-circle font-small-2 danger float-right"></i></h6>
                            <p class="notification-text font-small-3 text-muted text-bold-600">Okay. here is some more details...</p><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">2:10 AM</time></small>
                          </div>
                        </div></a><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left"><span class="avatar avatar-sm rounded-circle"><img src="app-assets/images/portrait/small/avatar-s-3.png" alt="avatar"></span></div>
                          <div class="media-body">
                            <h6 class="media-heading text-bold-700">Kelly Reyes<i class="ft-circle font-small-2 warning float-right"></i></h6>
                            <p class="notification-text font-small-3 text-muted text-bold-600">Check once and let me know if you...</p><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Yesterday</time></small>
                          </div>
                        </div></a><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left"><span class="avatar avatar-sm rounded-circle"><img src="app-assets/images/portrait/small/avatar-s-19.png" alt="avatar"></span></div>
                          <div class="media-body">
                            <h6 class="media-heading text-bold-700">Tonny Deep<i class="ft-circle font-small-2 danger float-right"></i></h6>
                            <p class="notification-text font-small-3 text-muted text-bold-600">We will start new project development...</p><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Friday</time></small>
                          </div>
                        </div></a></li>
                    <li class="dropdown-menu-footer"><a class="dropdown-item text-right info pr-1" href="javascript:void(0)">Read all</a></li>
                  </div>
                </ul>
              </li> -->
              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">             <span class="avatar avatar-online"><img src="uploads/<?php  if(isset($_SESSION['login_id']) || isset($_SESSION['emp_id'])){ echo $fetch_admin_profile['u_img']; } ?>" alt="avatar"></span></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <div class="arrow_box_right"><a class="dropdown-item" href="#"><span class="avatar avatar-online"><img src="uploads/<?php  if(isset($_SESSION['login_id']) || isset($_SESSION['emp_id'])){ echo $fetch_admin_profile['u_img']; } ?>" alt="avatar"><span class="user-name text-bold-700 ml-1"><?php if(isset($_SESSION['login_id'])){ echo $_SESSION['login_name']; }else if(isset($_SESSION['emp_id'])){ echo $_SESSION['emp_name']; } ?></span></span></a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="profile.php"><i class="ft-user"></i> Edit Profile</a><!-- <a class="dropdown-item" href="email-application.html"><i class="ft-mail"></i> My Inbox</a><a class="dropdown-item" href="project-summary.html"><i class="ft-check-square"></i> Task</a><a class="dropdown-item" href="chat-application.html"><i class="ft-message-square"></i> Chats</a> -->
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="logout"><i class="ft-power"></i> Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>