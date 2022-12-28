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
<input type="hidden" id="waktu_selected" value="<?= $time; ?>">
<input type="hidden" id="unit_selected" value="<?= $unit; ?>">
<div class="row">
	<div class="col-md-2">
		<select name="waktu" class="form-control form-control-sm" id="select_waktu" data-plugin="select2">
			<option value="">-Pilih Waktu-</option>
			<option value="all" <?= !empty($time) ? ($time == 'all' ? 'selected' : '') : '' ?>>All</option>
			<option value="daily" <?= !empty($time) ? ($time == 'daily' ? 'selected' : '') : '' ?>>Harian</option>
			<!-- <option value="monthly">Bulanan</option>
			<option value="annual">Tahunan</option> -->
		</select>
	</div>
	<div class="col-md-2">
		<select name="unit" class="form-control form-control-sm" id="select_unit" data-plugin="select2">
			<option value="all">-Pilih Unit-</option>
			<option value="dcs" <?= !empty($unit) ? ($unit == 'dcs' ? 'selected' : '') : '' ?>>DCS</option>
			<option value="egbis" <?= !empty($unit) ? ($unit == 'egbis' ? 'selected' : '') : '' ?>>EGBIS</option>
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
	<div class="col-md-2">
		<!-- <div class="input-group">
			<input class="form-control date-picker form-control-sm" data-plugin="datepicker" name="fenddate" id="ftgl" placeholder="Filter End Date" type="text" data-date-format="yyyy-mm-dd" required />
			<span class="input-group-addon">
				<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div> -->
	</div>
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
						<th colspan="22" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff; font-size:16px;">DASHBOARD PSB</th>
					</tr>
					<tr>
						<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">SEKTOR</th>
						<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">DEAL H1</th>
						<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">DEAL H-1</th>
						<th colspan="2" style="text-align: center; background: plum; color: #fff;">PRA ORDER</th>
						<th colspan="7" style="text-align: center; background: #1E88E5; color: #fff;">AMUNISI</th>
						<th colspan="2" style="text-align: center; background: #ffb822; color: #fff;">REQUEST SC</th>
						<th colspan="5" style="text-align: center;background: #43A047; color: #fff;">PROGRESS PROVISIONING</th>
						<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PELANGGAN<br>NOK</th>
						<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">JARINGAN<br>NOK</th>
						<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">ON<br>CONSTRUCTION</th>
					</tr>
					<tr>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">WAIT FCC</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">KNDL FCC</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PAGI</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">SORE</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">AS H-1</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">AS EXP</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">RE PAGI</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">RE SORE</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">TOTAL</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">WAIT SC</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">DONE SC</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">WAIT ACT</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PROG ACT</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">FALLOUT</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">COMP</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PS</th>
					</tr>
				</thead>
				<?php if (aksesOrderDashboardPSB($this->session->userdata('level'))) { ?>
					<tbody>
						<?php foreach ($list_wo as $key) { ?>
							<tr>
								<td style="font-weight: bold;"><?= datel_witel($key['datel']) ?></td>
								<?php if (aksesOrderDealFCC($this->session->userdata('level'))) { ?>
									<td style="vertical-align : middle;text-align:center; background: palegreen"><a href="<?= site_url('sales/work_order/deal?datel=' . $key['datel'] . '&kategori=today&unit=' . $unit . '&time=' . $time) ?>"><?= $key['deal_hi'] ?></a></td>
									<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/deal?datel=' . $key['datel'] . '&kategori=yesterday&unit=' . $unit . '&time=' . $time) ?>"><?= $key['deal_h_min_1'] ?></a></td>
									<td style="vertical-align : middle;text-align:center; background:#f8bbd0;"><a href="<?= site_url('sales/work_order/pra_order?datel=' . $key['datel'] . '&order=wait_fcc&unit=' . $unit . '&time=' . $time) ?>"><?= $key['wait_fcc'] ?></a></td>
									<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/pra_order?datel=' . $key['datel'] . '&order=kndl_fcc&unit=' . $unit . '&time=' . $time) ?>"><?= $key['kndl_fcc'] ?></a></td>
								<?php } else { ?>
									<td style="vertical-align : middle;text-align:center; background: palegreen"><?= $key['deal_hi'] ?></td>
									<td style="vertical-align : middle;text-align:center;"><?= $key['deal_h_min_1'] ?></td>
									<td style="vertical-align : middle;text-align:center; background:#f8bbd0;"><?= $key['wait_fcc'] ?></td>
									<td style="vertical-align : middle;text-align:center;"><?= $key['kndl_fcc'] ?></td>
								<?php } ?>
								<td style="vertical-align : middle;text-align:center; background:#c5e1a5;"><a href="<?= site_url('sales/work_order/amunisi?datel=' . $key['datel'] . '&amunisi=pagi&unit=' . $unit . '&time=' . $time) ?>"><?= $key['deal_pagi'] ?></a></td>
								<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=' . $key['datel'] . '&amunisi=sore&unit=' . $unit . '&time=' . $time) ?>"><?= $key['deal_sore'] ?></a></td>
								<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=' . $key['datel'] . '&amunisi=h_min_1&unit=' . $unit . '&time=' . $time) ?>"><?= $key['as_h_min_1'] ?></a></td>
								<td style="vertical-align : middle;text-align:center; background: #ffb822"><a href="<?= site_url('sales/work_order/amunisi?datel=' . $key['datel'] . '&amunisi=exp&unit=' . $unit . '&time=' . $time) ?>"><?= $key['as_exp'] ?></a></td>
								<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=' . $key['datel'] . '&amunisi=reorder_pagi&unit=' . $unit . '&time=' . $time) ?>"><?= $key['reorder_pagi'] ?></a></td>
								<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=' . $key['datel'] . '&amunisi=reorder_sore&unit=' . $unit . '&time=' . $time) ?>"><?= $key['reorder_sore'] ?></a></td>
								<td style="vertical-align : middle;text-align:center; background: lavender"><a href="<?= site_url('sales/work_order/amunisi?datel=' . $key['datel'] . '&amunisi=all&unit=' . $unit . '&time=' . $time) ?>"><?= $key['deal_pagi'] + $key['deal_sore'] + $key['as_h_min_1'] + $key['as_exp'] + $key['reorder_pagi'] + $key['reorder_sore'] + $key['today_not_fu'] ?></a></td>
								<?php if (aksesOrderRequestSCKendalaProvi($this->session->userdata('level'))) { ?>
									<td style="vertical-align : middle;text-align:center; background:#f8bbd0;"><a href="<?= site_url('sales/work_order/request_sc?datel=' . $key['datel'] . '&order=waitsc&unit=' . $unit . '&time=' . $time) ?>"><?= $key['waitsc'] ?></a></td>
									<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/request_sc?datel=' . $key['datel'] . '&order=donesc&unit=' . $unit . '&time=' . $time) ?>"><?= $key['donesc'] ?></a></td>
									<td style="vertical-align : middle;text-align:center; background:#f8bbd0;"><a href="<?= site_url('sales/work_order/provi?datel=' . $key['datel'] . '&kategori=wait_act&unit=' . $unit . '&time=' . $time) ?>"><?= $key['wait_act'] ?></a></td>
									<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=' . $key['datel'] . '&kategori=prog_act&unit=' . $unit . '&time=' . $time) ?>"><?= $key['prog_act'] ?></a></td>
									<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=' . $key['datel'] . '&kategori=fact&unit=' . $unit . '&time=' . $time) ?>"><?= $key['fact'] ?></a></td>
									<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=' . $key['datel'] . '&kategori=comp&unit=' . $unit . '&time=' . $time) ?>"><?= $key['comp'] ?></a></td>
									<td style="vertical-align : middle;text-align:center; background: palegreen"><a href="<?= site_url('sales/work_order/provi?datel=' . $key['datel'] . '&kategori=ps&unit=' . $unit . '&time=' . $time) ?>"><?= $key['ps'] ?></a></td>
									<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel=' . $key['datel'] . '&kategori=kp&time=' . $time . '&unit=' . $unit) ?>"><?= $key['p_nok'] ?></a></td>
									<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel=' . $key['datel'] . '&kategori=kj&time=' . $time . '&unit=' . $unit) ?>"><?= $key['j_nok'] ?></a></td>
									<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel=' . $key['datel'] . '&kategori=cons&time=' . $time . '&unit=' . $unit) ?>"><?= $key['u_cons'] ?></a></td>
								<?php } else { ?>
									<td style="vertical-align : middle;text-align:center; background:#f8bbd0;"><?= $key['waitsc'] ?></td>
									<td style="vertical-align : middle;text-align:center;"><?= $key['donesc'] ?></td>
									<td style="vertical-align : middle;text-align:center; background:#f8bbd0;"><?= $key['wait_act'] ?></td>
									<td style="vertical-align : middle;text-align:center;"><?= $key['prog_act'] ?></td>
									<td style="vertical-align : middle;text-align:center;"><?= $key['fact'] ?></td>
									<td style="vertical-align : middle;text-align:center;"><?= $key['comp'] ?></td>
									<td style="vertical-align : middle;text-align:center; background: palegreen"><?= $key['ps'] ?></td>
									<td style="vertical-align : middle;text-align:center;"><?= $key['p_nok'] ?></td>
									<td style="vertical-align : middle;text-align:center;"><?= $key['j_nok'] ?></td>
									<td style="vertical-align : middle;text-align:center;"><?= $key['u_cons'] ?></td>
								<?php } ?>
							</tr>
						<?php } ?>
						<tr>
							<th class="bawah">TOTAL</th>
							<?php if (aksesOrderDealFCC($this->session->userdata('level'))) { ?>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/deal?datel=all&kategori=today&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['deal_hi'] ?></a></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/deal?datel=all&kategori=yesterday&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['deal_h_min_1'] ?></a></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/pra_order?datel=all&order=wait_fcc&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['wait_fcc'] ?></a></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/pra_order?datel=all&order=kndl_fcc&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['kndl_fcc'] ?></a></td>
							<?php } else { ?>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['deal_hi'] ?></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['deal_h_min_1'] ?></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['wait_fcc'] ?></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['kndl_fcc'] ?></td>
							<?php } ?>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=pagi&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['deal_pagi'] ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=sore&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['deal_sore'] ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=h_min_1&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['as_h_min_1'] ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=exp&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['as_exp'] ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=reorder_pagi&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['reorder_pagi'] ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=reorder_sore&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['reorder_sore'] ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=all&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['deal_pagi'] + $wo_total['deal_sore'] + $wo_total['as_h_min_1'] + $wo_total['as_exp'] + $wo_total['reorder_pagi'] + $wo_total['reorder_sore'] + $wo_total['today_not_fu'] ?></a></td>
							<?php if (aksesOrderRequestSCKendalaProvi($this->session->userdata('level'))) { ?>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/request_sc?datel=all&order=waitsc&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['waitsc'] ?></a></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/request_sc?datel=all&order=donesc&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['donesc'] ?></a></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=wait_act&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['wait_act'] ?></a></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=prog_act&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['prog_act'] ?></a></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=fact&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['fact'] ?></a></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=comp&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['comp'] ?></a></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=ps&unit=' . $unit . '&time=' . $time) ?>"><?= $wo_total['ps'] ?></a></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel=all&kategori=kp&time=' . $time . '&unit=' . $unit) ?>"><?= $wo_total['p_nok'] ?></a></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel=all&kategori=kj&time=' . $time . '&unit=' . $unit) ?>"><?= $wo_total['j_nok'] ?></a></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel=all&kategori=cons&time=' . $time . '&unit=' . $unit) ?>"><?= $wo_total['u_cons'] ?></a></td>
							<?php } else { ?>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['waitsc'] ?></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['donesc'] ?></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['wait_act'] ?></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['prog_act'] ?></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['fact'] ?></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['comp'] ?></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['ps'] ?></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['p_nok'] ?></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['j_nok'] ?></td>
								<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['u_cons'] ?></td>
							<?php } ?>
						</tr>
					</tbody>
				<?php } else { ?>
					<tbody>
						<?php foreach ($list_wo as $key) { ?>
							<tr>
								<td style="font-weight: bold;"><?= datel_witel($key['datel']) ?></td>
								<td style="vertical-align : middle;text-align:center; background: palegreen"><?= $key['deal_hi'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['deal_h_min_1'] ?></td>
								<td style="vertical-align : middle;text-align:center; background:#f8bbd0;"><?= $key['wait_fcc'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['kndl_fcc'] ?></td>
								<td style="vertical-align : middle;text-align:center; background:#c5e1a5;"><?= $key['deal_pagi'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['deal_sore'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['as_h_min_1'] ?></td>
								<td style="vertical-align : middle;text-align:center; background: #ffb822"><?= $key['as_exp'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['reorder_pagi'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['reorder_sore'] ?></td>
								<td style="vertical-align : middle;text-align:center; background: lavender"><?= $key['deal_pagi'] + $key['deal_sore'] + $key['as_h_min_1'] + $key['as_exp'] + $key['reorder_pagi'] + $key['reorder_sore'] + $key['today_not_fu'] ?></a></td>
								<td style="vertical-align : middle;text-align:center; background:#f8bbd0;"><?= $key['waitsc'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['donesc'] ?></td>
								<td style="vertical-align : middle;text-align:center; background:#f8bbd0;"><?= $key['wait_act'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['prog_act'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['fact'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['comp'] ?></td>
								<td style="vertical-align : middle;text-align:center; background: palegreen"><?= $key['ps'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['p_nok'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['j_nok'] ?></td>
								<td style="vertical-align : middle;text-align:center;"><?= $key['u_cons'] ?></td>
							</tr>
						<?php } ?>
						<tr>
							<th class="bawah">TOTAL</th>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['deal_hi'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['deal_h_min_1'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['wait_fcc'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['kndl_fcc'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['deal_pagi'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['deal_sore'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['as_h_min_1'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['as_exp'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['reorder_pagi'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['reorder_sore'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['deal_pagi'] + $wo_total['deal_sore'] + $wo_total['as_h_min_1'] + $wo_total['as_exp'] + $wo_total['reorder_pagi'] + $wo_total['reorder_sore'] + $wo_total['today_not_fu'] ?></a></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['waitsc'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['donesc'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['wait_act'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['prog_act'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['fact'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['comp'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['ps'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['p_nok'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['j_nok'] ?></td>
							<td class="bawah" style="vertical-align : middle;text-align:center;"><?= $wo_total['u_cons'] ?></td>
						</tr>
					</tbody>
				<?php } ?>
			</table>
			<table id="note">
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Deal H1</th>
					<td><i>: Deal Sales H1</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Deal H-1</th>
					<td><i>: Deal Sales H-1</i></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp</td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Pra Order</th>
					<td><i>: Order yang menjadi responsibility rekan Sales dan belum ready PT1 secara sistem</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Wait FCC</th>
					<td><i></i>: Order yang masih menunggu proses FCC</td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Kendala FCC</th>
					<td><i>: Order yang terkendala proses FCC</i></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp</td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Amunisi</th>
					<td><i>: Order PT1 yang sudah siap secara sistem (PI/INBOX SCBE/Inbox RISMA)</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Pagi</th>
					<td><i>: Order PT1 yang PI/INBOX SCBE/INBOX Risma sebelum jam 12 siang</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Sore</th>
					<td><i>: Order PT1 yang PI/INBOX SCBE/INBOX Risma setelah jam 12 siang</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> AS H-1</th>
					<td><i>: Order PT1 deal H-1</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> AS EXP</th>
					<td><i>: Order PT1 deal H-2</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Re Pagi</th>
					<td><i>: Order PT1 Ex kendala sebelum jam 12 siang</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Re Sore</th>
					<td><i>: Order PT1 Ex kendala setelah jam 12 siang</i></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp</td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Request SC</th>
					<td><i>: Order MYI sudah tarik PT1 masih req SC ke HD</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Wait SC</th>
					<td><i>: Order MYI sudah tarik PT1 menunggu SC</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Done SC</th>
					<td><i>: Order MYI sudah tarik PT1 dan sudah keluar SC</i></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp</td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Pelanggan NOK</th>
					<td><i>: Order terkendala pelanggan / Order yang menjadi responsibility rekan sales</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Jaringan NOK</th>
					<td><i>: Order kendala jaringan yang menjadi responsibility rekan ASO, AMO dan SDI</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Under Construction</th>
					<td><i>: Order masih proses Konstruksi yang menjadi responsibility rekan deployer dan SDI</i></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp</td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Progress Provisioning</th>
					<td><i>: Order masih proses aktivasi di HD</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Wait ACT</th>
					<td><i>: Order sudah minta create ke HD menunggu respon HD</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Prog ACT</th>
					<td><i>: Order masih progress aktivasi di HD</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Fallout</th>
					<td><i>: Order terkendala fallout aktivasi</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> Comp</th>
					<td><i>: Order sudah complete secara sistem menunggu testing</i></td>
				</tr>
				<tr>
					<th width=180><i class="icon md-check-circle"></i> PS</th>
					<td><i>: Order PS</i></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<script>
	$('#select_waktu').on('change', function() {
		var baseurl = "<?php echo site_url() ?>";
		var waktu = this.value;
		var unit = $('#unit_selected').val();
		var url = baseurl + 'welcome/index/' + waktu + '/' + unit;
		window.location = url;
	});

	$('#select_unit').on('change', function() {
		var baseurl = "<?php echo site_url() ?>";
		var unit = this.value;
		var waktu = $('#waktu_selected').val();
		var url = baseurl + 'welcome/index/' + waktu + '/' + unit;
		window.location = url;
	});
</script>