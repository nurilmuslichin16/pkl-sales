<style type="text/css">
    .required {
        color: red;
    }
</style>
<!-- form start -->
<?php echo form_open_multipart('sales/upload/jadwal'); ?>
<?php if (!empty($upload_error)) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $upload_error; ?>
    </div>
<?php } ?>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="exampleInputFile">Datel</label>
            <select name="jdatel" id="jdatel" class="form-control" data-plugin="select2" required>
                <option value="">-Pilih Datel-</option>
                <option value="BRB">BREBES</option>
                <option value="BTG">BATANG</option>
                <option value="PKL">PEKALONGAN</option>
                <option value="PML">PEMALANG</option>
                <option value="SLW">SLAWI</option>
                <option value="TEG">TEGAL</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="exampleInputFile">Jadwal</label>
            <select name="jmonth" id="jmonth" class="form-control" data-plugin="select2" required>
                <option value="">-Pilih Jadwal-</option>
                <option value="thismonth"><?= date_indo('-m-') ?></option>
                <option value="nextmonth"><?= date_indo(date('-m-', strtotime('+1 month'))) ?></option>
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

<script>
    $(function() {
        <?php if (!empty($this->session->flashdata('info'))) { ?>
            toastr.success("<?php echo $this->session->flashdata('info'); ?>");
        <?php } elseif (!empty($this->session->flashdata('error'))) { ?>
            toastr.error("<?php echo $this->session->flashdata('error'); ?>");
        <?php } ?>
    });
</script>