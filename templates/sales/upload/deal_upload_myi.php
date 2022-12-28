<style type="text/css">
  .required {
    color: red;
  }
</style>
<!-- form start -->
<?php echo form_open_multipart('sales/upload/myi'); ?>
<?php if (!empty($upload_error)) { ?>
  <div class="alert alert-danger" role="alert">
    <?= $upload_error; ?>
  </div>
<?php } ?>
<div class="row">
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputFile">Sumber</label>
      <select name="source" id="source" class="form-control" data-plugin="select2">
        <option value="scbe">SCBE</option>
        <option value="scbe_hsi">SCBE - BGES SC</option>
        <option value="scbe_bges">SCBE - BGES MYIDB</option>
        <option value="kpro">KPRO-PSB</option>
        <option value="pda">KPRO-PDA</option>
        <option value="addon">KPRO-ADDON</option>
        <option value="risma">RISMA</option>
      </select>
    </div>
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <label for="exampleInputFile">Pilih File</label>
      <input type="file" class="form-control" name="file">
    </div>
    <span class="required">Pilih file dengan ekstensi <i><b>.xlsx</b></i> dan maximum file upload adalah 10MB</span>
  </div>
</div>
<br>
<button type="submit" name="upload" class="btn btn-primary"><i class="fa fa-upload"></i> Import</button>
<?php echo form_close() ?>

<br />
<hr />
<h3 class="panel-title" style="padding-left: 0px;">File Template Upload</h3>
<!-- form start -->
<form method="post" action="<?= base_url('sales/upload/download_template'); ?>">
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label for="exampleInputFile">File Template</label>
        <select name="source_template" id="source_template" class="form-control" data-plugin="select2">
          <option value="scbe">SCBE</option>
          <option value="scbe_hsi">SCBE - BGES SC</option>
          <option value="scbe_bges">SCBE - BGES MYIDB</option>
          <option value="kpro">KPRO-PSB</option>
          <option value="pda">KPRO-PDA</option>
          <option value="addon">KPRO-ADDON</option>
        </select>
      </div>
    </div>
  </div>
  <button type="submit" name="upload" class="btn btn-primary"><i class="fa fa-upload"></i> Download</button>
</form>

<script>
  $(function() {
    <?php if (!empty($this->session->flashdata('info'))) { ?>
      toastr.success("<?php echo $this->session->flashdata('info'); ?>");
    <?php } elseif (!empty($this->session->flashdata('error'))) { ?>
      toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    <?php } ?>
  });
</script>