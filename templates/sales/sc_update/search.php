<form autocomplete="off" action="<?= site_url('sales/sc_update/search_sc') ?>" method="POST">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">SC / MYIR / CP</label>
				<input name="search" class="form-control" type="text">
				<span class="help-block"><i>Misal : 10128598030002 untuk MYI, 5422144 untuk SC</i></span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
			<button type="submit" class="btn btn-primary" name="submit"> Cari </button>
			</div>
		</div>
	</div>
</form>