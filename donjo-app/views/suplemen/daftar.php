<div class="content-wrapper">
	<section class="content-header">
		<?php if ($tampil == 0): ?>
			<h1>Data Suplemen</h1>
		<?php else: ?>
			<h1>Data Suplemen Dengan Sasaran <?=$sasaran[$tampil]?></h1>
		<?php endif; ?>
		<ol class="breadcrumb">
			<li><a href="<?=site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Data Suplemen</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?=site_url('suplemen/create')?>" class="btn btn-social btn-flat bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Suplemen Baru"><i class="fa fa-plus"></i> Tambah Suplemen Baru</a>
							<a href="<?=site_url('suplemen/panduan')?>" class="btn btn-social btn-flat btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Program Bantuan Baru"><i class="fa fa-question-circle"></i> Panduan</a>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
										<form id="mainform" name="mainform" action="" method="post">
											<div class="row">
												<div class="col-sm-12">
													<div class="table-responsive">
														<table class="table table-bordered table-striped dataTable table-hover nowrap">
															<thead class="bg-gray disabled color-palette">
																<tr>
																	<th>No</th>
																	<th>Aksi</th>
																	<th>Nama Data</th>
																	<th>Sasaran</th>
																</tr>
															</thead>
																<tbody>
																	<?php
																		$nomer = 0;
																		foreach ($suplemen as $item):
																		$nomer++;
																	?>
																	<tr>
																		<td><?= $nomer; ?></td>
																		<td nowrap>
																			<a href="<?= site_url('suplemen/rincian/1/'.$item["id"].'/'); ?>" class="btn bg-purple btn-flat btn-sm"  title="Rincian Data"><i class="fa fa-list-ol"></i></a>
																			<a href="<?= site_url('suplemen/edit/'.$item["id"].'/'); ?>" class="btn bg-orange btn-flat btn-sm"  title="Ubah Data"><i class='fa fa-edit'></i></a>
																			<a href="#" data-href="<?= site_url('suplemen/hapus/'.$item["id"].'/'); ?>" class="btn bg-maroon btn-flat btn-sm"  title="Hapus Data" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																		</td>
																		<td width="70%"><a href="<?= site_url('suplemen/rincian/1/'.$item["id"].'/')?>"><?= $item["nama"] ?></a></td>
																		<td><a href="<?= site_url('suplemen/sasaran/'.$item["sasaran"])?>"><?= $sasaran[$item["sasaran"]]?></a></td>
																	</tr>
																	<?php endforeach; ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
<?php $this->load->view('global/confirm_delete');?>