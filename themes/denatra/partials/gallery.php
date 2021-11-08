<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="card mb-2 fullscreen has-background-img ">
	<div class="card-header border-bottom">
		<div class="media">
			<div class="icon-circle icon-40 bg-light-primary mr-3">
				<i class="material-icons icon-sm">insert_photo</i>
			</div>
			<div class="media-body">
				<h6 class="my-0 content-color-primary">Arsip Galeri</h6>
				<p class="small mb-0"><i class="material-icons icon-sm">date_range</i> <?= ucwords($this->setting->sebutan_desa)." ".$desa['nama_desa']?></p>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="mb-0 content-color-secondary">
			<div class="container main-container mb-2">
				<div class="row">		
				<?php $i = 1 ?>
				<?php foreach($gallery as $data) : ?>
				<?php if(is_file(LOKASI_GALERI."sedang_{$data['gambar']}")) : ?>
				<div class="col-12 col-lg-6 col-md-6">
					<div class="entry text-center">
						<a data-fancybox="gallery" href="<?= AmbilGaleri($data['gambar'], 'sedang') ?>">
						    <img src="<?= AmbilGaleri($data['gambar'], 'kecil') ?>" class="img-responsive cover img-fluid opacity-100">
						</a>
						<div class="mt-2">
							<a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>" title="<?= $data['nama'] ?>">
								Album: <?= $data['nama'] ?>
							</a>
						</div>
					</div>
				</div>
				<div class="<?php fmod($i, 2) == 0 and print('clearboth') ?>"></div>
				<?php $i++ ?>
				<?php endif ?>
				<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="pagination_area">
	<p>Halaman <?= $p ?> dari <?= $paging->end_link ?></p>
	<nav id="mandiri" >
		<ul class="pagination">
			<?php if ($paging->start_link): ?>
			<li class="page-item"><a class="page-link" href="<?= site_url("first/gallery/{$paging->start_link}") ?>" title="Halaman Pertama"><span aria-hidden="true">&laquo;</span></a></li>
			<?php endif; ?>
			<?php foreach ($pages as $i): ?>
			<li class="page-item <?php $p === $i and print('active') ?>">
				<a class="page-link" href="<?= site_url("first/gallery/{$i}") ?>" title="Halaman <?= $i ?>"><?= $i ?></a>
			</li>
			<?php endforeach; ?>
			<?php if ($paging->end_link): ?>
			<li class="page-item"><a class="page-link" href="<?= site_url("first/gallery/{$paging->end_link}") ?>" title="Halaman Terakhir"><span aria-hidden="true">&raquo;</span></a></li>
			<?php endif; ?>
		</ul>
	</nav>
</div>
