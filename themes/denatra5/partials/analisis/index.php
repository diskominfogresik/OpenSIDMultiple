<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if($list_jawab): ?>
<?php $this->load->view($folder_themes .'/partials/analisis/detail') ?>
<?php else: ?>
<div class="card mb-2 fullscreen has-background-img ">
	<div class="card-header border-bottom">
		<div class="media">
			<div class="icon-circle icon-40 bg-light-primary mr-3">
				<i class="material-icons">folder</i>
			</div>
			<div class="media-body">
				<h6 class="my-0 content-color-primary">Daftar Agregasi Data Analisis Desa</h6>
				<p class="small mb-0">
					<i class="material-icons icon-sm">date_range</i> <?= ucwords($this->setting->sebutan_desa)." ".$desa['nama_desa']?>
				</p>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="mb-0 content-color-secondary">
			<?php foreach ($list_indikator AS $data): ?>
			<a href="<?= site_url("data_analisis/$data[id]/$data[subjek_tipe]/$data[id_periode]"); ?>"><h5>&nbsp;<b><?= $data['indikator']?></b></h5></a>
			<div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<td width="20%">Pendataan </td>
						<td width="1%"> :</td>
						<td><?= $data['master']; ?></td>
					</tr>
					<tr>
						<td>Subjek </td>
						<td> : </td>
						<td><?= $data['subjek']; ?></td>
					</tr>
					<tr>
						<td>Tahun </td>
						<td> :</td>
						<td><?= $data['tahun']; ?></td>
					</tr>
				</table>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>
