<?php
	$info = $this->session->flashdata('info');
	if (!empty($info)) {
		echo $info;
	}
?>
<div class="row">
	<div class="col-lg-12">
		<!-- PAGE CONTENT BEGINS -->
		<form id="change-pass" action="<?= site_url('auth/changePassword') ?>" class="form-horizontal" role="form" method="POST">
			<input type="hidden" name="users_id" value="<?= $this->session->userdata('user_id') ?>">
			<div class="form-group">
				<label class="control-label no-padding-right" for="form-field-1"> Old Password : </label>
				<div class="col-sm-12">
					<input type="password" id="oldpass" name="oldpass" placeholder="Your Old Password" class="form-control" required />
					<?php echo form_error('oldpass'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label no-padding-right" for="form-field-2"> New Password : </label>
				<div class="col-sm-12">
					<input type="password" id="newpass" name="newpass" placeholder="Your New Password" class="form-control" required />
					<?php echo form_error('newpass'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label no-padding-right" for="form-field-3"> Retype Password : </label>
				<div class="col-sm-12">
					<input type="password" id="repass" name="repass" placeholder="Retype Your Password" class="form-control" required />
					<?php echo form_error('repass'); ?>
				</div>
			</div>
			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<button class="btn btn-primary" type="submit" name="submit">
						<i class="ace-icon fa fa-check bigger-110"></i>
						Save
					</button>

					&nbsp;
					<button class="btn" type="reset">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						Reset
					</button>
				</div>
			</div>
		</form>
		<!-- END PAGE CONTENT BEGINS -->
	</div>
</div>

<script type="text/javascript">
    $(function() {
        $('#change-pass').validate({
            errorClass: "help-block",
            rules: {
                newpass: {
                    required: true,
                    confirmed: true
                },
                repass: {
                    equalTo: newpass
                }
            },
            highlight: function(e) {
                $(e).closest(".form-group").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group").removeClass("has-error")
            },
        });
    });
</script>
