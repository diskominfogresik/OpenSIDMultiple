<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
	const rawData_<?=$lap?> = Object.values(<?= json_encode($stat) ?>);
	const type_<?=$lap?> = '<?= $tipe == 1 ? 'column' : 'pie' ?>';
	const legend_<?=$lap?> = Boolean(!<?= ($tipe) ?>);
	let categories_<?=$lap?> = [];
	let data_<?=$lap?> = [];
	let i_<?=$lap?> = 1;
	let status_tampilkan_<?=$lap?> = true;
	for (const stat of rawData_<?=$lap?>) {
		if (stat.nama !== 'TOTAL' && stat.nama !== 'JUMLAH' && stat.nama != 'PENERIMA') {
			let filteredData = [stat.nama, parseInt(stat.jumlah)];
			categories_<?=$lap?>.push(i_<?=$lap?>);
			data_<?=$lap?>.push(filteredData);
			i_<?=$lap?>++;
		}
	}

	function tampilkan_nol(tampilkan = false) {
		if (tampilkan) {
			$(".nol").parent().show();
		} else {
			$(".nol").parent().hide();
		}
	}

	function toggle_tampilkan_<?=$lap?>() {
		$('#showData').click();
		tampilkan_nol(status_tampilkan_<?=$lap?>);
		status_tampilkan_<?=$lap?> = !status_tampilkan_<?=$lap?>;
		if (status_tampilkan_<?=$lap?>) $('#tampilkan').text('Tampilkan Nol');
		else $('#tampilkan').text('Sembunyikan Nol');
	}

	function switchType_<?=$lap?>() {
		var chartType = chart_<?=$lap?>.series[0].type;
		chart_<?=$lap?>.series[0].update({
			type: (chartType === 'pie') ? 'column' : 'pie'
		});

		$("#barType_<?=$lap?>").html((chartType === 'pie') ? 'Pie Cart' : 'Bar Graph');
	}

	$(document).ready(function () {
		tampilkan_nol(false);
		if (<?=$this->setting->statistik_chart_3d?>) {
			chart_<?=$lap?> = new Highcharts.Chart({
				chart: {
					renderTo: 'container_<?=$lap?>',
					options3d: {
						enabled: true,
						alpha: 45
					}
				},
				title: 0,
				yAxis: {
					showEmpty: false,
				},
				xAxis: {
					categories: categories_<?=$lap?>,
				},
				plotOptions: {
					series: {
						colorByPoint: true
					},
					column: {
						pointPadding: -0.1,
						borderWidth: 0,
						showInLegend: false,
						depth: 45
					},
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						showInLegend: true,
						depth: 45,
						innerSize: 70
					}
				},
				legend: {
					enabled: legend_<?=$lap?>
				},
				series: [{
					type: type_<?=$lap?>,
					name: 'Jumlah Populasi',
					shadow: 1,
					border: 1,
					data: data_<?=$lap?>
				}]
			});
		} else {
			chart_<?=$lap?> = new Highcharts.Chart({
				chart: {
					renderTo: 'container_<?=$lap?>'
				},
				title: 0,
				yAxis: {
					showEmpty: false,
				},
				xAxis: {
					categories: categories_<?=$lap?>,
				},
				plotOptions: {
					series: {
						colorByPoint: true
					},
					column: {
						pointPadding: -0.1,
						borderWidth: 0,
						showInLegend: false,
					},
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						showInLegend: true,
					}
				},
				legend: {
					enabled: legend_<?=$lap?>
				},
				series: [{
					type: type_<?=$lap?>,
					name: 'Jumlah Populasi',
					shadow: 1,
					border: 1,
					data: data_<?=$lap?>
				}]
			});
		}

		$('#showData').click(function () {
			$('tr.lebih').show();
			$('#showData').hide();
			tampilkan_nol(false);
		});

	});
</script>
<style>
	tr.lebih {
		display: none;
	}
</style>
<style>
	.input-sm {
		padding: 4px 4px;
	}

	@media (max-width:780px) {
		.btn-group-vertical {
			display: block;
		}
	}

	.table-responsive {
		min-height:275px;
	}
</style>
<div class="card mb-2 fullscreen has-background-img ">
    <div id="accordiongrafik">
        <div class="card">
            <button class="btn btn-link text-white p-0" data-toggle="collapse" data-target="#collapseFourgrafik" aria-expanded="true" aria-controls="collapseFourgrafik">
                <div class="card-header bg-primary font-weight-bold" id="headingFourgrafik">LIHAT GRAFIK <i class="material-icons icon arrow">expand_more</i></div>
            </button>
            <div id="collapseFourgrafik" class="collapse" aria-labelledby="headingFourgrafik" data-parent="#accordiongrafik">
                <div class="card-header border-bottom">
                    <div class="media">
                        <div class="icon-circle icon-40 bg-light-primary mr-3">
                            <i class="material-icons">assessment</i>
                        </div>
            			<div class="media-body">
                			<h6 class="my-0 content-color-primary">Grafik <?= $heading ?></h6>
            				<p class="small mb-0">
            					<i class="material-icons icon-sm">local_offer</i> <?= ucwords($this->setting->sebutan_desa)." ".$desa["nama_desa"]?>
            				</p>
            			</div>
                        <a class="btn btn-primary btn-xs text-white" id="barType_<?=$lap?>" onclick="switchType_<?=$lap?>();">Bar Graph</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-0 content-color-secondary">
                        <div id="container_<?=$lap?>"></div>
                        <div id="contentpane">
                            <div class="ui-layout-north panel top"></div>
                        </div>
                    </div>
                </div>
        	</div>
    	</div>
	</div>
