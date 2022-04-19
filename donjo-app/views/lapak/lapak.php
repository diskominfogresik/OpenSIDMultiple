<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * File ini:
 *
 * View Penduduk untuk modul Kependudukan > Penduduk
 *
 * donjo-app/views/sid/kependudukan/penduduk.php
 *
 */

/**
 *
 * File ini bagian dari:
 *
 * OpenSID
 *
 * Sistem informasi desa sumber terbuka untuk memajukan desa
 *
 * Aplikasi dan source code ini dirilis berdasarkan lisensi GPL V3
 *
 * Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * Hak Cipta 2016 - 2020 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 *
 * Dengan ini diberikan izin, secara gratis, kepada siapa pun yang mendapatkan salinan
 * dari perangkat lunak ini dan file dokumentasi terkait ("Aplikasi Ini"), untuk diperlakukan
 * tanpa batasan, termasuk hak untuk menggunakan, menyalin, mengubah dan/atau mendistribusikan,
 * asal tunduk pada syarat berikut:
 *
 * Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam
 * setiap salinan atau bagian penting Aplikasi Ini. Barang siapa yang menghapus atau menghilangkan
 * pemberitahuan ini melanggar ketentuan lisensi Aplikasi Ini.
 *
 * PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, BAIK TERSURAT MAUPUN
 * TERSIRAT. PENULIS ATAU PEMEGANG HAK CIPTA SAMA SEKALI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU
 * KEWAJIBAN APAPUN ATAS PENGGUNAAN ATAU LAINNYA TERKAIT APLIKASI INI.
 *
 * @package	OpenSID
 * @author	Tim Pengembang OpenDesa
 * @copyright	Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * @copyright	Hak Cipta 2016 - 2020 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 * @license	http://www.gnu.org/licenses/gpl.html	GPL V3
 * @link 	https://github.com/OpenSID/OpenSID
 */

?>

<script>
	$(function() {
		$("#cari").autocomplete({
			source: function(request, response) {
				$.ajax({
					type: "POST",
					url: '<?= site_url("penduduk/autocomplete"); ?>',
					dataType: "json",
					data: {
						cari: request.term
					},
					success: function(data) {
						response(JSON.parse(data));
					}
				});
			},
			minLength: 2,
		});
	});
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Lapak</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_sid'); ?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Data Lapak</li>
		</ol>
	</section>
	<form method="post" action="<?= site_url("lapak/deleteall"); ?>" id="form-delete">
		<section class="content" id="maincontent">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<div class="btn-group btn-group-vertical">
								<a href="<?= site_url('lapak/form'); ?>" class="btn btn-social btn-flat btn-success btn-sm"><i class='fa fa-plus'></i> Tambah Lapak</a>
							</div>
							<?php if ($this->CI->cek_hak_akses('h')) : ?>
								<button type="button" id="btn-delete" href="#confirm-delete" title="Hapus Data Terpilih" onclick="deleteAllBox('mainform')" class="btn btn-social btn-flat btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</button type="button" id="btn-delete">
							<?php endif; ?>


							<a href="<?= site_url("{$this->controller}/clear"); ?>" class="btn btn-social btn-flat bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-refresh"></i>Bersihkan</a>
						</div>
						<div class="box-body">
							<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
								<div class="table-responsive table-min-height">
									<?php if ($judul_statistik) : ?>
										<h5 class="box-title text-center"><b><?= $judul_statistik; ?></b></h5>
									<?php endif; ?>
									<table id="example" class="table table-bordered dataTable table-striped table-hover tabel-daftar">
										<thead class="bg-gray disabled color-palette">
											<tr>
												<th><input type="checkbox" class="check-item" id="checkall" /></th>
												<th>No</th>
												<th>Aksi</th>
												<th>Foto</th>
												<!-- tambah kolom orang tua-->
												<th>Nama Lapak</th>
												<th>Kontak</th>
												<th>Lokasi Lapak</th>
												<th>Koordinat</th>
												<th>Deskripsi</th>
												<!-- tambah kolom orang tua-->

											</tr>
										</thead>
										<tbody>


											<?php
											$count = 0;
											foreach ($lapak as $key) :
												$count = $count + 1
											?>
												<tr>
													<td class="padat"><input type="checkbox" name="id_cb[]" value="<?php echo $key->id_lapak ?>" /></td>
													<td class="padat"><?php echo $count ?></td>
													<td class="aksi">
														<div class="btn-group">
															<button type="button" class="btn btn-social btn-flat btn-info btn-sm" data-toggle="dropdown"><i class='fa fa-arrow-circle-down'></i> Pilih Aksi</button>
															<ul class="dropdown-menu" role="menu">
																<li>
																	<a href="<?= site_url("lapak/edit/$p/$o/$key->id_lapak"); ?>" class="btn btn-social btn-flat btn-block btn-sm"><i class="fa fa-edit"></i> Ubah Data Lapak</a>
																</li>
																<li>
																	<a href="<?= site_url("lapak/delete/$p/$o/$key->id_lapak"); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" data-href="" class="btn btn-social btn-flat btn-block btn-sm"><i class="fa fa-trash-o"></i> Hapus</a>
																</li>
															</ul>
														</div>
													</td>
													<td class="padat">
														<div class="user-panel">
															<div class="image2">
																<img class="img-circle" alt="Foto Penduduk" src="<?= AmbilFotoLapak($key->foto_lapak) ?>"/>
															</div>
														</div>
													</td>

													<td>
														<?php echo $key->nama_lapak ?>
													</td>
													<td>
														<?php echo $key->kontak_lapak ?>
													</td>
													<td>
														<?php echo $key->lokasi_lapak ?>
													</td>
													<td>
														<?php echo $key->koordinat ?>
													</td>
													<td>
														<?php echo $key->deskripsi ?>
													</td>


												</tr>
											<?php endforeach; ?>

										</tbody>
									</table>
								</div>
	</form>

</div>
</div>
</div>
</div>
</div>
</section>
</div>
<div class='modal fade' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
			</div>
			<div class='modal-body btn-info'>
				Apakah Anda yakin ingin menghapus data ini?
			</div>
			<div class='modal-footer'>
				<button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
				<a class='btn-ok'>
					<button type="button" class="btn btn-social btn-flat btn-danger btn-sm" id="ok-delete"><i class='fa fa-trash-o'></i> Hapus</button>
				</a>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		$('#example').DataTable({
			dom: 'Bfrtip',
			buttons: [{
					extend: 'copyHtml5',
					text: '<i class="fa fa-files-o"></i>',
					titleAttr: 'Copy'
				},
				{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel-o"></i>',
					titleAttr: 'Excel'
				},
				{
					extend: 'csvHtml5',
					text: '<i class="fa fa-file-text-o"></i>',
					titleAttr: 'CSV'
				},
				{
					extend: 'pdfHtml5',
					text: '<i class="fa fa-file-pdf-o"></i>',
					titleAttr: 'PDF'
				}
			]
		});
	});
</script>
<script>
	$(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
		$("#check-all").click(function() { // Ketika user men-cek checkbox all
			if ($(this).is(":checked")) // Jika checkbox all diceklis
				$(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
			else // Jika checkbox all tidak diceklis
				$(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
		});

		$("#btn-delete").click(function() { // Ketika user mengklik tombol delete
			var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?"); // Buat sebuah alert konfirmasi

			if (confirm) // Jika user mengklik tombol "Ok"
				$("#form-delete").submit(); // Submit form
		});
	});
</script>