<style type="text/css">
	@media (min-width: 768px) {

		.modal-xl {

			width: 90%;

			max-width: 1200px;

		}

	}

	table thead th {

		font-weight: bold !important;

	}

	.floatThead-container {

		margin-top: -6px !important;

	}
</style>

<form autocomplete="off" action="<?= site_url('sales/sc_update/search_sc') ?>" method="POST">

	<div class="row">

		<div class="col-md-4">

			<div class="form-group">

				<label class="control-label">SC / MYIR / CP</label>

				<input name="search" class="form-control" type="text">

				<span class="help-block"></span>

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



<!-- Panel Basic -->

<div class="panel panel-success panel-line">

	<header class="panel-heading">

		<div class="panel-actions"></div>

		<h3 class="panel-title"><?= $subtitle ?></h3>

	</header>

	<div class="panel-body">

		<?php if (empty($results)) {

			echo "<div class='alert alert-warning' role='alert'><strong>Sorry..!!</strong> no data found :(</div>";
		} ?>

		<div id="pesan" style="margin: 10px 5px;"></div>

		<div class="example table-responsive">

			<table class="table table-hover dataTable table-striped" id="exampleTableTools" data-plugin="floatThead">

				<thead>

					<tr>

						<th>JA</th>

						<th>UNIT</th>

						<th>Pelanggan</th>

						<th>Alamat</th>

						<th>Email</th>

						<th>CP</th>

						<th>ODP</th>

						<th>SC</th>

						<th>MYIR</th>

						<th>TGL MASUK</th>

						<th>DARI</th>

						<th>Last Update</th>

						<th>BY</th>

						<th>STATUS</th>

						<th>FAILWA</th>

						<?php if (updateViaSearch($this->session->userdata('level'))) { ?>

							<th><i class="fa fa-gear"></i></th>

						<?php } ?>

					</tr>

				</thead>

				<tbody>

					<?php $no = 1;
					foreach ($results as $row) { ?>



						<tr>

							<td><?= $row['sales_id'] ?></td>

							<td><?= $row['unit'] ?></td>

							<td><?= $row['nama_pelanggan'] ?></td>

							<td><?= $row['alamat'] ?></td>

							<td><?= $row['email'] ?></td>

							<td><?= $row['cp'] ?></td>

							<td><?= $row['odp'] ?></td>

							<td><?= $row['new_sc'] ?></td>

							<td><?= $row['myir'] ?></td>

							<td><?= $row['tgl_post'] ?></td>

							<td><?= $row['nama_sales'] ?></td>

							<td><?= $row['tgl_update'] ?></td>

							<td><?= $row['user_update'] ?></td>

							<td><?= $row['status'] ?></td>

							<td><?= $row['failwa'] == 0 ? "-" : "FAILWA" ?></td>

							<?php if (updateViaSearch($this->session->userdata('level'))) { ?>

								<td width="100">

									<button type="button" class="btn btn-icon btn-flat btn-primary" data-toggle="tooltip" data-original-title="Follow Up" onclick="detail(<?= $row['sales_id']; ?>)"><i class="icon md-edit"></i></button>

									<?php if (cannotDelete($this->session->userdata('level')) == false) { ?>
										<button type="button" class="btn btn-icon btn-flat btn-danger" data-toggle="tooltip" data-original-title="Delete" onclick="delete_data(<?= $row['sales_id']; ?>)"><i class="icon md-close"></i></button>
									<?php } ?>

								</td>

							<?php } ?>

						</tr>

					<?php } ?>

				</tbody>

			</table>

		</div>

	</div>

</div>

<!-- End Panel Basic -->



