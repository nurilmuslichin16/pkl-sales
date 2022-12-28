<form autocomplete="off" action="<?= site_url('sales/report/download') ?>" method="POST">
	<div class="widget-main">
		<div class="row">
			<div class="col-lg-3">
				<div class="form-group">
					<label><b>FILTER DATEL</b></label>
					<select class="form-control input-sm" name="fdatel" data-plugin="select2">
						<option value="all">ALL</option>
						<option value="BRB">BRB</option>
						<option value="BTG">BTG</option>
						<option value="PKL1">PKL 1</option>
						<option value="PKL2">PKL 2</option>
						<option value="PML">PML</option>
						<option value="SLW">SLW</option>
						<option value="TEG">TEG</option>
					</select>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="form-group">
					<label><b>FILTER KATEGORI DEAL</b></label>
					<select class="form-control input-sm" name="fkategori" data-plugin="select2">
						<option value="all">ALL</option>
						<option value="1">DEAL, ODP READY</option>
						<option value="2">NOT DEAL, ODP READY</option>
						<option value="3">UNSC</option>
					</select>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="form-group">
					<label><b>START DATE</b></label>
					<div class="row">
						<div class="col-xs-8 col-sm-11">
							<div class="input-group">
								<input class="form-control date-picker" data-plugin="datepicker" name="fstartdate" id="ftgl" type="text" data-date-format="yyyy-mm-dd" required />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="form-group">
					<label><b>END DATE</b></label>
					<div class="row">
						<div class="col-xs-8 col-sm-11">
							<div class="input-group">
								<input class="form-control date-picker" data-plugin="datepicker" name="fenddate" id="ftgl" type="text" data-date-format="yyyy-mm-dd" required />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" name="submit" class="btn btn-sm btn-primary">Download Data</button>
	</div>
</form>