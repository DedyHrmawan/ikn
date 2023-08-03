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
							<a href="#" class="btn btn-primary ">Ambil Data </a>
						</div>
					</div>
					<div class="card-body py-3">
						<table class="table table-rounded table-row-bordered table-row-gray-300 align-middle gs-0 gy-3"
							id="tabelKelas">
							<thead>
								<tr class="fw-bolder text-muted">
									<th>No</th>
									<th>Kelas</th>
									<!-- <th>Jumlah</th>
									<th width="25%">Aksi</th> -->
								</tr>
							</thead>
							<tbody>

								<tr>
									<td class="text-dark fw-bolder text-hover-primary fs-6">
										1
									</td>
									<td class="text-dark fw-bolder text-hover-primary fs-6">
									Kini klausul rilis Dembele tidak lagi €50 juta dan sekarang €100 juta.
									</td>
									<!-- <td class="text-dark fw-bolder text-hover-primary fs-6">
										'.$item->jumlah_kelas.'
									</td>
									<td class="">
										<a href="" title="Edit Kelas" data-bs-toggle="modal"
											data-bs-target="#mdl_editKelas" data-id=""
											class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm mdl_editKelas m-1">
											<span class="svg-icon svg-icon-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none">
													<path opacity="0.3"
														d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
														fill="currentColor" />
													<path
														d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
														fill="currentColor" />
												</svg>
											</span>
										</a>
										<a href="#" title="Hapus Kelas" data-bs-toggle="modal"
											data-bs-target="#mdl_delKelas" data-id=""
											class="btn btn-icon btn-bg-light btn-active-color-primary mdl_delKelas btn-sm m-1">
											<span class="svg-icon svg-icon-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none">
													<path
														d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
														fill="currentColor" />
													<path opacity="0.5"
														d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
														fill="currentColor" />
													<path opacity="0.5"
														d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
														fill="currentColor" />
												</svg>
											</span>
										</a>
									</td> -->
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal Edit Kelas-->
<div class="modal fade" id="mdl_editKelas" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="mb-3">Edit Kelas</h3>

				<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
					aria-label="Close">
					<span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg"
							width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
							<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)"
								fill="currentColor" />
							<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)"
								fill="currentColor" />
						</svg></span>
				</div>
			</div>

			<div class="modal-body">
				<form action="<?= site_url('') ?>" method="post">
					<div class="d-flex flex-column mb-8 fv-row">
						<label class="d-flex align-items-center fs-6 fw-bold mb-2">
							<span class="required">Kelas</span>
						</label>
						<input type="text" class="form-control form-control-solid" id="editNamaKelas" name="nama_kelas"
							required />
					</div>
					<div class="d-flex flex-column mb-8 fv-row">
						<label class="d-flex align-items-center fs-6 fw-bold mb-2">
							<span class="required">Jumlah</span>
						</label>
						<input type="number" class="form-control form-control-solid" id="editJumlahKelas"
							name="jumlah_kelas" required />
					</div>
			</div>

			<div class="modal-footer">
				<input type="hidden" id="editIdKelas" name="id_kelas">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Hapus Kelas-->
<div class="modal fade" id="mdl_delKelas" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="mb-3">Hapus Kelas</h3>

				<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
					aria-label="Close">
					<span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg"
							width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
							<rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)"
								fill="currentColor" />
							<rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)"
								fill="currentColor" />
						</svg></span>
				</div>
			</div>
			<form action="<?= site_url('data-kelas/deleteKelas') ?>" method="post">
				<div class="modal-body">
					<p>Apakah anda yakin ingin menghapus Kelas tersebut ?</p>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="deleteIdKelas" name="id_kelas">
					<button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->load->view('admin/template/footer') ?>
<script>
	$('#tabelKelas').dataTable({
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

</script>
