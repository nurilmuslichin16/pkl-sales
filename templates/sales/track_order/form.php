<form autocomplete="off" action="<?= site_url('sales/track_order/log') ?>" method="POST">
	<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label">JA / MYIR / CP</label>
			<input name="sales_id" class="form-control" type="number">
			<span class="help-block"><i>Misal : 12225 (tanpa JA)</i></span>
		</div>
	</div>
	</div>
	<div class="row">
	<div class="col-md-4">
		<div class="form-group">
		<button type="submit" value="Track Order" class="btn btn-primary btn-sm"> Telusuri </button>
		</div>
	</div>
	</div>
</form>