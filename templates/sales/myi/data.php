<style type="text/css">
	@media (min-width: 768px) {

		.modal-xl {

			width: 90%;

			max-width: 1200px;

		}

	}

	.group>thead>tr>th {

		vertical-align: middle;

		text-align: center;

		background: #DC3545;

		color: #fff;

	}

	.group>tbody>tr>td {

		vertical-align: middle;

		text-align: center;

	}

	table thead th {

		font-weight: bold !important;

	}

	.floatThead-container {

		margin-top: -6px !important;

	}
</style>

<div id="pesan" style="margin: 10px 5px;"></div>

<div class="table-responsive">

	<table class="table table-hover dataTable table-striped" id="table" data-plugin="floatThead" width="100%">

		<thead>

			<tr>

				<th width="100"><i class="icon md-wrench"></i></th>

				<th>UNIT</th>

				<th>STATUS</th>

				<th>JA</th>

				<th>DATEL</th>

				<th>PLGN</th>

				<th>MYIR</th>

				<th>CP</th>

				<th>ODP</th>

				<th>TGL MASUK</th>

				<th>FROM</th>

				<th>HD</th>

				<th>KETERANGAN</th>

			</tr>

		</thead>

		<tbody>



		</tbody>

	</table>

</div>



<!-- <div class="row">

    <div class="col-lg-5">

        <table class="table table-bordered table-sm group">

            <thead>

                <tr>

                    <th>DATEL</th>

                    <th>WAIT SC</th>

                    <th>BLM DEPO</th>

                    <th>KENDALA SC</th>

                    <th>PROG FCC</th>

                    <th>TOTAL</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($tabel_grup as $key) { ?>

                    <tr>

                        <td><?= $key['datel'] ?></td>

                        <td><?= $key['waitsc'] ?></td>

                        <td><?= $key['blmdepo'] ?></td>

                        <td><?= $key['kendalasc'] ?></td>

                        <td><?= $key['progfcc'] ?></td>

                        <td><?= $key['total'] ?></td>

                    </tr>

                <?php } ?>

                <tr>

                    <td>TOTAL</td>

                    <td><?= $tabel_total['waitsc'] ?></td>

                    <td><?= $tabel_total['blmdepo'] ?></td>

                    <td><?= $tabel_total['kendalasc'] ?></td>

                    <td><?= $tabel_total['progfcc'] ?></td>

                    <td><?= $tabel_total['total'] ?></td>

                </tr>

            </tbody>

        </table>

    </div>

</div> -->

