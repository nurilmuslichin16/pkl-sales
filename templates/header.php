
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    
    <title><?= $title.'-'.$subtitle ?></title>
    
    <link rel="apple-touch-icon" href="<?= base_url() ?>assets/default/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/default/images/favicon.ico">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/default/css/site.min.css">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/default/skins/teal.css"> -->
    
    <!-- Plugins -->
    <script src="<?= base_url() ?>assets/global/vendor/jquery/jquery.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/waves/waves.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/default/examples/css/tables/datatable.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/floatthead/jquery.floatThead.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/default/examples/css/tables/floatthead.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/select2/select2.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/custom/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/custom/css/preloader.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets/global/custom/js/preloader.min.js"></script>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/fonts/brand-icons/brand-icons.min.css">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
      body, nav{
        font-family: 'Open Sans', sans-serif !important;
      }
      .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
        font-family: 'Open Sans', sans-serif !important;
      }
      .site-menubar{
        font-family: 'Open Sans', sans-serif !important;
      }
      table{
        font-size: 11px;
      }
    </style>
    
    <!-- Scripts -->
    <script src="<?= base_url() ?>assets/global/vendor/breakpoints/breakpoints.js"></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition site-menubar-fixed site-menubar-open" style="animation-duration: 800ms; opacity: 1;">

    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse"
      role="navigation">
    
      <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
          data-toggle="menubar">
          <span class="sr-only">Toggle navigation</span>
          <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
          data-toggle="collapse">
          <i class="icon md-more" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
          <img class="navbar-brand-logo" src="<?= base_url() ?>assets/default/images/logo.png" title="Remark">
          <span class="navbar-brand-text hidden-xs-down"> Remark</span>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
          data-toggle="collapse">
          <span class="sr-only">Toggle Search</span>
          <i class="icon md-search" aria-hidden="true"></i>
        </button>
      </div>
    
      <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
          <!-- Navbar Toolbar -->
          <ul class="nav navbar-toolbar">
            <li class="nav-item hidden-float" id="toggleMenubar">
              <a class="nav-link" data-toggle="menubar" href="#" role="button">
                <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
              </a>
            </li>
            <li class="nav-item hidden-sm-down" id="toggleFullscreen">
              <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                <span class="sr-only">Toggle fullscreen</span>
              </a>
            </li>
          </ul>
          <!-- End Navbar Toolbar -->
    
          <!-- Navbar Toolbar Right -->
          <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
            <li class="nav-item dropdown">
              <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="https://ui-avatars.com/api/?name=<?= $this->session->userdata('nama') ?>&background=4e73df&color=ffffff&size=100" alt="<?= $this->session->userdata('nama') ?>">
                  <i></i>
                </span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
                <a class="dropdown-item" href="<?php echo site_url('changePassword') ?>" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo site_url('auth/logout') ?>" role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
              </div>
            </li>
          </ul>
          <!-- End Navbar Toolbar Right -->
    
          <div class="navbar-brand navbar-brand-center">
            <a href="<?= site_url() ?>">
              <img class="navbar-brand-logo navbar-brand-logo-normal" src="<?= base_url() ?>assets/default/images/logo.png"
                title="Remark">
              <img class="navbar-brand-logo navbar-brand-logo-special" src="<?= base_url() ?>assets/default/images/logo-colored.png"
                title="Remark">
            </a>
          </div>
        </div>
        <!-- End Navbar Collapse -->
    
      </div>
    </nav>
