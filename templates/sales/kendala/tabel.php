<style type="text/css">
	table tr td a {

		color: black;

		text-decoration: none !important;

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

<div class="preloader"></div>

<div class="row">

	<div class="col-md-2">

		<select name="filter_segment" id="filter_segment" class="form-control" data-plugin="select2">

			<option value="all">Semua Order</option>

			<option value="psb" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'psb' ? 'selected' : '') : '' ?>>PSB</option>

			<option value="pda" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'pda' ? 'selected' : '') : '' ?>>PDA</option>

			<option value="addon" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'addon' ? 'selected' : '') : '' ?>>ADDON</option>

		</select>

	</div>

	<div class="col-md-2">

		<select name="filter_unit" id="filter_unit" class="form-control" data-plugin="select2">

			<option value="all">Semua Unit</option>

			<option value="dcs" <?= !empty($this->uri->segment(5)) ? ($this->uri->segment(5) == 'dcs' ? 'selected' : '') : '' ?>>DCS</option>

			<option value="egbis" <?= !empty($this->uri->segment(5)) ? ($this->uri->segment(5) == 'egbis' ? 'selected' : '') : '' ?>>EGBIS</option>

		</select>

	</div>

	<div class="col-md-2">

		<select name="filter_by_tgl" id="filter_by_tgl" class="form-control" data-plugin="select2">

			<option value="tgl_ja" <?= $this->uri->segment(6) == 'tgl_ja' ? 'selected' : ''; ?>>By tgl JA Masuk</option>

			<option value="tgl_kendala" <?= $this->uri->segment(6) == 'tgl_kendala' ? 'selected' : ''; ?>>By tgl Lapor Kendala</option>

		</select>

	</div>

	<div class="col-md-3">

		<button type="button" class="btn btn-primary" id="daterange-btn"><span><i class="icon md-calendar"></i> &nbsp; Filter Tanggal</span> &nbsp; <i class="icon md-caret-down"></i></button>

	</div>

	<div class="col-md-3 float-right">

		<form autocomplete="off" action="<?= site_url('sales/kendala/search') ?>" method="POST">

			<div class="form-group">

				<div class="input-search">

					<?php if (aksesOrderRequestSCKendalaProvi($this->session->userdata('level'))) { ?>
						<button type="submit" class="input-search-btn"><i class="icon md-search" aria-hidden="true"></i></button>
						<input type="text" class="form-control" name="search" placeholder="Search JA/CP/SC/MYI">
					<?php } else { ?>
						<button type="submit" class="input-search-btn" disabled><i class="icon md-search" aria-hidden="true"></i></button>
						<input type="text" class="form-control" name="search" placeholder="Search JA/CP/SC/MYI" readonly>
					<?php } ?>

				</div>

			</div>

		</form>

	</div>

</div>

<br>