</div>
<?php if ($this->setting->daftar_penerima_bantuan):?>
<?php if (in_array($st, array('bantuan_keluarga', 'bantuan_penduduk'))):?>
<section class="content" id="maincontent">
	<div class="card mb-2 fullscreen has-background-img ">
		<input id="stat" type="hidden" value="<?=$lap?>">
		<div class="card-header border-bottom">
			<div class="media">
				<div class="icon-circle icon-40 bg-light-primary mr-3">
					<i class="material-icons">view_day</i>
				</div>
				<div class="media-body">
					<h6 class="my-0 content-color-primary">Daftar <?= $heading ?></h6>
					<p class="small mb-0">
						<i class="material-icons icon-sm">local_offer</i> <?= ucwords($this->setting->sebutan_desa)." ".$desa["nama_desa"]?>
					</p>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="mb-0 content-color-secondary">
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="peserta_program">
						<thead>
							<tr>
								<th>No</th>
								<th>Program</th>
								<th>Nama Peserta</th>
								<th>Alamat</th>
							</tr>
						</thead>
						<tfoot>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		var url = "<?= site_url($this->controller.'/ajax_peserta_program_bantuan')?>";
		table = $('#peserta_program').DataTable({
			'processing': true,
			'serverSide': true,
			"pageLength": 25,
			'order': [],
			"ajax": {
				"url": url,
				"type": "POST",
				"data": {stat: $('#stat').val()}
			},
			//Set column definition initialisation properties.
			"columnDefs": [
			{
				"targets": [ 0, 3 ], //first column / numbering column
				"orderable": false, //set not orderable
			},
			],
			'language': {
				'url': BASE_URL + '/assets/bootstrap/js/dataTables.indonesian.lang'
			},
			'drawCallback': function (){
				$('.dataTables_paginate > .pagination').addClass('pagination-sm no-margin');
			}
		});
	} );
</script>
<?php endif;?>
<?php endif;?>
<div class="card mb-2 fullscreen has-background-img ">
	<div class="card-header border-bottom">
		<div class="media">
			<div class="icon-circle icon-40 bg-light-primary mr-3">
				<i class="material-icons">view_day</i>
			</div>
			<div class="media-body">
				<h6 class="my-0 content-color-primary">Tabel <?= $heading ?></h6>
				<p class="small mb-0">
					<i class="material-icons icon-sm">local_offer</i> <?= ucwords($this->setting->sebutan_desa)." ".$desa["nama_desa"]?>
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
        				<th rowspan="2">No</th>
        				<th rowspan="2" style='text-align:left;'>Kelompok</th>
        				<th colspan="2" style='text-align:center'>Jumlah</th>
        				<th colspan="2" style='text-align:center'>Laki-laki</th>
        				<th colspan="2" style='text-align:center'>Perempuan</th>
        			</tr>
        			<tr>
        				<th style='text-align:center'>n</th><th style='text-align:center'>%</th>
        				<th style='text-align:center'>n</th><th style='text-align:center'>%</th>
        				<th style='text-align:center'>n</th><th style='text-align:center'>%</th>
        			</tr>
        			</thead>
        			<tbody>
        				<?php $i=0; $l=0; $p=0; $hide=""; $h=0; $jm1=1; $jm = count($stat);?>
        				<?php foreach ($stat as $data):?>
       					<?php $jm1++; ?>
       					<?php $h++; ?>
       					<?php if ($h > 12 AND $jm > 10): ?>
						<?php $hide = "lebih"; ?>
       					<?php endif;?>
        				<tr class="<?=$hide?>">
        					<td class="angka">
        						<?php if ($jm1 > $jm - 2):?>
       							<?=$data['no']?>
        						<?php else:?>
       							<?=$h?>
        						<?php endif;?>
        					</td>
        					<td><?=$data['nama']?></td>
        					<td class="angka <?php ($jm1 <= $jm - 2) and ($data['jumlah'] == 0) and print('nol')?>"><?=$data['jumlah']?></td>
        					<td class="angka"><?=$data['persen']?></td>
        					<td class="angka"><?=$data['laki']?></td>
        					<td class="angka"><?=$data['persen1']?></td>
        					<td class="angka"><?=$data['perempuan']?></td>
        					<td class="angka"><?=$data['persen2']?></td>
        				</tr>
        				<?php $i += $data['jumlah'];?>
        				<?php $l += $data['laki'];?>
        				<?php $p += $data['perempuan'];?>
        				<?php endforeach;?>
        			</tbody>
        		</table>
        		<?php if ($hide=="lebih"):?>
        		<div style='float: left;'>
        			<button class='uibutton special' id='showData'>Selengkapnya...</button>
        		</div>
        		<?php endif;?>
        		<div style="float: right;">
        			<button id='tampilkan' onclick="toggle_tampilkan_<?=$lap?>();" class="uibutton special">Tampilkan Nol</button>
        		</div>
    		</div>
	    </div>
	</div>
</div>
