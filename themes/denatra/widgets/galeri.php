<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- widget Galeri-->
<div class="card mb-2">
	<div class="card-header border-bottom">
		<div class="media">
			<div class="media-body">
				<h4 class="content-color-primary mb-0"><i class="material-icons icon-sm">insert_photo</i> <a href="<?= site_url();?>first/gallery">Galeri Foto</a></h4>
			</div>    
		</div>
	</div>
	<div class="card-body text-center">
		<?php foreach ($w_gal As $data): ?>
		<?php if (is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])): ?>
		<a href='<?= site_url("first/sub_gallery/$data[id]"); ?>' title="<?= "Album : $data[nama]" ?>">
		    <img src="<?= AmbilGaleri($data['gambar'], 'kecil') ?>" width="130" class="img-responsive cover mb-2">
		</a>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
