<div class="post d-flex flex-column-fluid mt-1" id="kt_post">
	<div id="kt_content_container" class="container-xxl">
		<div class="row">
			<div class="col">
				<div class="card mb-5 mb-xl-8">
					<div class="card-header border-0 pt-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bolder fs-3 mb-1">Data Tweet</span>
						</h3>
						<div class="card-toolbar">
							<a href="<?= site_url("data-tweet") ?>" class="btn btn-primary mx-2">Ambil Data </a>
							<form id="" action="<?= site_url('')?>" method="POST">
								<!-- <input type="hidden" id="" name=""> -->
								<button type="submit" class="btn btn-primary mx-2 simpan" disabled>Simpan Data Latih</button>
								<button type="submit" class="btn btn-primary simpan" disabled>Simpan Data Uji</button>
							</form>
						</div>
					</div>
					<div class="card-body py-3">
						<table class="table table-rounded table-row-bordered table-row-gray-300 align-middle gs-0 gy-3"
							id="tabelScrapping">
							<thead>
								<tr class="fw-bolder text-muted">
									<th>No</th>
									<th>
										<div class="custom-control custom-checkbox" style="text-align:center;">
											<input type="checkbox" class="custom-control-input" id="checkAll">
											<label class="custom-control-label" for="checkAll"></label>
										</div>
									</th>
									<th>Tweet</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody>

								<tr>
									<td class="text-dark fw-bolder text-hover-primary fs-6">
										1
									</td>
									<td>
										<div class="custom-control custom-checkbox" onclick="buttonMultipleAvailable()"
											style="text-align:center;">
											<input type="checkbox" class="custom-control-input checkItem" id="1"
												value="1">
											<label class="custom-control-label" for="1"></label>
										</div>
									</td>
									<td class="text-dark fw-bolder text-hover-primary fs-6">
										Kini klausul rilis Dembele tidak lagi €50 juta dan sekarang €100 juta.
									</td>
									<td>
										2023-06-09
									</td>
								</tr>
								<tr>
									<td class="text-dark fw-bolder text-hover-primary fs-6">
										2
									</td>
									<td>
										<div class="custom-control custom-checkbox" onclick="buttonMultipleAvailable()"
											style="text-align:center;">
											<input type="checkbox" class="custom-control-input checkItem" id="2"
												value="2">
											<label class="custom-control-label" for="2"></label>
										</div>
									</td>
									<td class="text-dark fw-bolder text-hover-primary fs-6">
										Kini klausul rilis Dembele tidak lagi €50 juta dan sekarang €100 juta.
									</td>
									<td>
										2023-06-09
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('admin/template/footer') ?>
<script>
	$('#tabelScrapping').dataTable({
		"language": {
			"lengthMenu": "Tampilkan _MENU_",
			"zeroRecords": "Tidak ada data",
			"infoEmpty": "Tidak ada data",
			"infoFiltered": "(filtered from _MAX_ total records)",
			"search": "Cari",

		},
		"dom": "<'row'" +
			"<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
			"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
			">" +
			"<'table-responsive'tr>" +

			"<'row'" +
			"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
			"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
			">"
	});

	$('#simpan').click(function () {
		const dnIds = $('.checkItem:checkbox:checked').map((_, elm) => elm.value).get()
		$('#simpan_id').val(dnIds.toString())
		$('#formSimpan').submit();
	})

	$('#checkAll').change(function () {
		const isChecked = $(this).prop('checked')
		if (isChecked) {
			$('.checkItem').prop('checked', true)
		} else {
			$('.checkItem').prop('checked', false)
		}
		buttonMultipleAvailable()
	})
	$('.checkItem').change(function () {
		buttonMultipleAvailable()
	})
	const buttonMultipleAvailable = () => {
		const isChecked = $('.checkItem:checkbox:checked').prop('checked')
		if (isChecked) {
			$('.simpan').attr('disabled', false)
		} else {
			$('.simpan').attr('disabled', true)
		}
	}

</script>
