<!-- MYB -->
<style>
	.div-loading-overlay {
		width: 100%;
		height: 100%;
		position: fixed;
		top: 0;
		left: 0;
		background-color: #000;
		opacity: .75;
		z-index: 999999;
	}
</style>


<script>
	$(function() {
		var keyword = <?= $keyword; ?>;
		$("#cari").autocomplete({
			source: keyword,
			maxShowItems: 10,
		});

		// MYB
		$('.div-loading-overlay').hide();
		// MYB
	});

	// MYB
	function previewPdf(id, sign) {
		// get file
		$.ajax({
			url: "<?php echo site_url('layanan_mandiri/mybsign/getNamaSuratFromLogById'); ?>",
			type: "POST",
			data: {
				id: id,
				sign: sign
			},
			dataType: "JSON",
			beforeSend: function() {
				$('.div-loading-overlay').show();
			},
			success: function(res) {
				if (res.success === true) {
					if (res.data) {
						window.open(res.data, 'blank');
					}
				} else {
					alert('Document Not Found');
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {},
			complete: function() {
				$('.div-loading-overlay').hide();
			}
		});
		// open file
	}

	// MYB
	function esign1(id) {
		$('#id_for_sign').val(id).trigger('change');
		$('#passphrase').val('').trigger('change');
		$('#modal_passphrase').modal('toggle');
	}

	// MYB
	function prosesEsign() {
		const id = $('#id_for_sign').val();
		const ps = $('#passphrase').val();
		if (!id || !ps) {
			alert('Not Authorized');
			return;
		}

		$.ajax({
			url: "<?php echo site_url('layanan_mandiri/mybsign/pseudoEsign'); ?>",
			type: "POST",
			data: {
				id: id,
				passphrase: ps,
			},
			dataType: "JSON",
			beforeSend: function() {
				$('.div-loading-overlay').show();
			},
			success: function(res) {
				if (res.success === true) {
					alert('Sign Success');
					location.reload();
				} else {
					alert('Sign Fail');
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {},
			complete: function() {
				$('#passphrase').val('').trigger('change');
				$('.div-loading-overlay').hide();
			}
		});
	}
</script>
<div class="content-wrapper">
	<!-- MYB -->
	<!-- div-loading-overlay -->
	<div class="div-loading-overlay">
		<div class="row">
			<div class="col text-center" style="font-size: 127px; margin-top: 10%;">
				<i class="fa fa-spinner fa-spin"></i>
			</div>
		</div>
	</div><!-- div-loading-overlay -->
	<!-- MYB -->

	<section class="content-header">
		<h1>Permohonan Surat</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_sid') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Permohonan Surat</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" method="post">
			<div class="box box-info">
				<div class="box-body">
					<div class="row">
						<div class="col-sm-3">
							<select class="form-control input-sm" name="filter" onchange="formAction('mainform', '<?= site_url("{$this->controller}/filter") ?>')">
								<option value="">Pilih Status</option>
								<?php foreach ($list_status_permohonan as $id => $data) : ?>
									<option value="<?= $id; ?>" <?= selected($filter != null && $filter == $id, true); ?>><?= $data; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-sm-3 pull-right">
							<div class="input-group input-group-sm">
								<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?= html_escape($cari) ?>" onkeypress="if (event.keyCode == 13){$('#'+'mainform').attr('action', '<?= site_url("{$this->controller}/search") ?>');$('#'+'mainform').submit();}">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("{$this->controller}/search") ?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
								<form id="mainform" name="mainform" method="post">
									<div class="table-responsive">
										<table class="table table-bordered table-striped dataTable table-hover tabel-daftar">
											<thead class="bg-gray disabled color-palette">
												<tr>
													<th>No</th>
													<?php if ($this->CI->cek_hak_akses('u') || $this->CI->cek_hak_akses('h')) : ?>
														<th>Aksi</th>
													<?php endif; ?>
													<th>No Antrian</th>
													<th>NIK</th>
													<th>Nama Penduduk</th>
													<th>No HP Aktif</th>
													<th>Jenis Surat</th>
													<th><?= url_order($o, "{$this->controller}/{$func}/{$p}", 1, 'Tanggal Kirim'); ?></th>
												</tr>
											</thead>
											<tbody>
												<?php if ($main) : ?>
													<?php foreach ($main as $data) : ?>
														<tr>
															<td class="padat"><?= $data['no'] ?></td>
															<?php if ($this->CI->cek_hak_akses('u') || $this->CI->cek_hak_akses('h')) : ?>
																<td class="aksi">
																	<?php if ($this->CI->cek_hak_akses('u')) : ?>
																		<?php if ($data['status_id'] == 0) : ?>
																			<a class="btn btn-social bg-navy btn-flat btn-sm btn-proses" title="Surat <?= $data['status']; ?>" style="width: 170px"><i class="fa fa-info-circle"></i><?= $data['status']; ?></a>
																		<?php elseif ($data['status_id'] == 1) : ?>
																			<a href="<?= site_url("{$this->controller}/periksa/{$data['id']}") ?>" class="btn btn-social btn-info btn-flat btn-sm pesan-hover" title="Klik untuk memeriksa" style="width: 170px"><i class="fa fa-spinner"></i><span><?= $data['status']; ?></span></a>
																		<?php elseif ($data['status_id'] == 2) : ?>
																			<!-- MYB -->
																			<!-- <a href="<?php // echo site_url("{$this->controller}/proses/{$data['id']}/3") 
																							?>" class="btn btn-social bg-purple btn-flat btn-sm pesan-hover" title="Klik jika telah ditandatangani" style="width: 170px"><i class="fa fa-edit"></i><span><?php // echo $data['status']; 
																																																															?></span></a> -->

																			<!-- MYB -->
																			<button type="button" class="btn btn-primary btn-flat btn-sm" title="preview" onclick="previewPdf(<?= $data['id'] ?>, false)"><i class="fa fa-file-pdf-o"></i></button>
																			<button type="button" class="btn btn-sm btn-flat btn-warning" title="eSign 1" onclick="esign1(<?= $data['id'] ?>)"><i class="fa fa-pencil"></i></button>
																			<!-- MYB -->

																		<?php elseif ($data['status_id'] == 3) : ?>
																			<!-- MYB -->
																			<button type="button" class="btn btn-sm btn-flat btn-primary" title="preview" onclick="previewPdf(<?= $data['id'] ?>, true)"><i class="fa fa-file-pdf-o"></i></button>
																			<!-- MYB -->
																			<a href="<?= site_url("{$this->controller}/proses/{$data['id']}/4") ?>" class="btn btn-social bg-orange btn-flat btn-sm pesan-hover" title="Klik jika telah diambil" style="width: 170px"><i class="fa fa-thumbs-o-up"></i><span><?= $data['status']; ?></span></a>
																		<?php elseif ($data['status_id'] == 4) : ?>
																			<a class="btn btn-social btn-success btn-flat btn-sm btn-proses" title="Surat <?php echo $data['status']; ?>" style="width: 170px"><i class="fa fa-check"></i><?php echo $data['status']; ?></a>
																			<!-- MYB -->
																			<button type="button" class="btn btn-sm btn-flat btn-primary" title="preview" onclick="previewPdf(<?= $data['id'] ?>, true)"><i class="fa fa-file-pdf-o"></i></button>
																		<?php else : ?>
																			<a class="btn btn-social btn-danger btn-flat btn-sm btn-proses" title="Surat <?= $data['status']; ?>" style="width: 170px"><i class="fa fa-times"></i><?= $data['status']; ?></a>
																		<?php endif; ?>
																	<?php endif; ?>
																	<?php if ($this->CI->cek_hak_akses('u') && $data['status_id'] == 1) : ?>
																		<a href="<?= site_url("permohonan_surat_admin/konfirmasi/{$data['id']}/5"); ?>" class="btn btn-flat btn-danger btn-sm" data-remote="false" data-toggle="modal" data-target="#modalBox" title="Batalkan Permohonan Surat" data-title="Batalkan Permohonan Surat"><i class="fa fa-times"></i></a>
																	<?php endif; ?>
																</td>
															<?php endif; ?>
															<td class="padat"><?= get_antrian($data['no_antrian']); ?></td>
															<td class="padat"><?= $data['nik']; ?></td>
															<td><?= $data['nama'] ?></td>
															<td><?= $data['no_hp_aktif'] ?></td>
															<td><?= $data['jenis_surat'] ?></td>
															<td class="padat"><?= tgl_indo2($data['created_at']) ?></td>
														</tr>
													<?php endforeach; ?>
												<?php else : ?>
													<tr>
														<td class="text-center" colspan="7">Data Tidak Tersedia</td>
													</tr>
												<?php endif; ?>
											</tbody>
										</table>
									</div>
								</form>
								<div class="row">
									<div class="col-sm-6">
										<div class="dataTables_length">
											<form id="paging" action="<?= site_url("{$this->controller}") ?>" method="post" class="form-horizontal">
												<label>
													Tampilkan
													<select name="per_page" class="form-control input-sm" onchange="$('#paging').submit()">
														<option value="20" <?php selected($per_page, 20); ?>>20</option>
														<option value="50" <?php selected($per_page, 50); ?>>50</option>
														<option value="100" <?php selected($per_page, 100); ?>>100</option>
													</select>
													Dari
													<strong><?= $paging->num_rows ?></strong>
													Total Data
												</label>
											</form>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="dataTables_paginate paging_simple_numbers">
											<ul class="pagination">
												<?php if ($paging->start_link) : ?>
													<li><a href="<?= site_url("{$this->controller}/index/{$paging->start_link}/{$o}") ?>" aria-label="First"><span aria-hidden="true">Awal</span></a></li>
												<?php endif; ?>
												<?php if ($paging->prev) : ?>
													<li><a href="<?= site_url("{$this->controller}/index/{$paging->prev}/{$o}") ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
												<?php endif; ?>
												<?php for ($i = $paging->start_link; $i <= $paging->end_link; $i++) : ?>
													<li <?= jecho($p, $i, "class='active'") ?>><a href="<?= site_url("{$this->controller}/index/{$i}/{$o}") ?>"><?= $i ?></a></li>
												<?php endfor; ?>
												<?php if ($paging->next) : ?>
													<li><a href="<?= site_url("{$this->controller}/index/{$paging->next}/{$o}") ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
												<?php endif; ?>
												<?php if ($paging->end_link) : ?>
													<li><a href="<?= site_url("{$this->controller}/index/{$paging->end_link}/{$o}") ?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a></li>
												<?php endif; ?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

		<!-- MYB -->
		<div class="modal fade" id="modal_passphrase" role="dialog" aria-labelledby="modal_passphrase_label" aria-hidden="true">
			<div class='modal-dialog modal-sm'>
				<div class='modal-content'>
					<div class='modal-header btn-info'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
						<h4 class='modal-title' id='modal_passphrase_label'> Input Password</h4>
					</div>
					<div class='modal-body'>
						<input type="hidden" id="id_for_sign">
						<div class="row">
							<div class="col-md-1">
							</div>
							<div class="col-md-10">
								<input type="password" id="passphrase" name="passphrase" value="" class="form-control input-sm">
							</div>
							<div class="col-md-1">
							</div>
						</div>
					</div>
					<div class='modal-footer'>
						<button type="button" class="btn btn-social btn-flat btn-primary btn-sm" data-dismiss="modal" onclick="prosesEsign()"><i class='fa fa-save'></i> Sign</button>
						<button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Batal</button>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('global/confirm_delete'); ?>
<script type="text/javascript">
	$("document").ready(function() {
		$("a.pesan-hover").mouseover(function() {
			text = $(this).find("span").text();
			$(this).find("span").text($(this).attr('title'));
		}).mouseout(function() {
			$(this).find("span").text(text);
		});
	});
</script>