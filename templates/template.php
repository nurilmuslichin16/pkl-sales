<?php $this->load->view('header') ?>
<?php $this->load->view('menu') ?>

 <!-- Page -->
 <div class="page" style="max-width: 1800px;">
 	<div class="page-header">
        <h1 class="page-title"><?= $subtitle ?></h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="javascript:void(0)"><?= $title ?></a></li>
          <li class="breadcrumb-item active"><?= $subtitle ?></li>
        </ol>
        <div class="page-header-actions">
          <button onclick="window.history.back()" type="button" class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
            data-original-title="Back">
            <i class="icon md-arrow-left" aria-hidden="true"></i>
          </button>
          <button onclick="window.location.reload()" type="button" class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
            data-original-title="Refresh">
            <i class="icon md-refresh-alt" aria-hidden="true"></i>
          </button>
        </div>
    </div>

      <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel panel-primary panel-line">
          <header class="panel-heading">
            <div class="panel-actions"></div>
            <h3 class="panel-title"><?= $subtitle ?></h3>
          </header>
          <div class="panel-body">
		  	<?= $content; ?>
          </div>
        </div>
        <!-- End Panel Basic -->
      </div>

</div>
    <!-- End Page -->

<?php $this->load->view('footer') ?>