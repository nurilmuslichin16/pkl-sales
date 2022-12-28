<style type="text/css">
	table tbody tr td a {
		color: #212121;
		text-decoration: none !important;
	}

	#utama {
		font-size: 11px;
	}

	#note {
		font-size: 14px;
	}

	#note th {
		font-weight: bold;
	}

	.bawah {
		background-color: #616161;
		color: #fff;
	}

	.bawah a {
		color: #fff !important;
	}
</style>
<input type="hidden" id="bulan_selected" value="<?= $bulan; ?>">
<input type="hidden" id="tahun_selected" value="<?= $tahun; ?>">
<input type="hidden" id="datel_selected" value="<?= $datel; ?>">
<div class="row">
	<div class="col-md-2">
		<select name="bulan" class="form-control form-control-sm" id="select_bulan" data-plugin="select2">
			<option value="">-Pilih Bulan-</option>
			<option value="01" <?= !empty($bulan) ? ($bulan == '01' ? 'selected' : '') : '' ?>>Januari</option>
			<option value="02" <?= !empty($bulan) ? ($bulan == '02' ? 'selected' : '') : '' ?>>Februari</option>
			<option value="03" <?= !empty($bulan) ? ($bulan == '03' ? 'selected' : '') : '' ?>>Maret</option>
			<option value="04" <?= !empty($bulan) ? ($bulan == '04' ? 'selected' : '') : '' ?>>April</option>
			<option value="05" <?= !empty($bulan) ? ($bulan == '05' ? 'selected' : '') : '' ?>>Mei</option>
			<option value="06" <?= !empty($bulan) ? ($bulan == '06' ? 'selected' : '') : '' ?>>Juni</option>
			<option value="07" <?= !empty($bulan) ? ($bulan == '07' ? 'selected' : '') : '' ?>>Juli</option>
			<option value="08" <?= !empty($bulan) ? ($bulan == '08' ? 'selected' : '') : '' ?>>Agustus</option>
			<option value="09" <?= !empty($bulan) ? ($bulan == '09' ? 'selected' : '') : '' ?>>September</option>
			<option value="10" <?= !empty($bulan) ? ($bulan == '10' ? 'selected' : '') : '' ?>>Oktober</option>
			<option value="11" <?= !empty($bulan) ? ($bulan == '11' ? 'selected' : '') : '' ?>>November</option>
			<option value="12" <?= !empty($bulan) ? ($bulan == '12' ? 'selected' : '') : '' ?>>Desember</option>
		</select>
	</div>
	<div class="col-md-2">
		<select name="tahun" class="form-control form-control-sm" id="select_tahun" data-plugin="select2">
			<?php $years = date("Y"); ?>
			<option value="">-Pilih Tahun-</option>
			<option value="<?= $years; ?>" <?= !empty($tahun) ? ($tahun == $years ? 'selected' : '') : '' ?>><?= $years; ?></option>
			<option value="<?= ($years - 1); ?>" <?= !empty($tahun) ? ($tahun == ($years - 1) ? 'selected' : '') : '' ?>><?= ($years - 1); ?></option>
			<option value="<?= ($years - 2); ?>" <?= !empty($tahun) ? ($tahun == ($years - 2) ? 'selected' : '') : '' ?>><?= ($years - 2); ?></option>
			<option value="<?= ($years - 3); ?>" <?= !empty($tahun) ? ($tahun == ($years - 3) ? 'selected' : '') : '' ?>><?= ($years - 3); ?></option>
			<option value="<?= ($years - 4); ?>" <?= !empty($tahun) ? ($tahun == ($years - 4) ? 'selected' : '') : '' ?>><?= ($years - 4); ?></option>
		</select>
	</div>
	<div class="col-md-2">
		<select name="datel" class="form-control form-control-sm" id="select_datel" data-plugin="select2">
			<option value="">-Pilih Sektor-</option>
			<option value="BRB" <?= !empty($datel) ? ($datel == 'BRB' ? 'selected' : '') : '' ?>>BRB</option>
			<option value="BTG" <?= !empty($datel) ? ($datel == 'BTG' ? 'selected' : '') : '' ?>>BTG</option>
			<option value="PKL1" <?= !empty($datel) ? ($datel == 'PKL1' ? 'selected' : '') : '' ?>>PKL1</option>
			<option value="PKL2" <?= !empty($datel) ? ($datel == 'PKL2' ? 'selected' : '') : '' ?>>PKL2</option>
			<option value="PML" <?= !empty($datel) ? ($datel == 'PML' ? 'selected' : '') : '' ?>>PML</option>
			<option value="SLW" <?= !empty($datel) ? ($datel == 'SLW' ? 'selected' : '') : '' ?>>SLW</option>
			<option value="TEG" <?= !empty($datel) ? ($datel == 'TEG' ? 'selected' : '') : '' ?>>TEG</option>
		</select>
	</div>
	<!-- <div class="col-md-2">
	 	<div class="input-group">
			<input class="form-control date-picker form-control-sm" data-plugin="datepicker" name="fstartdate" id="ftgl" placeholder="Filter Start Date" type="text" data-date-format="yyyy-mm-dd" required />
			<span class="input-group-addon">
				<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	 </div> -->
	<!-- <div class="col-md-2">
		<div class="input-group">
			<input class="form-control date-picker form-control-sm" data-plugin="datepicker" name="fenddate" id="ftgl" placeholder="Filter End Date" type="text" data-date-format="yyyy-mm-dd" required />
			<span class="input-group-addon">
				<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div> -->
	<div class="col-md-1">
		<!-- <button type="button" name="filterbtn" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Show Data</button> -->
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-3 float-right">
		<form autocomplete="off" action="<?= site_url('sales/sc_update/search_sc') ?>" method="POST">
			<div class="form-group">
				<div class="input-search">
					<button type="submit" class="input-search-btn"><i class="icon md-search" aria-hidden="true"></i></button>
					<input type="text" class="form-control" name="search" placeholder="Search JA/CP/SC/MYI">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-sm" id="utama">
				<thead>
					<tr>
						<th colspan="33" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff; font-size:16px;">DASHBOARD PRODUKTIFITAS PSB BULAN <?= strtoupper(bulan(date("n"))); ?> 2022</th>
					</tr>
					<tr>
						<th style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">STATUS</th>
						<?php for ($i = 1; $i < 32; $i++) { ?>
							<th style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;"><?= $i; ?></th>
						<?php } ?>
						<th style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">TOTAL</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="font-weight: bold;">SCBE</td>
						<?php for ($i = 1; $i < 32; $i++) { ?>
							<td style="vertical-align : middle;text-align:center;"><?= check_null_dashboard($list_scbe["scbe_$i"]); ?></td>
						<?php } ?>
						<td style="font-weight: bold; vertical-align : middle;text-align:center;"><?= check_null_dashboard($list_scbe["total_scbe"]); ?></td>
					</tr>
					<tr>
						<td style="font-weight: bold;">RE-ORDER</td>
						<?php for ($i = 1; $i < 32; $i++) { ?>
							<td style="vertical-align : middle;text-align:center;"><?= check_null_dashboard($list_reorder["reorder_$i"]); ?></td>
						<?php } ?>
						<td style="font-weight: bold; vertical-align : middle;text-align:center;"><?= check_null_dashboard($list_reorder["total_reorder"]); ?></td>
					</tr>
					<tr>
						<td style="font-weight: bold;">REQUEST SC</td>
						<?php for ($i = 1; $i < 32; $i++) { ?>
							<td style="vertical-align : middle;text-align:center;"><?= check_null_dashboard($list_reqsc["reqsc_$i"]); ?></td>
						<?php } ?>
						<td style="font-weight: bold; vertical-align : middle;text-align:center;"><?= check_null_dashboard($list_reqsc["total_reqsc"]); ?></td>
					</tr>
					<tr>
						<td style="font-weight: bold;">KENDALA</td>
						<?php for ($i = 1; $i < 32; $i++) { ?>
							<td style="vertical-align : middle;text-align:center;"><?= check_null_dashboard($list_kendala["kendala_$i"]); ?></td>
						<?php } ?>
						<td style="font-weight: bold; vertical-align : middle;text-align:center;"><?= check_null_dashboard($list_kendala["total_kendala"]); ?></td>
					</tr>
					<tr>
						<td style="font-weight: bold;">PS</td>
						<?php for ($i = 1; $i < 32; $i++) { ?>
							<td style="vertical-align : middle;text-align:center;"><?= check_null_dashboard($list_ps["ps_$i"]); ?></td>
						<?php } ?>
						<td style="font-weight: bold; vertical-align : middle;text-align:center;"><?= check_null_dashboard($list_ps["total_ps"]); ?></td>
					</tr>
					<tr>
						<th class="bawah">TOTAL</th>
						<?php for ($i = 1; $i < 32; $i++) { ?>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= check_null_dashboard(
																										$list_scbe["scbe_$i"] + $list_reorder["reorder_$i"] + $list_reqsc["reqsc_$i"] + $list_kendala["kendala_$i"] + $list_ps["ps_$i"]
																									); ?></td>
						<?php } ?>
						<th class="bawah" style="vertical-align : middle;text-align:center;"><?= check_null_dashboard($list_scbe["total_scbe"] + $list_reorder["total_reorder"] + $list_reqsc["total_reqsc"] + $list_kendala["total_kendala"] + $list_ps["total_ps"]); ?></th>
					</tr>
				</tbody>
			</table>
			<table id="note">
				<tr>
					<th width=180><i class="icon md-check-circle"></i> SCBE</th>
					<td><i>: Order PT1 yang sudah siap secara sistem</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> RE-ORDER</th>
					<td><i>: Order PT1 Ex kendala</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> REQUEST SC</th>
					<td><i>: Order MYI sudah tarik PT1 masih req SC ke HD</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> KENDALA</th>
					<td><i>: Order yang terkendala</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> PS</th>
					<td><i>: Order PS</i></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<!-- <div class="row">
	<div class="col-md-12">
	 	<div class="table-responsive">
			<table class="table table-striped table-bordered table-sm">
				<thead>
					<tr>
						<th colspan="14" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff; font-size:16px;">DASHBOARD PDA</th>
					</tr>
					<tr>
						<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">DATEL</th>
						<th colspan="5" style="text-align: center; background: #1E88E5; color: #fff;">PROGRESS ORDER</th>
						<th colspan="5" style="text-align: center;background: #43A047; color: #fff;">PROGRESS PROVISIONING</th>
						<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PELANGGAN<br>NOK</th>
						<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">JARINGAN<br>NOK</th>
					</tr>
					<tr>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">WO</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">ORDERED</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">OTW</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">OGP</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">CEK ONU</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">WAIT ACT</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PROG ACT</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">FALLOUT</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">ACT COMP</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PS</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($list_wo_pda as $key) { ?>
						<tr>
							<td style="font-weight: bold;"><?= datel_witel($key['datel']) ?></td>
							<td style="vertical-align : middle;text-align:center; background:#c5e1a5;"><a href="<?= site_url('sales/work_order/progress?datel=' . $key['datel'] . '&kategori=wo') ?>"><?= !empty($key['wo']) ? $key['wo'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/progress?datel=' . $key['datel'] . '&kategori=ordered') ?>"><?= !empty($key['ordered']) ? $key['ordered'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/progress?datel=' . $key['datel'] . '&kategori=otw') ?>"><?= !empty($key['otw']) ? $key['otw'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/progress?datel=' . $key['datel'] . '&kategori=ogp') ?>"><?= !empty($key['ogp']) ? $key['ogp'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/progress?datel=' . $key['datel'] . '&kategori=cek_onu') ?>"><?= !empty($key['cek_onu']) ? $key['cek_onu'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center; background:#f8bbd0;"><a href="<?= site_url('sales/work_order/provi?datel=' . $key['datel'] . '&kategori=wait_act&jenis=pda') ?>"><?= $key['wait_act'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=' . $key['datel'] . '&kategori=prog_act&jenis=pda') ?>"><?= $key['prog_act'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=' . $key['datel'] . '&kategori=fact&jenis=pda') ?>"><?= $key['fact'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=' . $key['datel'] . '&kategori=comp&jenis=pda') ?>"><?= $key['comp'] ?></a></td>
							<td style="vertical-align : middle;text-align:center; background: palegreen"><a href="<?= site_url('sales/work_order/provi?datel=' . $key['datel'] . '&kategori=ps&jenis=pda') ?>"><?= $key['ps'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel=' . $key['datel'] . '&kategori=kp&jenis=pda') ?>"><?= $key['p_nok'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel=' . $key['datel'] . '&kategori=kj&jenis=pda') ?>"><?= $key['j_nok'] ?></a></td>
						</tr>
					<?php } ?>
						<tr>
							<th class="bawah">TOTAL</th>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/progress?datel=all&kategori=wo') ?>"><?= !empty($wo_total_pda['wo']) ? $wo_total_pda['wo'] : '' ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/progress?datel=all&kategori=ordered') ?>"><?= !empty($wo_total_pda['ordered']) ? $wo_total_pda['ordered'] : '' ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/progress?datel=all&kategori=otw') ?>"><?= !empty($wo_total_pda['otw']) ? $wo_total_pda['otw'] : '' ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/progress?datel=all&kategori=ogp') ?>"><?= !empty($wo_total_pda['ogp']) ? $wo_total_pda['ogp'] : '' ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/progress?datel=all&kategori=cek_onu') ?>"><?= !empty($wo_total_pda['cek_onu']) ? $wo_total_pda['cek_onu'] : '' ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=wait_act&jenis=pda') ?>"><?= !empty($wo_total_pda['wait_act']) ? $wo_total_pda['wait_act'] : '' ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=prog_act&jenis=pda') ?>"><?= !empty($wo_total_pda['prog_act']) ? $wo_total_pda['prog_act'] : '' ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=fact&jenis=pda') ?>"><?= !empty($wo_total_pda['fact']) ? $wo_total_pda['fact'] : '' ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=comp&jenis=pda') ?>"><?= !empty($wo_total_pda['comp']) ? $wo_total_pda['comp'] : '' ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=ps&jenis=pda') ?>"><?= !empty($wo_total_pda['ps']) ? $wo_total_pda['ps'] : '' ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel=all&kategori=kp&jenis=pda') ?>"><?= !empty($wo_total_pda['p_nok']) ? $wo_total_pda['p_nok'] : '' ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel=all&kategori=kj&jenis=pda') ?>"><?= !empty($wo_total_pda['j_nok']) ? $wo_total_pda['j_nok'] : '' ?></a></td>
						</tr>
				</tbody>
			</table>
		</div>
	</div>
 </div> -->

<script>
	$('#select_bulan').on('change', function() {
		var baseurl = "<?php echo site_url() ?>";
		var bulan = this.value;
		var tahun = $('#tahun_selected').val();
		var datel = $('#datel_selected').val();
		var url = baseurl + 'welcome/produktifitas/' + bulan + '/' + tahun + '/' + datel;
		window.location = url;
	});

	$('#select_tahun').on('change', function() {
		var baseurl = "<?php echo site_url() ?>";
		var tahun = this.value;
		var bulan = $('#bulan_selected').val();
		var datel = $('#datel_selected').val();
		var url = baseurl + 'welcome/produktifitas/' + bulan + '/' + tahun + '/' + datel;
		window.location = url;
	});

	$('#select_datel').on('change', function() {
		var baseurl = "<?php echo site_url() ?>";
		var datel = this.value;
		var bulan = $('#bulan_selected').val();
		var tahun = $('#tahun_selected').val();
		var url = baseurl + 'welcome/produktifitas/' + bulan + '/' + tahun + '/' + datel;
		window.location = url;
	});
</script>