<style type="text/css">
  .required {
    color: red;
  }
</style>
<!-- form start -->
<?php echo form_open_multipart('sales/upload/reset_order'); ?>
<?php if (!empty($upload_error)) { ?>
  <div class="alert alert-danger" role="alert">
    <?= $upload_error; ?>
  </div>
<?php } ?>
<div class="row">
  <div class="col-md-5">
    <div class="form-group">
      <label for="exampleInputFile">Pilih File</label>
      <input type="file" class="form-control" name="file">
    </div>
    <span class="required">Pilih file dengan ekstensi <i><b>.xlsx</b></i> dan maximum file upload adalah 10MB</span>
  </div>
  <div class="col-md-5">
    <br />
    <button type="submit" name="upload" class="btn btn-primary mt-5">
      <i class="fa fa-upload"></i> Import
    </button>
  </div>
</div>
<br>
<?php echo form_close() ?>

<br>
<img class="brand-img" src="<?= base_url() ?>assets/default/images/format-reset-order.png" width="300" alt="Format Upload Dorong PS">

<script>
  $(function() {
    <?php if (!empty($this->session->flashdata('info'))) { ?>
      toastr.success("<?php echo $this->session->flashdata('info'); ?>");
    <?php } elseif (!empty($this->session->flashdata('error'))) { ?>
      toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    <?php } ?>
  });
</script>