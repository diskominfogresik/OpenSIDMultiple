<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$title = (!empty($judul_kategori))? $judul_kategori: 'Artikel Terkini';
$slug = 'terkini';
if(is_array($title)){
	$slug = $title['slug'];
	$title = $title['kategori'];
}
?>
<div class="container<?php if(config_item('fluid') == 'y') : ?>-fluid<?php endif; ?> main-container text-center mt-0 mb-2" id="artikel">
    <div class="card fullscreen pink-gradient">
        <h5 class="mt-2 mb-2"><b><?= $title ?></b></h5>
    </div>
</div>
<?php if ($artikel): ?>
<div class="container<?php if(config_item('fluid') == 'y') : ?>-fluid<?php endif; ?> main-container mt-0">
	<div class="row">
		<?php foreach ($artikel as $data): ?>
		<?php $url = site_url('artikel/'.buat_slug($data)) ?>
		<?php $abstract = potong_teks(strip_tags($data['isi']), 300) ?>
		<?php $image = ($data['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'sedang_'.$data['gambar'])) ? AmbilFotoArtikel($data['gambar'],'sedang') : gambar_desa($desa['logo']); ?>
		<div class="col-12 <?php if(config_item('fluid') == 'y') : ?>col-lg-4 col-md-4<?php else: ?>col-lg-6 col-md-6<?php endif; ?>">
			<div class="card mb-2">
				<a href="<?= $url ?>" title="Baca Selengkapnya">
					<div class="background-img blog-header-img" style="<?php if(config_item('fluid') == 'y') : ?>max-height:200px<?php else: ?>max-height:300px<?php endif; ?>">
						<img src="<?= $image ?>" class="<?php $image !== gambar_desa($desa['logo']) and print('img-responsive cover img-fluid opacity-100') ?>">
					</div>
				</a>
				<div class="card-header border-bottom" style="min-height:85px">
					<div class="media">
						<div class="icon-circle icon-40 bg-light-primary mr-3">
							<i class="material-icons">fingerprint</i>
						</div>
						<div class="media-body">
							<h6 class="my-0 content-color-primary"><a href="<?= site_url('artikel/'.buat_slug($data))?>" title="Baca Selengkapnya"><?= $data["judul"] ?></a></h6>
							<p class="small mb-0">
								<i class="fa fa-calendar" aria-hidden="true"></i> <?= tjs($data['tgl_upload'],'s');?>
								<i class="fa fa-user" aria-hidden="true"></i> <?= $data['owner'] ?>
							</p>
						</div>
					</div>
				</div>
				<div class="card-body text-hide-xs" style="min-height:200px">
					<div class="mb-0">
						<p align="justify"><?= $abstract ?> ...</p>
					</div>
				</div>
				<div class="card-footer border-top">
					<div class="row">
						<div class="col">
							<div class="media">
								<div class="media-body">
									<p class="content-color-secondary mb-0 small">
										<i class="material-icons icon-sm">chat</i> <?= number_format($this->db->query("SELECT * FROM komentar WHERE id_artikel = '".$data['id']."' AND status ='1'")->num_rows(),0,',','.') ?> Komentar
										<?php if (trim($data['kategori']) != '') : ?>
										<i class="fa fa-flag" aria-hidden="true"></i> <?= $data['kategori']?>
										<?php endif; ?>
									</p>
								</div>
							</div>
						</div>
						<div class="text-right pr-3">
							<div class="media">
								<div class="media-body">
									<p class="content-color-secondary mb-0 small">
										<i class="fa fa-heart" aria-hidden="true"></i> <?= hit($data['hit']) ?>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php else: ?>
<?php $this->load->view($folder_themes .'/commons/404') ?>
<?php endif; ?>
