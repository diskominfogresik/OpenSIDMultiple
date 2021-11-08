<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="card mb-2 fullscreen has-background-img ">
	<div class="card-header border-bottom">
		<div class="media">
			<div class="icon-circle icon-40 bg-light-primary mr-3">
				<i class="material-icons">view_day</i>
			</div>
			<div class="media-body">
				<h6 class="my-0 content-color-primary">Tabel <?= $heading ?></h6>
				<p class="small mb-0">
					<i class="material-icons icon-sm">local_offer</i> Demografi <?= ucwords($this->setting->sebutan_desa)." ".$desa['nama_desa']?>
				</p>
			</div>
		</div>
	</div>
	<div class="card-body">
		<?php if(count($main) > 0) : ?>
		<div class="mb-0 content-color-secondary">
		    <div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th><?= ucwords($this->setting->sebutan_dusun)?></th>
							<th>RW</th>
							<th>RT</th>
							<th>Nama Ketua RT</th>
							<th class="center">KK</th>
							<th class="center">L+P</th>
							<th class="center">L</th>
							<th class="center">P</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($main as $indeks => $data): ?>
						<tr>
							<td align="center"><?= $indeks + 1?></td>
							<td><?= ($main[$indeks - 1]['dusun'] == $data['dusun']) ? '' : strtoupper($data['dusun'])?></td>
							<td><?= ($main[$indeks - 1]['rw'] == $data['rw']) ? '' : $data['rw']?></td>
							<td><?= $data['rt']?></td>
							<td><?= $data['nama_kepala']?></td>
							<td class="center"><?= $data['jumlah_kk']?></td>
							<td class="center"><?= $data['jumlah_warga']?></td>
							<td class="center"><?= $data['jumlah_warga_l']?></td>
							<td class="center"><?= $data['jumlah_warga_p']?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5" align="left"><label>TOTAL</label></td>
							<td class="center"><?= $total['total_kk']?></td>
							<td class="center"><?= $total['total_warga']?></td>
							<td class="center"><?= $total['total_warga_l']?></td>
							<td class="center"><?= $total['total_warga_p']?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<?php else : ?>
			Belum ada data...
		<?php endif ?>
	</div>
</div>
