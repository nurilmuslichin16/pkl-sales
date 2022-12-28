<!-- Footer -->
<footer class="site-footer">
      <div class="site-footer-legal">© 2019 - <?= date('Y') ?> Witel Pekalongan, in collaboration with <a target="_blank" href="https://ahsan.web.id">ahsan.web.id</a></div>
      <div class="site-footer-right">
        Crafted by <a target="_blank" href="https://t.me/abdulhakimhs"> @ahsan</a>
      </div>
    </footer>
    <!-- Core  -->
    <script src="<?= base_url() ?>assets/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/popper-js/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/bootstrap/bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/animsition/animsition.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/asscrollable/jquery-asScrollable.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/waves/waves.js"></script>
    
    <!-- Plugins -->
    <script src="<?= base_url() ?>assets/global/vendor/switchery/switchery.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/intro-js/intro.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/screenfull/screenfull.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/slidepanel/jquery-slidePanel.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-rowgroup/dataTables.rowGroup.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-scroller/dataTables.scroller.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-responsive/dataTables.responsive.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-buttons/dataTables.buttons.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-buttons/buttons.html5.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-buttons/buttons.flash.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-buttons/buttons.print.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-buttons/buttons.colVis.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/asrange/jquery-asRange.min.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/bootbox/bootbox.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/toastr/toastr.min.js"></script>
    <script src="<?= base_url() ?>assets/global/js/Plugin/datatables.js"></script>
    <script src="<?= base_url() ?>assets/default/examples/js/tables/datatable.js"></script>
    <script src="<?= base_url() ?>assets/default/examples/js/uikit/icon.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/floatthead/jquery.floatThead.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/select2/select2.full.min.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/bootstrap-select/bootstrap-select.js"></script>
    <script src="<?= base_url() ?>assets/global/js/Plugin/select2.js"></script>
    <script src="<?= base_url() ?>assets/global/js/Plugin/bootstrap-select.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>

    <!-- Scripts -->
    <script src="<?= base_url() ?>assets/global/js/Component.js"></script>
    <script src="<?= base_url() ?>assets/global/js/Plugin.js"></script>
    <script src="<?= base_url() ?>assets/global/js/Base.js"></script>
    <script src="<?= base_url() ?>assets/global/js/Config.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url() ?>assets/global/custom/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/global/custom/daterangepicker/daterangepicker.js"></script>
    
    <script src="<?= base_url() ?>assets/default/js/Section/Menubar.js"></script>
    <script src="<?= base_url() ?>assets/default/js/Section/Sidebar.js"></script>
    <script src="<?= base_url() ?>assets/default/js/Section/PageAside.js"></script>
    <script src="<?= base_url() ?>assets/default/js/Plugin/menu.js"></script>
    
    <!-- Config -->
    <script src="<?= base_url() ?>assets/global/js/config/colors.js"></script>
    <script src="<?= base_url() ?>assets/default/js/config/tour.js"></script>
    <script>Config.set('assets', '<?= base_url() ?>assets/default/');</script>
    
    <!-- Page -->
    <script src="<?= base_url() ?>assets/default/js/Site.js"></script>
    <script src="<?= base_url() ?>assets/global/js/Plugin/asscrollable.js"></script>
    <script src="<?= base_url() ?>assets/global/js/Plugin/slidepanel.js"></script>
    <script src="<?= base_url() ?>assets/global/js/Plugin/switchery.js"></script>
    <script src="<?= base_url() ?>assets/global/js/Plugin/floatthead.js"></script>
    <script src="<?= base_url() ?>assets/global/js/Plugin/bootstrap-datepicker.js"></script>
    
    <script>
      (function(document, window, $){
        'use strict';
    
        var Site = window.Site;
        $(document).ready(function(){
          Site.run();
        });
      })(document, window, jQuery);
    </script>
  </body>
</html>
