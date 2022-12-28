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
	.bawah{
		background-color: #616161;
		color: #fff;
	}
	.bawah a{
		color: #fff !important;
	}
</style>
<div class="row">
	<div class="col-md-2">
		<select name="filter_segment" id="filter_segment" class="form-control" data-plugin="select2">
			<option value="all">Semua</option>
			<option value="psb" <?= $this->uri->segment(4) == 'psb' ? 'selected' : '' ?>>PSB</option>
			<option value="pda" <?= $this->uri->segment(4) == 'pda' ? 'selected' : '' ?>>PDA</option>
			<option value="addon" <?= $this->uri->segment(4) == 'addon' ? 'selected' : '' ?>>ADDON</option>
		</select>
	</div>
	<div class="col-md-2">
		<select name="filter_by_tgl" id="filter_by_tgl" class="form-control" data-plugin="select2">
			<option value="tgl_ja" <?= $this->uri->segment(5) == 'tgl_ja' ? 'selected' : '' ?> >By tgl JA Masuk</option>
			<option value="tgl_kendala" <?= $this->uri->segment(5) == 'tgl_kendala' ? 'selected' : '' ?>>By tgl Lapor Kendala</option>
		</select>
	</div>
	<div class="col-md-5">
		<button type="button" class="btn btn-primary" id="daterange-btn"><span><i class="icon md-calendar"></i> &nbsp; Filter Tanggal</span> &nbsp; <i class="icon md-caret-down"></i></button> &nbsp;
        <a href="<?= site_url('sales/kendala') ?>" class="btn btn-warning"><i class="icon md-refresh"></i> Reset</a>
	</div>
	<div class="col-md-3 float-right">
		<form autocomplete="off" action="<?= site_url('sales/kendala/search') ?>" method="POST">
			<div class="form-group">
				<div class="input-search">
					<button type="submit" class="input-search-btn"><i class="icon md-search" aria-hidden="true"></i></button>
					<input type="text" class="form-control" name="search" placeholder="Search JA..">
				</div>
			</div>
		</form>
	</div>
</div>
<br>
<?php if (!empty($this->uri->segment(6))) { ?>
<p>
	Tanggal : <?= date_indo($start).' s/d '.date_indo($end) ?>
</p>
<?php } ?>
<div class="table-responsive">
	<table class="table table-bordered table-sm">
		<thead>
			<tr>
				<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">DATEL</th>
				<th colspan="6" style="text-align: center; background: #1E88E5; color: #fff;">KENDALA PELANGGAN</th>
				<th colspan="2" style="vertical-align : middle;text-align:center;background: #43A047; color: #fff;">KENDALA INSTALASI</th>
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
					<td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/rna/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.' ') ?> "><?= $key['rna'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/alamat/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['alamat'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/pending/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['pending'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/batal/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['batal'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/ijin_tanam_tiang/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['ijin_tanam_tiang'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/tiang/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['tiang'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/rute/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['rute'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/njki/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['njki'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/odp_loss/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['odp_loss'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/odp_reti/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['odp_reti'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/onu_32/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['onu_32'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/odp_blm_live/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['odp_blm_live'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/odp_full/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['odp_full'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/pt_dua/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['pt_dua'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/no_fo/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['no_fo'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/construction/show_filtered/'.$key['datel'].'/all/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).' ') ?>"><?= $key['on_cons'] ?></a></td>
					<td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/all/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['subtotal'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show_filtered/'.$key['datel'].'/next_project/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).' ') ?>') ?>"><?= $key['next_project'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/'.$key['datel'].'/terminate/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $key['terminate'] ?></a></td>
				</tr>
			<?php } ?>
				<tr>
					<th rowspan="2" class="bawah" style="text-align: center;vertical-align : middle;">TOTAL</th>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/rna/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['rna'] ?></a></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/alamat/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['alamat'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/pending/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['pending'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/batal/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['batal'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/ijin_tanam_tiang/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['ijin_tanam_tiang'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/tiang/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['tiang'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/rute/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['rute'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/njki/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['njki'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/odp_loss/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['odp_loss'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/odp_reti/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['odp_reti'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/onu_32/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['onu_32'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/odp_blm_live/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['odp_blm_live'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/odp_full/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['odp_full'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/pt_dua/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['pt_dua'] ?></td>
					<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/no_fo/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['no_fo'] ?></td>
					<td rowspan="2" class="bawah" style="vertical-align:middle; text-align:center;"><a href="<?= site_url('sales/construction/show_filtered/all/all/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'') ?>"><?= $k_total['on_cons'] ?></td>
					<td rowspan="2" class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/all/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['subtotal'] ?></td>
					<td rowspan="2" class="bawah" style="vertical-align:middle; text-align:center;"><a href="<?= site_url('sales/construction/show_filtered/all/next_project/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'') ?>"><?= $k_total['next_project'] ?></td>
					<td rowspan="2" class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_filtered/all/terminate/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$segment.'') ?> "><?= $k_total['terminate'] ?></td>
				</tr>
				<tr>
					<td class="bawah" colspan="6" style="vertical-align : middle;text-align:center;"><a href="#"><?= $k_total['all_kp'] ?></a></td>
					<td class="bawah" colspan="2" style="vertical-align : middle;text-align:center;"><a href="#"><?= $k_total['all_ki'] ?></a></td>
					<td class="bawah" colspan="3" style="vertical-align : middle;text-align:center;"><a href="#"><?= $k_total['all_m'] ?></a></td>
					<td class="bawah" colspan="4" style="vertical-align : middle;text-align:center;"><a href="#"><?= $k_total['all_t'] ?></a></td>
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
			<th width=180><i class="icon md-check-circle"></i> NJKI</th>
			<td><i>: Kendala karena satu pelanggan tanam tiang lebih dari 2 tiang sehingga membutuhkan penambahan pelanggan</i></td>
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
			<td><i>: Kendala karena order membutuhkan tanam tiang standar (1 pelanggan maksimal 2 tiang)</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Rute Instalasi</th>
			<td><i>: Kendala karena rute instalasi pelanggan yang sulit / tidak spek (gang sempit, melewati rumah pelanggan)</i></td>
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
		$('#daterange-btn').daterangepicker(
		{
			closeOnSelect: true,
			showDropdowns: true,
			minYear: 2020,
			maxYear: parseInt(moment().format('YYYY'),10),
			ranges   : {
			'Bulan Ini'     : [moment().startOf('month'), moment().endOf('month')],
			'Bulan Kemarin' : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
			'2 Bulan Lalu'  : [moment().subtract(2, 'month').startOf('month'), moment().subtract(2, 'month').endOf('month')],
			'3 Bulan Lalu'  : [moment().subtract(3, 'month').startOf('month'), moment().subtract(3, 'month').endOf('month')],
			'Tahun Ini'     : [moment().startOf('year'), moment().endOf('year')],
			'Tahun Lalu'    : [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
			},
			startDate: moment().subtract(29, 'days'),
			endDate  : moment()
		},
		function (start, end) {
				let base_url = '<?php echo base_url() ?>';
				let sel = $('#filter_segment').val();
				window.location.replace(base_url+"index.php/sales/kendala/filter/"+sel+"/"+$('#filter_by_tgl').val()+"/"+start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD'));
		}
		)
	});

	$("#filter_segment").change(function(){
		sel = $('#filter_segment').val();
        let base_url = '<?php echo base_url() ?>';
		window.location.replace(base_url+"sales/kendala/index/"+sel);
    });
</script>