<div class="post d-flex flex-column-fluid mt-1" id="kt_post">
	<div id="kt_content_container" class="container-xxl">
		<div class="row">
			<div class="col">
				<div id="myAlert"></div>
				<div class="card mb-5 mb-xl-8">
					<div class="card-header border-0 pt-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bolder fs-3 mb-1">Data Tweet</span>
						</h3>
						<div class="card-toolbar">
							<button type="button" onclick="HandleScrappingData(event)" class="btn btn-primary mx-2 scrapping-data-btn">Ambil Data </button>
							<form action="<?= base_url('scrapping/training-dataset') ?>" method="POST" onsubmit="handleOnSubmitAsTrainingDataset(event)">
								<button type="submit" class="btn btn-primary mx-2 simpan" disabled>Simpan Data Latih</button>
							</form>
							<form action="<?= base_url('scrapping/testing-dataset') ?>" method="POST" onsubmit="handleOnSubmitAsTestingDataset(event)">
								<button type="submit" class="btn btn-primary simpan" disabled>Simpan Data Uji</button>
							</form>
						</div>
					</div>
					<div class="card-body py-3">
						<table class="table table-rounded table-row-bordered table-row-gray-300 align-middle gs-0 gy-3" id="tabelScrapping">
							<thead>
								<tr class="fw-bolder text-muted">
									<th>
										<div class="custom-control custom-checkbox d-inline-block" style="text-align:center;">
											<input type="checkbox" class="custom-control-input" id="checkAll" value="0">
											<label class="custom-control-label" for="checkAll"></label>
										</div>
									</th>
									<th>No</th>
									<th>Tweet</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody>

								<?php foreach ($tweets as $index => $item) { ?>
									<tr>
										<td>
											<div class="custom-control custom-checkbox" onclick="buttonMultipleAvailable()">
												<input type="checkbox" class="custom-control-input checkItem" id="<?= $item->id ?>" value="0" data-id="<?= $item->id ?>">
												<label class="custom-control-label" for="<?= $item->id ?>"></label>
											</div>
										</td>
										<td class="text-dark fw-bolder text-hover-primary fs-6">
											<?= $index + 1 ?>
										</td>
										<td class="text-dark fw-bolder text-hover-primary fs-6">
											<?= $item->tweet ?>
										</td>
										<td>
											<?= $item->created_at ?>
										</td>
									</tr>
								<?php } ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		$('#tabelScrapping').dataTable({
			"language": {
				"lengthMenu": "Tampilkan _MENU_",
				"zeroRecords": "Tidak ada data",
				"infoEmpty": "Tidak ada data",
				"infoFiltered": "(filtered from _MAX_ total records)",
				"search": "Cari",
			},
			"dom": `
				<'row'
					<'col-sm-6 d-flex align-items-center justify-content-start'l>
					<'col-sm-6 d-flex align-items-center justify-content-end'f>
				>
				
				<'table-responsive'tr>

				<'row'
					<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>
					<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>
				>`
		});

		$('#simpan').click(function() {
			const dnIds = $('.checkItem:checkbox:checked').map((_, elm) => elm.value).get()
			$('#simpan_id').val(dnIds.toString())
			$('#formSimpan').submit();
		})

		$('#checkAll').change(function() {
			const isChecked = $(this).prop('checked')
			if (isChecked) {
				$('.checkItem').prop('checked', true)
			} else {
				$('.checkItem').prop('checked', false)
			}
			buttonMultipleAvailable()
		})

		$('.checkItem').change(function() {
			buttonMultipleAvailable()
		})
	});

	const buttonMultipleAvailable = () => {
		const isChecked = $('.checkItem:checkbox:checked').prop('checked')
		if (isChecked) {
			$('.simpan').attr('disabled', false)
		} else {
			$('.simpan').attr('disabled', true)
		}
	}

	const toggleSimpanButton = (isDisabled = false) => {
		$('.simpan').attr('disabled', isDisabled)
	}

	function showAlert(message, isSuccess = true) {
		if ($("#myAlert").find("div#myAlert2").length == 0) {
			$("#myAlert").append(`
				<div class='alert alert-${isSuccess ? 'success' : 'danger'} alert-dismissible fade show' role='alert' id='myAlert2'>
					${message}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			`);
		}
	}

	function handleOnSubmitAsTrainingDataset(e) {
		e.preventDefault();


		if ($('.checkItem:checked').length > 0) {
			toggleSimpanButton(true);

			const selectedId = [];
			$('.checkItem:checked').map((_, e) => {
				selectedId.push(e.dataset.id)
			});

			$.ajax({
					url: e.target.action,
					method: 'POST',
					accepts: 'application/json',
					contentType: 'application/json',
					data: JSON.stringify({
						id: selectedId
					})
				})
				.done(function(response) {
					showAlert('Tweet berhasil ditambahkan sebagai data training!');

					setTimeout(() => location.reload(true), 500);
				})
				.fail(function(xhr, textStatus, errorThrown) {
					showAlert('Upps, ada kesalahan dalam proses penambahan tweet sebagai data training. Coba lagi lain waktu!', false);
				});

			toggleSimpanButton(false);
		}

	}

	function handleOnSubmitAsTestingDataset(e) {
		e.preventDefault();

		if ($('.checkItem:checked').length > 0) {
			toggleSimpanButton(true);

			const selectedId = [];
			$('.checkItem:checked').map((_, e) => {
				selectedId.push(e.dataset.id)
			});
			$.ajax({
					url: e.target.action,
					method: 'POST',
					accepts: 'application/json',
					contentType: 'application/json',
					data: JSON.stringify({
						id: selectedId
					})
				})
				.done(function(response) {
					showAlert('Tweet berhasil ditambahkan sebagai data uji!');

					setTimeout(() => location.reload(true), 500);
				})
				.fail(function(xhr, textStatus, errorThrown) {
					showAlert('Upps, ada kesalahan dalam proses penambahan tweet sebagai data uji. Coba lagi lain waktu!', false);
				});

			toggleSimpanButton(false);
		}
	}

	function HandleScrappingData(e) {
		const res = confirm("Apakah kamu yakin ingin memulai proses scrapping data di twitter?");
		if (!res) {
			return;
		}

		const scrappingDataBtn = document.getElementsByClassName('scrapping-data-btn')[0];
		const loadingContent = `
			<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
			<span class="sr-only">Loading...</span>
		`
		const oldContent = scrappingDataBtn.innerHTML;

		scrappingDataBtn.setAttribute('disabled', 'disabled');
		scrappingDataBtn.innerHTML = `${loadingContent}${oldContent}`;

		$.ajax({
				url: "<?= base_url('scrapping/scrapping') ?>",
				method: 'POST',
				'accepts': 'application/json',
				timeout: 0
			}).done(function(response) {
				alert("Yeeaaay, Proses scrapping was successful")

				setTimeout(() => location.reload(true), 500)
			})
			.fail(function(xhr, textStatus, errorThrown) {
				alert("Upps, there was an error when processing the request")
			})
			.always(function() {
				scrappingDataBtn.innerHTML = oldContent;
				scrappingDataBtn.removeAttribute('disabled');
			})
	}
</script>