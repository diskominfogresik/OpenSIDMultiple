<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="teks_berjalan">
	<?php foreach ($teks_berjalan AS $teks): ?>
	<span class="teks small"><?= $teks['teks']?>
		<?php if ($teks['tautan']): ?>
		<a href="<?= $teks['tautan'] ?>" rel="noopener noreferrer" title="Baca Selengkapnya"><?= $teks['judul_tautan']?></a>
		<?php endif; ?>
	</span>
	<?php endforeach; ?>
</div>
