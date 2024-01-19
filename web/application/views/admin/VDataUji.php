<div class="post d-flex flex-column-fluid mt-1" id="kt_post">
	<div id="kt_content_container" class="container-xxl">
		<div class="row">
			<div class="col-xl-3">
				<span class="card bg-gray-300 hoverable card-xl-stretch mb-xl-8">
					<div class="card-body">
						<span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
								<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" />
								<rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
								<rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
							</svg>
						</span>
						<div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">
							<span><?= $statistics['Netral'] ?? 0 ?></span>
							<span>(<?= number_format(($statistics['Netral'] ?? 0) / ($statistics['Total'] ?? 1) * 100, 2) ?>%)</span>
						</div>
						<div class="fw-bold text-gray-400">Sentimen Netral</div>
					</div>
				</span>
			</div>
			<div class="col-xl-3">
				<span class="card bg-success hoverable card-xl-stretch mb-xl-8">
					<div class="card-body">
						<span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor" />
								<path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor" />
								<path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor" />
							</svg>
						</span>
						<div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">
							<span><?= $statistics['Positif'] ?? 0 ?></span>
							<span>(<?= number_format(($statistics['Positif'] ?? 0) / ($statistics['Total'] ?? 1) * 100, 2) ?>%)</span>
						</div>
						<div class="fw-bold text-gray-100">Sentimen Positif</div>
					</div>
				</span>
			</div>
			<div class="col-xl-3">
				<span class="card bg-warning hoverable card-xl-stretch mb-xl-8">
					<div class="card-body">
						<span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="currentColor" />
								<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="currentColor" />
							</svg>
						</span>
						<div class="text-white fw-bolder fs-2 mb-2 mt-5">
							<span><?= $statistics['Negatif'] ?? 0 ?></span>
							<span>(<?= number_format(($statistics['Negatif'] ?? 0) / ($statistics['Total'] ?? 1) * 100, 2) ?>%)</span>
						</div>
						<div class="fw-bold text-white">Sentimen Negatif</div>
					</div>
				</span>
			</div>
			<div class="col-xl-3">
				<a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
					<div class="card-body">
						<span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="currentColor" />
								<path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="currentColor" />
							</svg>
						</span>
						<div class="text-white fw-bolder fs-2 mb-2 mt-5"><?= $statistics['Total'] ?? 0 ?></div>
						<div class="fw-bold text-white">Jumlah Data</div>
					</div>
				</a>
			</div>
			<div class="col">
				<div class="card mb-5 mb-xl-8">
					<div class="card-header border-0 pt-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bolder fs-3 mb-1">Data Uji</span>
						</h3>
						<div class="card-toolbar">
							<a href="<?= base_url('dataset/testing/export') ?>" class="btn btn-danger mx-2" title="Download file .arff data uji !">
								<span class="svg-icon svg-icon-muted svg-icon-2x">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.3" d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z" fill="currentColor" />
										<path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z" fill="currentColor" />
										<path opacity="0.3" d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z" fill="currentColor" />
									</svg>
								</span>
								Download .arff
							</a>
							<button type="button" onclick="HandleTestingPrediction(event)" class="btn btn-primary testing-prediction-btn" title="Proses untuk memprediksi data uji!">Prediksi Data Uji!</button>
							<!-- <a href="#" class="btn btn-primary" title="Buat semua data pada tabel menjadi data uji atau data latih !">
								Tambah Data
								!</a> -->
						</div>
					</div>
					<div class="card-body py-3">
						<table class="table table-rounded table-row-bordered table-row-gray-300 align-middle gs-0 gy-3" id="tabelDataUji">
							<thead>
								<tr class="fw-bolder text-muted">
									<th>No</th>
									<th>Tweet</th>
									<th>Kelas</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($datasets as $index => $item) { ?>
									<tr>
										<td class="text-dark fw-bolder text-hover-primary fs-6">
											<?= $index + 1 ?>
										</td>
										<td class="text-dark fw-bolder text-hover-primary fs-6">
											<?= $item->sentiment ?>
										</td>
										<td class="text-dark fw-bolder text-hover-primary fs-6">
											<?= ['Negatif', 'Netral', 'Positif'][$item->prediction_result] ?? '' ?>
										</td>
										<td class="text-dark fw-bolder text-hover-primary fs-6">
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
		$('#tabelDataUji').dataTable({
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
	});

	function HandleTestingPrediction(e) {
		const res = confirm("Apakah kamu yakin ingin memulai proses prediksi data uji dengan model naive bayes?");
		if (!res) {
			return;
		}

		const predictionBtn = document.getElementsByClassName('testing-prediction-btn')[0];
		const loadingContent = `
			<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
			<span class="sr-only">Loading...</span>
		`
		const oldContent = predictionBtn.innerHTML;

		predictionBtn.setAttribute('disabled', 'disabled');
		predictionBtn.innerHTML = `${loadingContent}${oldContent}`;

		$.ajax({
				url: "<?= base_url('dataset/testing/prediction') ?>",
				method: 'POST',
				'accepts': 'application/json',
				timeout: 0
			}).done(function(response) {
				alert("Yeeaaay, uji coba prediksi sentiment berhasil dilakukan")
			})
			.fail(function(xhr, textStatus, errorThrown) {
				alert("Upps, there was an error when processing the request")
			})
			.always(function() {
				predictionBtn.innerHTML = oldContent;
				predictionBtn.removeAttribute('disabled');
			})
	}
</script>