<div class="table-responsive">

	<table class="table table-bordered table-sm">

		<thead>

			<tr>

				<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">DATEL</th>

				<th colspan="6" style="text-align: center; background: #1E88E5; color: #fff;">KENDALA PELANGGAN</th>

				<th colspan="3" style="vertical-align : middle;text-align:center;background: #43A047; color: #fff;">KENDALA INSTALASI</th>

				<th colspan="3" style="vertical-align : middle;text-align:center;background: #0E185F; color: #fff;">MAINTENANCE</th>

				<th colspan="4" style="vertical-align : middle;text-align:center;background: #495371; color: #fff;">KENDALA TEKNIS</th>

				<th rowspan="2" style="vertical-align : middle;text-align:center; background: #F0A500; color: #000;">ON CONSTRUCTION</th>

				<th rowspan="2" style="vertical-align : middle;text-align:center; background: #F0A500; color: #000;">TOTAL</th>

				<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">NEXT PROJECT</th>

				<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">TERMINATE</th>

			</tr>

			<tr>

				<th style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">RNA</th>

				<th style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">ALAMAT</th>

				<th style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">PENDING</th>

				<th style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">PLGN BATAL</th>

				<th style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">IZIN TANAM TIANG</th>

				<th style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">NJKI</th>

				<th style="vertical-align : middle;text-align:center;background: #43A047; color: #fff;">TIANG</th>

				<th style="vertical-align : middle;text-align:center;background: #43A047; color: #fff;">RUTE INSTALASI</th>

				<th style="vertical-align : middle;text-align:center;background: #43A047; color: #fff;">PENDING INSTALASI</th>

				<th style="vertical-align : middle;text-align:center;background: #0E185F; color: #fff;">ODP LOS</th>

				<th style="vertical-align : middle;text-align:center;background: #0E185F; color: #fff;">ODP RETI</th>

				<th style="vertical-align : middle;text-align:center;background: #0E185F; color: #fff;">ONU > 32</th>

				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">ODP BLM GOLIVE</th>

				<th style="vertical-align : middle;text-align:center;background: #495371; color: #fff;">ODP FULL</th>

				<th style="vertical-align : middle;text-align:center;background: #495371; color: #fff;">PT2</th>

				<th style="vertical-align : middle;text-align:center;background: #495371; color: #fff;">NO FO/ODP</th>

			</tr>

		</thead>

		<tbody id="tabel_kendala">

			<?php foreach ($list_k as $key) { ?>

				<tr>

					<td><?= datel_witel($key['datel']) ?></td>

					<td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=rna&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['rna'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=alamat&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['alamat'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=pending&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['pending'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=batal&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['batal'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=ijin_tanam_tiang&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['ijin_tanam_tiang'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=njki&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['njki'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=tiang&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['tiang'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=rute&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['rute'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=pending_instalasi&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['pending_instalasi'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=odp_loss&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['odp_loss'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=odp_reti&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['odp_reti'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=onu_32&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['onu_32'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=odp_blm_live&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['odp_blm_live'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=odp_full&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['odp_full'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=pt_dua&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['pt_dua'] ?></a></td>

					<td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=no_fo&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['no_fo'] ?></a></td>

					<td style="vertical-align : middle;text-align:center;background: #fff2d6;"><a href="<?= site_url('sales/construction/show?datel=' . $key['datel'] . '&cons=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['on_cons'] ?></a></td>

					<td style="vertical-align : middle;text-align:center;background: #fff2d6;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=all&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['subtotal'] ?></a></td>

					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=' . $key['datel'] . '&cons=next_project&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['next_project'] ?></a></td>

					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=' . $key['datel'] . '&kendala=terminate&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $key['terminate'] ?></a></td>

				</tr>

			<?php } ?>

			<tr>

				<th rowspan="2" class="bawah" style="text-align: center;vertical-align : middle;">TOTAL</th>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=rna&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['rna'] ?></a></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=alamat&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['alamat'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=pending&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['pending'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=batal&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['batal'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=ijin_tanam_tiang&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['ijin_tanam_tiang'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=njki&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['njki'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=tiang&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['tiang'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=rute&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['rute'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=pending_instalasi&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['pending_instalasi'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=odp_loss&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['odp_loss'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=odp_reti&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['odp_reti'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=onu_32&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['onu_32'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=odp_blm_live&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['odp_blm_live'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=odp_full&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['odp_full'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=pt_dua&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['pt_dua'] ?></td>

				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=no_fo&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['no_fo'] ?></td>

				<td rowspan="2" class="bawah" style="vertical-align:middle; text-align:center;"><a href="<?= site_url('sales/construction/show?datel=all&cons=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['on_cons'] ?></td>

				<td rowspan="2" class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=all&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['subtotal'] ?></td>

				<td rowspan="2" class="bawah" style="vertical-align:middle; text-align:center;"><a href="<?= site_url('sales/construction/show?datel=all&cons=next_project&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['next_project'] ?></td>

				<td rowspan="2" class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=terminate&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['terminate'] ?></td>

			</tr>

			<tr>

				<td class="bawah" colspan="6" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=pelanggan&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['all_kp'] ?></a></td>

				<td class="bawah" colspan="3" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=installasi&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['all_ki'] ?></a></td>

				<td class="bawah" colspan="3" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=maintenance&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['all_m'] ?></a></td>

				<td class="bawah" colspan="4" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=teknis&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['all_t'] ?></a></td>

			</tr>

		</tbody>

	</table>



	<table id="note">

		<tr>

			<th width=180><i class="icon md-check-circle"></i> Kendala Pelanggan </th>

			<td><i>: Order kendala yang menjadi responsibility dari rekan sales</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> RNA</th>

			<td><i>: Kendala karena nomor handphone pelanggan tidak dapat dihubungi</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> Alamat</th>

			<td><i>: Kendala karena alamat pelanggan tidak ketemu</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> Pending</th>

			<td><i>: Kendala karena pelanggan melakukan pending pemasangan </i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> Pelanggan Batal</th>

			<td><i>: Kendala karena pelanggan mengajukan batal pasang</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> Ijin tanam tiang</th>

			<td><i>: Kendala karena tanam tiang terkendala ijin lokasi</i></td>

		</tr>

		<tr>

			<td colspan="2">&nbsp</td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> Kendala Instalasi</th>

			<td><i>: Order kendala yang menjadi resonsibility dari rekan ASO / HERO</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> Tiang</th>

			<td><i>: Order butuh tanam tiang dan ijin sudah oke</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> Rute Instalasi</th>

			<td><i>: Kendala karena rute instalasi pelanggan yang sulit / tidak spek (gang sempit, melewati rumah pelanggan)</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> Pending Instalasi</th>

			<td><i>: Kendala karena teknisi melakukan pending pemasangan</i></td>

		</tr>

		<tr>

			<td colspan="2">&nbsp</td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> Kendala Maintenance</th>

			<td><i>: Order kendala yang menjadi responsibility dari rekan AMO</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> ODP loss</th>

			<td><i>: Kendala karena ODP di lapangan sudah Golive tetapi Loss / tidak ada redaman</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> ODP Reti</th>

			<td><i>: Kendala karena ODP di lapangan sudah Golive tetapi redaman di ODP tinggi (>22 dB)</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> ODP Belum Live</th>

			<td><i>: Kendala karena ODP di lapangan ODP loss / redaman tinggi tetapi ODP tersebut belum Golive</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> ONU > 32</th>

			<td><i>: Kendala karena slot ONU di ODP lapangan > 32 pelanggan</i></td>

		</tr>

		<tr>

			<td colspan="2">&nbsp</td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> Kendala Teknis </th>

			<td><i>: Order kendala yang membutuhkan pembangunan jaringan baru</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> ODP Full</th>

			<td><i>: Kendala karena port ODP di lapangan penuh, setelah dilakukan Valins</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> PT2</th>

			<td><i>: Kendala karena di lapangan butuh pembangunan PT2</i></td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> NO FO / ODP</th>

			<td><i>: Kendala karena di lokasi pelanggan tidak ada jaringan FO / ODP dan belum ada rute</i></td>

		</tr>

		<tr>

			<td colspan="2">&nbsp</td>

		</tr>

		<tr>

			<th width=180><i class="icon md-check-circle"></i> TERMINATE</th>

			<td><i>: Order kendala sudah dilakukan Validasi oleh rekan sales dan akan dilakukan cancel</i></td>

		</tr>

	</table>

</div>



<script>
	$(document).ready(function() {

		$(".preloader").preloader();

		setTimeout(() => {

			$(".preloader").fadeOut();

		}, 1000);

		$('#daterange-btn').daterangepicker(

			{

				closeOnSelect: true,

				showDropdowns: true,

				minYear: 2021,

				maxYear: parseInt(moment().format('YYYY'), 10),

				ranges: {

					'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],

					'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],

					'2 Bulan Lalu': [moment().subtract(2, 'month').startOf('month'), moment().subtract(2, 'month').endOf('month')],

					'3 Bulan Lalu': [moment().subtract(3, 'month').startOf('month'), moment().subtract(3, 'month').endOf('month')],

					'Tahun Ini': [moment().startOf('year'), moment().endOf('year')],

					'Tahun Lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],

				},

				startDate: moment().subtract(29, 'days'),

				endDate: moment()

			},

			function(start, end) {

				let base_url = '<?php echo base_url() ?>';

				let segment = $('#filter_segment').val();

				let unit = $('#filter_unit').val();

				window.location.replace(base_url + "index.php/sales/kendala/index/" + segment + "/" + unit + "/" + $('#filter_by_tgl').val() + "/" + start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD'));

			}

		)

	});



	$("#filter").change(function() {

		sel = $('#filter').val();

		ambil_data(sel);

	});



	$("#filter_segment").change(function() {

		segment = $('#filter_segment').val();

		let base_url = '<?php echo base_url() ?>';

		window.location.replace(base_url + "sales/kendala/index/" + segment);

	});



	$("#filter_unit").change(function() {

		segment = $('#filter_segment').val();

		unit = $('#filter_unit').val();

		let base_url = '<?php echo base_url() ?>';

		window.location.replace(base_url + "sales/kendala/index/" + segment + "/" + unit);

	});



	function ambil_data(sel) {

		if (sel == 'all') {

			urlto = "<?php echo site_url('sales/kendala/kendala_all') ?>";

		} else {

			urlto = "<?php echo site_url('sales/kendala/kendala_today') ?>";

		}

		$.ajax({

			url: urlto,

			type: "GET",

			dataType: "JSON",

			success: function(data)

			{

				let isi = '';



				for (let i = 0; i < data.isi.length; i++) {

					isi += '<tr>' +

						'<td style="vertical-align : middle;text-align:center;">' + data.isi[i].datel + '</td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=rna&waktu=' + sel + '">' + data.isi[i].rna + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=alamat&waktu=' + sel + '">' + data.isi[i].alamat + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=pending&waktu=' + sel + '">' + data.isi[i].pending + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=batal&waktu=' + sel + '">' + data.isi[i].batal + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=ijin_tanam_tiang&waktu=' + sel + '">' + data.isi[i].ijin_tanam_tiang + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=njki&waktu=' + sel + '">' + data.isi[i].njki + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=tiang&waktu=' + sel + '">' + data.isi[i].tiang + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=rute&waktu=' + sel + '">' + data.isi[i].rute + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=odp_loss&waktu=' + sel + '">' + data.isi[i].odp_loss + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=odp_reti&waktu=' + sel + '">' + data.isi[i].odp_reti + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=onu_32&waktu=' + sel + '">' + data.isi[i].onu_32 + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=odp_full&waktu=' + sel + '">' + data.isi[i].odp_full + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=pt_dua&waktu=' + sel + '">' + data.isi[i].pt_dua + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=no_fo&waktu=' + sel + '">' + data.isi[i].no_fo + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=all&waktu=' + sel + '">' + data.isi[i].subtotal + '</a></td>' +

						'<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=terminate&waktu=' + sel + '">' + data.isi[i].terminate + '</a></td>' +



						'</tr>';

				}



				isi += '<tr>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;">TOTAL</td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=rna&waktu=' + sel + '">' + data.total.rna + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=alamat&waktu=' + sel + '">' + data.total.alamat + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=pending&waktu=' + sel + '">' + data.total.pending + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=batal&waktu=' + sel + '">' + data.total.batal + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=ijin_tanam_tiang&waktu=' + sel + '">' + data.total.ijin_tanam_tiang + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=njki&waktu=' + sel + '">' + data.total.njki + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=tiang&waktu=' + sel + '">' + data.total.tiang + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=rute&waktu=' + sel + '">' + data.total.rute + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=odp_loss&waktu=' + sel + '">' + data.total.odp_loss + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=odp_reti&waktu=' + sel + '">' + data.total.odp_reti + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=onu_32&waktu=' + sel + '">' + data.total.onu_32 + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=odp_full&waktu=' + sel + '">' + data.total.odp_full + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=pt_dua&waktu=' + sel + '">' + data.total.pt_dua + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=no_fo&waktu=' + sel + '">' + data.total.no_fo + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=all&waktu=' + sel + '">' + data.total.subtotal + '</a></td>' +

				'<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=terminate&waktu=' + sel + '">' + data.total.terminate + '</a></td>' +

				'</tr>';



				$("#tabel_kendala").html(isi);

			},

			error: function(jqXHR, textStatus, errorThrown)

			{

				alert('Error get data from ajax');

			}

		});

	}
</script>