<script type="text/javascript">
	var save_method;

	var table;



	$("input").change(function() {

		$(this).parent().parent().removeClass('has-error');

		$(this).next().empty();

	});

	$("textarea").change(function() {

		$(this).parent().parent().removeClass('has-error');

		$(this).next().empty();

	});



	function detail(id)

	{

		//save_method = 'update';

		$('#form')[0].reset(); // reset form on modals

		$('.form-group').removeClass('has-error'); // clear error class

		$('.help-block').empty(); // clear error string



		//Ajax Load data from ajax

		$.ajax({

			url: "<?php echo site_url('sales/sc_update/detail') ?>/" + id,

			type: "GET",

			dataType: "JSON",

			success: function(data)

			{



				$('[name="id"]').val(data.sales_id);

				$('[name="segment"]').val(data.segment);

				$('[name="nama_pelanggan"]').val(data.nama_pelanggan);

				$('[name="datel"]').val(data.datel).trigger('change');

				$('[name="meid"]').val(data.message_id);

				$('[name="mefrom"]').val(data.fullname == null ? '233116801' : data.message_from);

				$('[name="no_ktp"]').val(data.no_ktp);

				$('[name="alamat"]').val(data.alamat);

				$('[name="cp"]').val(data.cp);

				$('[name="lat_long"]').val(data.lat_long);

				$('[name="email"]').val(data.email);

				$('[name="odp"]').val(data.odp);

				$('[name="kode"]').val(data.kode);

				$('[name="paket"]').val(data.paket);

				$('[name="jarak_tiang"]').val(data.jarak_tiang);

				$('[name="myir"]').val(data.myir);

				$('[name="sc"]').val(data.sc);

				$('[name="tgl_masuk"]').val(data.tgl_post);

				$('[name="req_sc_by"]').val(data.req_sc_by);

				$('[name="status"]').val(data.status);

				$('[name="status_id"]').val(data.status_id);

				$('[name="failwa"]').val(data.failwa).trigger('change');

				$('[name="sales_name"]').val(data.fullname == null ? 'Anonim' : data.fullname);

				if (data.status_id == 10) {

					$("#new_sc").prop('readonly', true);

					$("#sc_lama").prop('readonly', true);

				} else if (data.sc != null) {

					$("#new_sc").prop('readonly', false);

				} else {

					$("#new_sc").prop('readonly', true);

					$("#sc_lama").prop('readonly', false);

				}

				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded

				$('.modal-title').text('Order Detail'); // Set title to Bootstrap modal title



			},

			error: function(jqXHR, textStatus, errorThrown)

			{

				alert('Error get data from ajax');

			}

		});

	}



	function delete_data(id)

	{

		Swal.fire({
			title: 'Anda Yakin?',
			text: "Anda ingin menghapus data ini!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus data ini!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({

					url: "<?php echo site_url('sales/sc_update/delete') ?>/" + id,

					type: "POST",

					dataType: "JSON",

					success: function(data)

					{

						Swal.fire(
							'Terhapus!',
							'Data tersebut sudah terhapus.',
							'success'
						).then((result) => {
							location.replace("https://sales.jarvisid.com/");
						});

					},

					error: function(jqXHR, textStatus, errorThrown)

					{

						alert('Error deleting data');

					}

				});
			}
		});

	}



	function save()

	{

		$('#btnSave').text('saving...'); //change button text

		$('#btnSave').attr('disabled', true); //set button disable

		var url;



		url = "<?php echo site_url('sales/sc_update/update') ?>";



		// ajax adding data to database

		$.ajax({

			url: url,

			type: "POST",

			data: $('#form').serialize(),

			dataType: "JSON",

			success: function(data)

			{



				if (data.status) //if success close modal and reload ajax table

				{

					$('#modal_form').modal('hide');

					document.getElementById('pesan').innerHTML = data.pesan;

				} else

				{

					for (var i = 0; i < data.inputerror.length; i++)

					{

						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class

						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string

					}

				}

				$('#btnSave').text('save'); //change button text

				$('#btnSave').attr('disabled', false); //set button enable





			},

			error: function(jqXHR, textStatus, errorThrown)

			{

				alert('Error adding / update data');

				$('#btnSave').text('save'); //change button text

				$('#btnSave').attr('disabled', false); //set button enable



			}

		});

	}
