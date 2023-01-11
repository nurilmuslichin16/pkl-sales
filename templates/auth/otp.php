<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap material admin template">
  <meta name="author" content="">

  <title>Login | Jarvis Sales</title>

  <link rel="apple-touch-icon" href="<?= base_url() ?>assets/default/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="<?= base_url() ?>assets/default/images/favicon.ico">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/default/css/site.min.css">

  <!-- Plugins -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/flag-icon-css/flag-icon.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/waves/waves.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/default/examples/css/pages/login-v2.css">


  <!-- Fonts -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/fonts/material-design/material-design.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

  <!-- Scripts -->
  <script src="<?= base_url() ?>assets/global/vendor/jquery/jquery.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/breakpoints/breakpoints.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>

  <!-- Google Recaptcha -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <script>
    Breakpoints();
  </script>
</head>

<body class="animsition page-login-v2 layout-full page-dark">

  <!-- Page -->
  <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content">
      <div class="page-brand-info">
        <div class="brand">
          <img class="brand-img" src="<?= base_url() ?>assets/default/images/logo.png" width="72" alt="...">
          <h2 class="brand-text font-size-40">JARVIS</h2>
        </div>
        <p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>

      <div class="page-login-main">
        <div class="brand hidden-md-up">
          <img class="brand-img" src="<?= base_url() ?>assets/default/images/logo.png" width="72" alt="...">
          <h3 class="brand-text font-size-40">JARVIS</h3>
        </div>
        <h3 class="font-size-24">Verifikasi OTP</h3>
        <p>Masukkan kode OTP yang sudah dikirim.</p>
        <?php
        $info = $this->session->flashdata('info');
        if (!empty($info)) {
          echo $info;
        }
        ?>
        <form method="post" action="<?= base_url() ?>auth/verifyOtp" autocomplete="off">
          <input type="hidden" id="time" value="<?= $time < 0 ? 0 : $time ?>">
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <input type="number" class="form-control empty" id="inputOTP" name="otp">
            <label class="floating-label" for="inputOTP">OTP</label>
          </div>
          <div class="form-group clearfix">
            <label id="countdown">00:00</label>
            <a class="float-right" id="btnResendOTP" onclick="resendOTP()" href="#" disabled>Resend OTP</a>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Verify</button>
        </form>

        <button onclick="showModal()" class="btn btn-secondary btn-block">Belum Registrasi OTP ?</button>

        <footer class="page-copyright">
          <p>Witel Pekalongan</p>
          <p>Developed by <a href="https://ahsan.web.id">ahsan.web.id</a></p>
          <p>© 2019 - <?= date('Y') ?>.</p>
        </footer>
      </div>

    </div>
  </div>
  <!-- End Page -->

  <!-- Bootstrap modal -->
  <div class="modal fade modal-3d-sign" id="modal_how" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
    <div class="modal-dialog modal-simple">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title">Cara Registrasi OTP</h4>
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <li class="list-group-item list-group-item-dark">1. Silahkan akses Bot Telegram JarvisID</li>
            <li class="list-group-item list-group-item-light">Bot Telegram : <a target="_blank" href="https://t.me/damanasisten_bot">JarvisID</a></li>
            <li class="list-group-item list-group-item-dark">2. Ketikkan format dibawah ini</li>
            <li class="list-group-item list-group-item-light">/regotp #[email yang terdaftar di jarvis] #sales</li>
            <li class="list-group-item list-group-item-dark">Contoh : /regotp #nurilmuslichin16@gmail.com #sales</li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  <script>
    let timerOn = true;
    let remaining = $('#time').val();

    $(document).ready(function() {
      if (remaining != 0) {
        timer();
        $('#btnResendOTP').hide();
      } else {
        $('#btnResendOTP').show();
      }
    })

    function timer() {
      var m = Math.floor(remaining / 60);
      var s = remaining % 60;

      m = m < 10 ? '0' + m : m;
      s = s < 10 ? '0' + s : s;
      $('#countdown').html(m + ':' + s);
      remaining -= 1;

      if (remaining >= 0 && timerOn) {
        setTimeout(function() {
          timer(remaining);
        }, 1000);
        return;
      }

      if (!timerOn) {
        // Do validate stuff here
        return;
      }

      $('#btnResendOTP').show();

      // Do timeout stuff here
      Swal.fire({
        icon: 'error',
        title: 'Waktu Habis',
        text: 'Kode OTP sudah kadaluarwsa!'
      })
    }

    function showModal() {
      $('#modal_how').modal('show');
    }

    function resendOTP() {
      $('#btnResendOTP').text('Sending...'); //change button text

      // ajax adding data to database
      $.ajax({
        url: "<?php echo site_url('auth/sendOtp') ?>",
        type: "POST",
        dataType: "JSON",
        success: function(data) {

          if (data.status) //if success close modal and reload ajax table
          {
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Kode OTP Berhasil Dikirim',
              showConfirmButton: false,
              timer: 3000
            }).then(function() {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: 'User Belum Registrasi OTP',
              showConfirmButton: false,
              timer: 3000
            });
          }

          $('#btnResendOTP').text('Resend OTP'); //change button text
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding / update data');
          $('#btnResendOTP').text('Resend OTP'); //change button text
          $('#btnResendOTP').show();
        }
      });
    }
  </script>

  <!-- Core  -->
  <script src="<?= base_url() ?>assets/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/jquery/jquery.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/popper-js/umd/popper.min.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/bootstrap/bootstrap.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/animsition/animsition.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/asscrollable/jquery-asScrollable.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/waves/waves.js"></script>

  <!-- Plugins -->
  <script src="<?= base_url() ?>assets/global/vendor/switchery/switchery.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/intro-js/intro.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/screenfull/screenfull.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/slidepanel/jquery-slidePanel.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/jquery-placeholder/jquery.placeholder.js"></script>

  <!-- Scripts -->
  <script src="<?= base_url() ?>assets/global/js/Component.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Plugin.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Base.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Config.js"></script>

  <script src="<?= base_url() ?>assets/default/js/Section/Menubar.js"></script>
  <script src="<?= base_url() ?>assets/default/js/Section/GridMenu.js"></script>
  <script src="<?= base_url() ?>assets/default/js/Section/Sidebar.js"></script>
  <script src="<?= base_url() ?>assets/default/js/Section/PageAside.js"></script>
  <script src="<?= base_url() ?>assets/default/js/Plugin/menu.js"></script>

  <script src="<?= base_url() ?>assets/global/js/config/colors.js"></script>
  <script src="<?= base_url() ?>assets/default/js/config/tour.js"></script>
  <script>
    Config.set('assets', '../../assets');
  </script>

  <!-- Page -->
  <script src="<?= base_url() ?>assets/default/js/Site.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Plugin/asscrollable.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Plugin/slidepanel.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Plugin/switchery.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Plugin/jquery-placeholder.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Plugin/material.js"></script>

  <script>
    (function(document, window, $) {
      'use strict';

      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
      });
    })(document, window, jQuery);
  </script>

</body>

</html>