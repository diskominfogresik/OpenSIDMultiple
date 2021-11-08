<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="card mb-2 fullscreen has-background-img ">
	<div class="card-header border-bottom">
		<div class="media">
			<div class="icon-circle icon-40 bg-light-primary mr-3">
				<i class="material-icons">view_day</i>
			</div>
			<div class="media-body">
				<h6 class="my-0 content-color-primary">Data Suplemen - <?= $main['suplemen']['nama']; ?></h6>
				<p class="small mb-0">
					<i class="material-icons icon-sm">local_offer</i> <?= ucwords($this->setting->sebutan_desa)." ".$desa["nama_desa"]?>
				</p>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="mb-0 content-color-secondary">
			<div class="table-responsive">
				<h5>Rincian Data Suplemen</h5>
				<table class="table table-striped">
					<thead>
						<tr>
							<td width="20%">Nama Data</td>
							<td width="1%">:</td>
							<td><?= $main['suplemen']['nama']; ?></td>
						</tr>
						<tr>
							<td>Sasaran Terdata</td>
							<td>:</td>
							<td><?= $sasaran[$main['suplemen']['sasaran']]; ?></td>
						</tr>
						<tr>
							<td>Keterangan</td>
							<td>:</td>
							<td><?= $main['suplemen']['keterangan']; ?></td>
						</tr>
					</thead>
				</table>
			</div>
			<h5>Daftar Terdata</h5>
			<div class="table-responsive">
				<table id="tabel-data" class="table table-striped table-bordered" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Tempat Lahir</th>
							<th>Jenis Kelamin</th>
							<th>Alamat</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($main['terdata'] as $key => $data): ?>
						<tr>
							<td class="text-center"><?= ($key + 1); ?></td>
							<td><?= $data['terdata_nama']; ?></td>
							<td><?= $data["tempat_lahir"]; ?></td>
							<td><?= $data["sex"]; ?></td>
							<td><?= $data["info"];?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$('#tabel-data').DataTable({
		'processing': true,
		"pageLength": 25,
		'order': [],
		'columnDefs': [
		{
			'searchable': false,
			'targets': 0
		},
		{
			'orderable': false,
			'targets': 0
		}
	],
	'language': {
		'url': BASE_URL + '/assets/bootstrap/js/dataTables.indonesian.lang'
		},
	});
});
</script>
