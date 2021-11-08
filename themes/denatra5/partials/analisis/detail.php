<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<script type="text/javascript">
	$(document).ready(function() {
		hiRes ();
	});

	var chart;
	function hiRes () {
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'chart',
				border:0,
				defaultSeriesType: 'column'
			},
			title: {
				text: ''
			},
			xAxis: {
				title: {
					text:''
				},
				categories: [
				<?php $i=0;foreach ($list_jawab as $data){$i++;?>
					<?php if ($data['nilai'] != "-"){echo "'$data[jawaban]',";}?>
				<?php }?>
				]
			},
			yAxis: {
				title: {
					text: 'Jumlah Populasi'
				}
			},
			legend: {
				layout: 'vertical',
				enabled:false
			},
			plotOptions: {
				series: {
					colorByPoint: true
				},
				column: {
					pointPadding: 0,
					borderWidth: 0
				}
			},
			series: [{
				shadow:1,
				border:0,
				data: [
				<?php foreach ($list_jawab as $data){?>
					<?php if ($data['jawaban'] != "TOTAL"){?>
						<?php if ($data['nilai'] != "-"){?>
							<?= $data['nilai']?>,
						<?php }?>
					<?php }?>
				<?php }?>
				]
			}]
		});
	};
</script>
<style>
	tr#total {
		background:#fffdc5;
		font-size:12px;
		white-space:nowrap;
		font-weight:bold;
	}
	h3 {
		margin-left: 10px;
	}
</style>
<div class="card mb-1">
	<div class="card-header border-bottom">
		<div class="media">
			<div class="icon-circle icon-40 bg-light-primary mr-3">
				<i class="material-icons">folder</i>
			</div>
			<div class="media-body">
				<h6 class="my-0 content-color-primary"><?= $indikator; ?></h6>
				<p class="small mb-0">
					<i class="material-icons icon-sm">date_range</i> <?= ucwords($this->setting->sebutan_desa)." ".$desa['nama_desa']?>
				</p>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="mb-0 content-color-secondary">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<td width="3%"><b>No.</b></td>
							<td><b>Jawaban</b></td>
							<td width="20%"><b>Jumlah Responden</b></td>
						</tr>
					</thead>
					<tbody>
					    <?php foreach ($list_jawab as $data): ?>
        					<tr>
        						<td><?= $data['no']; ?></td>
        						<td><?= $data['jawaban']; ?></td>
        						<td><?= $data['nilai']; ?></td>
        					</tr>
        				<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