<script type="text/javascript">
	var save_method;

	var table;



	$(document).ready(function() {



		//datatables

		table = $('#table').DataTable({



			"processing": true, //Feature control the processing indicator.

			"serverSide": true, //Feature control DataTables' server-side processing mode.

			"order": [], //Initial no order.

			"iDisplayLength": 100,

			"fixedHeader": true,

			"scrollX": true,

			"scrollY": "450px",

			"scrollCollapse": true,

			"sDom": '<"dt-panelmenu clearfix"Bfr>t<"dt-panelfooter clearfix"ip>',

			"buttons": ['copy', 'excel', 'csv', 'pdf'],



			// Load data for the table's content from an Ajax source

			"ajax": {

				"url": "<?php echo site_url('sales/dorong_myi/myi_list') ?>",

				"type": "POST"

			},



			"language": {

				"infoFiltered": ""

			},



			//Set column definition initialisation properties.

			"columnDefs": [

				{

					"targets": [-1], //last column

					"orderable": false, //set not orderable

				},

			],



		});



		setInterval(function() {

			table.ajax.reload();

		}, 60000);



		//set input/textarea/select event when change value, remove class error and remove text help block

		$("input").change(function() {

			$(this).parent().parent().removeClass('has-error');

			$(this).next().empty();

		});

		$("textarea").change(function() {

			$(this).parent().parent().removeClass('has-error');

			$(this).next().empty();

		});

		$("#status_update").change(function() {

			//console.log(this.value);

			if (this.value == 'donesc') {

				$('#status_id').val('5')

			} else if (this.value == 'kendalasc') {

				$('#status_id').val('12')

			} else if (this.value == 'ogpsc') {

				$('#status_id').val('31')

			} else if (this.value == 'kosongkan_odp') {

				$('#status_id').val('32')

			} else if (this.value == 'wait_risma') {

				$('#status_id').val('33')

			}

		});

	});



	$("input").change(function() {

		$(this).parent().parent().removeClass('has-error');

		$(this).next().empty();

	});

	$("textarea").change(function() {

		$(this).parent().parent().removeClass('has-error');

		$(this).next().empty();

	});



	function reload_table()

	{

		table.ajax.reload(null, false);

	}



	function detail(id)

	{

		//save_method = 'update';

		$('#form')[0].reset(); // reset form on modals

		$('.form-group').removeClass('has-error'); // clear error class

		$('.help-block').empty(); // clear error string



		//Ajax Load data from ajax

		$.ajax({

			url: "<?php echo site_url('sales/dorong_myi/detail') ?>/" + id,

			type: "GET",

			dataType: "JSON",

			success: function(data)

			{



				$('[name="id"]').val(data.sales_id);

				$('[name="nama_pelanggan"]').val(data.nama_pelanggan);

				$('[name="datel"]').val(data.datel).trigger('change');

				$('[name="meid"]').val(data.message_id);

				$('[name="mefrom"]').val(data.message_from);

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

				$('[name="status"]').val(data.status);

				$('[name="sales_name"]').val(data.fullname);

				$('[name="req_sc_odp"]').val(data.req_sc_odp);

				$('[name="req_sc_port"]').val(data.req_sc_port);

				$('[name="req_sc_dc"]').val(data.req_sc_dc);

				$('[name="req_sc_by"]').val(data.req_sc_by);

				$('[name="ket"]').val(data.keterangan);

				$("status_update").prop('required', true);



				if (data.status_id == 3) {

					$("#sc").prop("disabled", true);

					$('#status_update').empty().append('<option selected="selected" value="">--Pilih Status Order--</option>');

					$("#status_update").append(new Option("OGP", "ogpsc"));

				} else if (data.status_id > 3) {

					$("#sc").prop("disabled", false);

					$('#status_update').empty().append('<option selected="selected" value="">--Pilih Status Order--</option>');

					$("#status_update").append(new Option("DONE SC", "donesc"));

					$("#status_update").append(new Option("KOSONGKAN ODP", "kosongkan_odp"));

					$("#status_update").append(new Option("WAIT RISMA", "wait_risma"));

					$("#status_update").append(new Option("KENDALA SC", "kendalasc"));

					$("#status_update").append(new Option("PELANGGAN BATAL", "KENDALA PELANGGAN"));

					$("#status_update").append(new Option("ODP BLM GOLIVE", "ODP BLM LIVE"));

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

		if (confirm('Yakin Hapus Data Ini?'))

		{

			// ajax delete data to database

			$.ajax({

				url: "<?php echo site_url('sales/dorong_myi/delete') ?>/" + id,

				type: "POST",

				dataType: "JSON",

				success: function(data)

				{

					//if success reload ajax table

					$('#modal_form').modal('hide');

					reload_table();

				},

				error: function(jqXHR, textStatus, errorThrown)

				{

					alert('Error deleting data');

				}

			});

		}



	}



	function save()

	{

		$('#btnSave').text('Saving...'); //change button text

		$('#btnSave').attr('disabled', true); //set button disable

		var url;



		url = "<?php echo site_url('sales/dorong_myi/update') ?>";

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

					if ($('#status_id').val() == 31) {

						reload_table();

						document.getElementById('pesan').innerHTML = data.pesan;

						$('#status_update').empty().append('<option selected="selected" value="">--Pilih Status Order--</option>');

						$("#status_update").append(new Option("DONE SC", "donesc"));

						$("#status_update").append(new Option("KOSONGKAN ODP", "kosongkan_odp"));

						$("#status_update").append(new Option("WAIT RISMA", "wait_risma"));

						$("#status_update").append(new Option("KENDALA SC", "kendalasc"));

						$("#status_update").append(new Option("PELANGGAN BATAL", "KENDALA PELANGGAN"));

					} else {

						$('#modal_form').modal('hide');

						Swal.fire({

								title: 'Berhasil!',

								text: 'Order berhasil diupdate!',

								icon: 'success',

								confirmButtonText: 'OK'

							})

							.then(function() {

								reload_table();

							});

					}

				} else

				{

					for (var i = 0; i < data.inputerror.length; i++)

					{

						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class

						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string

					}

				}

				$('#btnSave').text('Save'); //change button text

				$('#btnSave').attr('disabled', false); //set button enable





			},

			error: function(jqXHR, textStatus, errorThrown)

			{

				alert('Error adding / update data');

				$('#btnSave').text('Save'); //change button text

				$('#btnSave').attr('disabled', false); //set button enable



			}

		});

	}


	/*
	function getstID() {



		$('#status_update').on('change', function() {

			if (this.value == 'donesc') {

				$('#status_id').val('5')

			} else if (this.value == 'kendalasc') {

				$('#status_id').val('12')

			} else if (this.value == 'ogpsc') {

				$('#status_id').val('31')

			} else if (this.value == 'kosongkan_odp') {

				$('#status_id').val('32')

			} else if (this.value == 'wait_risma') {

				$('#status_id').val('33')

			}

		});

	}
	*/
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

				<form action="#" id="form" class="form-horizontal">

					<input type="hidden" value="" name="id" />

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

										<input name="no_ktp" class="form-control" type="text">

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

									<label class="control-label">LOKASI :</label>

									<div class="col-md-12">

										<input name="lat_long" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">EMAIL :</label>

									<div class="col-md-12">

										<input name="email" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">PAKET :</label>

									<div class="col-md-12">

										<input name="paket" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">JARAK :</label>

									<div class="col-md-12">

										<input name="jarak_tiang" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">ODP :</label>

									<div class="col-md-12">

										<input name="odp" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

							</div>

							<div class="col-md-3">

								<div class="form-group">

									<label class="control-label">KD SALES:</label>

									<div class="col-md-12">

										<input name="kode" class="form-control" type="text">

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

									<label class="control-label">TGL:</label>

									<div class="col-md-12">

										<input name="tgl_masuk" class="form-control" type="text" readonly>

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">STATUS:</label>

									<div class="col-md-12">

										<select name="status_update" id="status_update" class="form-control" placeholder="Pilih" required>

											<option value="">--Pilih Status--</option>

										</select>

										<span class="help-block"></span>

									</div>

								</div>

							</div>

							<div class="col-md-3">

								<div class="form-group">

									<label class="control-label">REQUEST ODP :</label>

									<div class="col-md-12">

										<input name="req_sc_odp" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">REQUEST PORT :</label>

									<div class="col-md-12">

										<input name="req_sc_port" class="form-control" type="text">

										<span class="help-block"></span>

									</div>

								</div>

								<div class="form-group">

									<label class="control-label">SC :</label>

									<div class="col-md-12">

										<input name="sc" id="sc" class="form-control" type="text" disabled>

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