</script>



<!-- Bootstrap modal -->

<div class="modal fade modal-3d-sign" id="modal_form" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">

	<div class="modal-dialog modal-xl">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">×</span>

				</button>

				<h4 class="modal-title">Follow Up Order</h4>

			</div>

			<div class="modal-body form">

				<form action="#" id="form">

					<input type="hidden" value="" name="id" />

					<input type="hidden" value="" name="segment" />

					<input type="hidden" value="" name="meid" />

					<input type="hidden" value="" name="mefrom" />

					<input type="hidden" value="" name="sales_name" />

					<input type="hidden" value="" name="req_sc_by" />

					<input type="hidden" value="" name="status_id" id="status_id" />

					<div class="form-body">

						<div class="row">

							<div class="col-md-3">

								<div class="form-group">

									<label class="control-label">DATEL :</label>

									<div class="col-md-12">

										<select name="datel" class="form-control" data-plugin="select2">

											<option value="">--Pilih Datel--</option>

											<option value="PKL1">PEKALONGAN 1</option>

											<option value="PKL2">PEKALONGAN 2</option>

											<option value="BTG">BATANG</option>

											<option value="PML">PEMALANG</option>

											<option value="TEG">TEGAL</option>

											<option value="BRB">BREBES</option>

											<option value="SLW">SLAWI</option>

										</select>

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">NAMA :</label>

									<div class="col-md-12">

										<input name="nama_pelanggan" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">KTP :</label>

									<div class="col-md-12">

										<input name="no_ktp" class="form-control" type="text" readonly>

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">ALAMAT :</label>

									<div class="col-md-12">

										<textarea name="alamat" class="form-control"></textarea>

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">CP :</label>

									<div class="col-md-12">

										<input name="cp" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

							</div>

							<div class="col-md-3">

								<div class="form-group">

									<label class="control-label">EMAIL :</label>

									<div class="col-md-12">

										<input name="email" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">LOKASI :</label>

									<div class="col-md-12">

										<input name="lat_long" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">PAKET :</label>

									<div class="col-md-12">

										<input name="paket" class="form-control" type="text" readonly>

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">JARAK :</label>

									<div class="col-md-12">

										<input name="jarak_tiang" class="form-control" type="text" readonly>

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">KD SALES:</label>

									<div class="col-md-12">

										<input name="kode" class="form-control" type="text" readonly>

										<span class="help-block"></span>

									</div>

								</div>

							</div>

							<div class="col-md-3">

								<div class="form-group">

									<label class="control-label">ODP :</label>

									<div class="col-md-12">

										<input name="odp" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">MYIR:</label>

									<div class="col-md-12">

										<input name="myir" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">TGL MASUK:</label>

									<div class="col-md-12">

										<input name="tgl_masuk" class="form-control" type="text" readonly>

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">STATUS ORDER:</label>

									<div class="col-md-12">

										<input name="status" class="form-control" type="text" readonly>

										<span class="help-block"></span>

									</div>

								</div>

							</div>

							<div class="col-md-3">

								<div class="form-group">

									<label class="control-label">SC :</label>

									<div class="col-md-12">

										<input name="sc" id="sc_lama" class="form-control" type="text" readonly>

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">SC BARU:</label>

									<div class="col-md-12">

										<input name="new_sc" id="new_sc" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">KETERANGAN :</label>

									<div class="col-md-12">

										<textarea name="ket" class="form-control" rows="5" placeholder="misal: DONE"></textarea>

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">STATUS FAILWA :</label>

									<div class="col-md-12">

										<select name="failwa" class="form-control" data-plugin="select2">

											<option value="0">NO FAILWA</option>

											<option value="1">FAILWA</option>

										</select>

									</div>

								</div>

							</div>

						</div>

					</div>

				</form>

			</div>

			<div class="modal-footer">

				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>

				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

			</div>

		</div><!-- /.modal-content -->

	</div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<!-- End Bootstrap modal -->