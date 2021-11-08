<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if($single_artikel["id"]) : ?>
<div class="card mb-1 fullscreen has-background-img ">
	<div id="printableArea">
		<div class="card-header border-bottom">
			<div class="media">
				<div class="icon-circle icon-40 bg-light-primary mr-3">
					<i class="material-icons">fingerprint</i>
				</div>
				<div class="media-body">
					<h5 class="my-0 content-color-primary"><?= $single_artikel["judul"] ?></h5>
					<p class="small mb-0">
						<i class="fa fa-calendar" aria-hidden="true"></i> <?= tjs($single_artikel['tgl_upload'],'s');?>
						<i class="fa fa-heart" aria-hidden="true"></i> <?= hit($single_artikel['hit']) ?>
					</p>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="mb-0 content-color-secondary">
				<?php if($single_artikel['id_kategori'] == 1000) : ?>
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="card mb-2 success-gradient">
							<div class="card-body">
								<div class="media">
									<div class="media-body">
										<p class="text-white mb-0 small">Tanggal & Jam</p>
										<p class="text-white mb-0"><?= tjs($detail_agenda['tgl_agenda'],'s')?></p>
									</div>
									<div class="icon-circle icon-50 bg-light-white">
										<i class="fa fa-calendar" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="card mb-2 warning-gradient">
							<div class="card-body">
								<div class="media">
									<div class="media-body">
										<p class="text-white mb-0 small">Lokasi</p>
										<p class="text-white mb-0"><?= $detail_agenda['lokasi_kegiatan']?></p>
									</div>
									<div class="icon-circle icon-50 bg-light-white">
										<i class="fa fa-location-arrow" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="card mb-2 pink-gradient">
							<div class="card-body">
								<div class="media">
									<div class="media-body">
										<p class="text-white mb-0 small">Koordinator</p>
										<p class="text-white mb-0"><?= $detail_agenda['koordinator_kegiatan']?></p>
									</div>
									<div class="icon-circle icon-50 bg-light-white">
										<i class="fa fa-user" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php if($single_artikel['gambar']!='' and is_file(LOKASI_FOTO_ARTIKEL."sedang_".$single_artikel['gambar'])): ?>
				<a data-fancybox="gallery" href="<?= AmbilFotoArtikel($single_artikel['gambar'],'sedang') ?>">
					<img src="<?= AmbilFotoArtikel($single_artikel['gambar'],'sedang') ?>" width="<?php if ($single_artikel["isi"]=='<p>&nbsp;&nbsp;</p>') { print('100%'); } else { print('300px'); } ?>" style="float:left; margin:0 8px 4px 0;" class="cover img-fluid border opacity-100" />
				</a>
				<?php endif; ?>
				<div class="mb-2">
					<div class="fb-like" data-href="<?= site_url('artikel/'.buat_slug($single_artikel))?>" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
				</div>
				<div class="content-color-primary"><?= $single_artikel["isi"]?></div>
				<?php if($single_artikel['dokumen']!='' and is_file(LOKASI_DOKUMEN.$single_artikel['dokumen'])): ?>
				<div class="card mb-0 bg-light-primary border border-primary no-shadow">
					<div class="card-body p-2">
						<div class="media">
							<div class="media-body">
								<p class="mb-0"><?= $single_artikel['link_dokumen']?></p>
								<h5 class="mb-0"><?= fsize(LOKASI_DOKUMEN.$single_artikel['dokumen'])?></h5>
							</div>
							<a href="<?= site_url("first/unduh_dokumen_artikel/{$single_artikel[id]}") ?>" class="icon-rounded btn btn-primary text-white mx-auto mt-0" rel='noopener noreferrer' target='_blank' />
								<i class="material-icons text-white">cloud_download</i> Unduh
							</a>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php if($single_artikel['gambar1']!='' and is_file(LOKASI_FOTO_ARTIKEL."sedang_".$single_artikel['gambar1'])): ?>
				<a data-fancybox="gallery" href="<?= AmbilFotoArtikel($single_artikel['gambar1'],'sedang')?>">
					<img src="<?= AmbilFotoArtikel($single_artikel['gambar1'],'sedang')?>" class="img-responsive cover img-fluid border opacity-100" />
				</a>
				<?php endif; ?>
				<?php if($single_artikel['gambar2']!='' and is_file(LOKASI_FOTO_ARTIKEL."sedang_".$single_artikel['gambar2'])): ?>
				<a data-fancybox="gallery" href="<?= AmbilFotoArtikel($single_artikel['gambar2'],'sedang')?>">
					<img src="<?= AmbilFotoArtikel($single_artikel['gambar2'],'sedang')?>" class="img-responsive cover img-fluid border opacity-100 mt-2" />
				</a>
				<?php endif; ?>
				<?php if($single_artikel['gambar3']!='' and is_file(LOKASI_FOTO_ARTIKEL."sedang_".$single_artikel['gambar3'])): ?>
				<a data-fancybox="gallery" href="<?= AmbilFotoArtikel($single_artikel['gambar3'],'sedang')?>">
					<img src="<?= AmbilFotoArtikel($single_artikel['gambar3'],'sedang')?>" class="img-responsive cover img-fluid border opacity-100 mt-2" />
				</a>
				<?php endif; ?>
			</div>
		</div>
		<div class="card-footer border-top border-bottom">
			<div class="row">
				<div class="col">
					<div class="media">
						<div class="media-body">
							<p class="content-color-secondary mb-0 small">
								<?php if ($data['boleh_komentar'] == 1): ?>
								<i class="material-icons icon-sm">chat</i> <?= number_format($this->db->query("SELECT * FROM komentar WHERE id_artikel = '".$single_artikel['id']."' AND status ='1'")->num_rows(),0,',','.') ?> Komentar
								<?php else: ?>
								<i class="fa fa-flag" aria-hidden="true"></i> Berita Desa
								<?php endif; ?>
								<?php if (trim($single_artikel['kategori']) != '') : ?>
								<a href="<?= site_url('first/kategori/'.$single_artikel['id_kategori'])?>" class="content-color-secondary">
									<i class="fa fa-flag" aria-hidden="true"></i> <?= $single_artikel['kategori']?>
								</a>
								<?php endif; ?>
							</p>
						</div>
					</div>
				</div>
				<div class="text-right pr-3">
					<div class="media">
						<div class="media-body">
							<p class="content-color-secondary mb-0 small">
								<i class="fa fa-user" aria-hidden="true"></i> <?= $single_artikel['owner'] ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body border-bottom mt-0">
		<div class="row text-center">
			<div class="col no-gutters content-color-secondary small">
				<a name="fb_share" href="http://www.facebook.com/sharer.php?u=<?= site_url('artikel/'.buat_slug($single_artikel))?>" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel='noopener noreferrer' target='_blank' title='Facebook'><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-facebook-square fa-2x"></i></button></a>
				<a href="http://twitter.com/share?source=sharethiscom&url=<?= site_url('artikel/'.buat_slug($single_artikel)) ?>&text=<?= $single_artikel["judul"];?>%0A" class="twitter-share-button" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel='noopener noreferrer' target='_blank' title='Twitter'><button type="button" class="btn btn-info btn-sm"><i class="fa fa-twitter fa-2x"></i></button></a>
				<a href="mailto:?subject=<?= $single_artikel["judul"];?>&body=<?= potong_teks($single_artikel["isi"], 1000);?> ... Selengkapnya di <?= site_url('artikel/'.buat_slug($single_artikel))?>" title='Email'><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-envelope fa-2x"></i></button></a>
				<a href="https://telegram.me/share/url?url=<?= site_url('artikel/'.buat_slug($single_artikel))?>&text=<?= $single_artikel["judul"];?>%0A" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel='noopener noreferrer' target='_blank' title='Telegram'><button type="button" class="btn btn-dark btn-sm"><i class="fa fa-telegram fa-2x"></i></button></a>
				<a href="javascript:void(0);" onclick="printDiv('printableArea')" title='Cetak Artikel'><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-print fa-2x"></i></button></a>
				<a href="https://api.whatsapp.com/send?text=<?= site_url('artikel/'.buat_slug($single_artikel))?>%0A<?= $single_artikel["judul"];?>" onclick='window.open(this.href,"popupwindow","status=0,height=500,width=500,resizable=0,top=50,left=100");return false;' rel='noopener noreferrer' target='_blank' title='Whatsapp'><button type="button" class="btn btn-success btn-sm"><i class="fa fa-whatsapp fa-2x"></i></button></a>
			</div>
		</div>
	</div>
	<?php if ($single_artikel['boleh_komentar'] == 1): ?>
	<div class="ml-2 mr-2">
		<div class="fb-comments" data-href="<?= site_url('artikel/'.buat_slug($single_artikel))?>" width="100%" data-numposts="5"></div>
	</div>
	<?php endif; ?>
</div>
<div class="card mb-1 fullscreen has-background-img">
	<div class="mb-0">
		<?php if(!empty($komentar)): ?>
		<div class="card-header border-bottom">
			<div class="media">
				<div class="icon-circle icon-40 bg-light-primary mr-3">
					<i class="material-icons">business</i>
				</div>
				<div class="media-body">
					<h6 class="my-0 content-color-primary">Komentar</h6>
					<p class="small mb-0">Pada artikel ini</p>
				</div>
			</div>
		</div>
		<div class="card-body border-bottom">
			<?php foreach($komentar AS $data): ?>
			<ul class="list-group list-group-flush w-100 log-information mt-2">
				<li class="list-group-item">
					<div class="avatar avatar-15 border-success"></div>
					<div class="media experience">
						<div class="icon-rounded icon-40 bg-light-success mr-3">
							<i class="material-icons icon-sm">person</i>
						</div>
						<div class="media-body">
							<h6 class="my-0 content-color-primary"><?= $data['owner']?></h6>
							<p class="mb-2"><small class="content-color-secondary"><?= tgl_indo2($data['tgl_upload'])?></small></p>
							<div class="card-text"><?= $data['komentar']?></div>
						</div>
					</div>
				</li>
			</ul>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
	<?php if ($single_artikel['boleh_komentar'] == 1): ?>
	<div id="kolom-komentar" class="card-header border-bottom">
		<div class="media">
			<div class="icon-circle icon-40 bg-light-danger mr-3">
				<i class="material-icons">business</i>
			</div>
			<div class="media-body">
				<h6 class="my-0 content-color-primary">Kirim Komentar</h6>
				<p class="small mb-0">Untuk artikel ini</p>
			</div>
		</div>
	</div>
	<div class="container-fluid mt-0 main-container z-index-1">
		<div class="row">
			<div class="col-12 p-4">
				<?php
				$notif = $this->session->flashdata('notif');
				$label = ($notif['status'] == -1) ? 'alert-danger' : 'alert-success';
				?>
				<?php if ($notif): ?>
				<div class="alert <?= $label?>" role="alert"><?= $notif['pesan']; ?></div>
				<?php endif; ?>
				<form class="contact_form form-validasi" id="validasi" name="form" action="<?= site_url("add_comment/$single_artikel[id]"); ?>" method="POST" onSubmit="return validasi(this);">
					<div class="row">
						<div class="col-12 col-lg-6 col-md-6 mb-2">
							<label class="sr-only">Your Name</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="material-icons">person</i>
									</span>
								</div>
								<input class="form-control required" type="text" name="owner" maxlength="100" placeholder="Nama Anda" value="<?= $notif['data']['owner']; ?>">
							</div>
						</div>
						<div class="col-12 col-lg-6 col-md-6 mb-2">
							<label class="sr-only">No. Hp</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="material-icons">stay_current_portrait</i>
									</span>
								</div>
								<input class="form-control number required" type="text" name="no_hp" maxlength="15" placeholder="Nomor Hp Anda" value="<?= $notif['data']['no_hp']; ?>">
							</div>
						</div>
					</div>
					<label class="sr-only">Email address</label>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="material-icons">mail</i>
							</span>
						</div>
						<input class="form-control email" type="text" name="email" maxlength="100" placeholder="Alamat Email Anda" value="<?= $notif['data']['email']; ?>">
					</div>
					<label class="sr-only">Message</label>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="material-icons">chat</i>
							</span>
						</div>
						<textarea rows="5" class="form-control required" placeholder="Tulis Pesan Anda" name="komentar"><?= $notif['data']['komentar']; ?></textarea>
					</div>
					<div class="row">
						<div class="col-12 col-lg-4 col-md-4 mb-2">
							<div class="input-group">
								<div class="input-group-prepend">
									<a href="javascript:void(0);" onclick="document.getElementById('captcha').src = '<?= base_url()."securimage/securimage_show.php?"?>' + Math.random(); return false">
										<img id="captcha" src="<?= base_url('securimage/securimage_show.php'); ?>" class="img-responsive cover">
									</a>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3 col-md-3 mb-2">
							<div class="input-group">
								<div class="input-group-prepend">
									<input type="text" class="form-control required" name="captcha_code" maxlength="6" placeholder="Isi jawaban" value="<?= $notif['data']['captcha_code']; ?>">
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-2 col-md-2 mb-2">
							<button class="btn pink-gradient text-uppercase">Kirim</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php else: ?>
<div class="card mb-1 fullscreen has-background-img ">
	<div class="card-header border-bottom">
		<div class="media">
			<div class="icon-circle icon-40 bg-light-primary mr-3">
				<i class="material-icons">business</i>
			</div>
			<div class="media-body">
				<h6 class="my-0 content-color-primary">Error 404</h6>
				<p class="small mb-0">
					<i class="material-icons icon-sm">date_range</i> <?= date("d F Y H:i:s", gmdate(now()));?>
				</p>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="col-12 mx-auto text-center">
            <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/404.svg") ?>" alt="" class="mw-100 mt-2">
            <h2 class="text-black">404! ARTIKEL TIDAK DITEMUKAN</h2>
            <p class="lead mb-4 text-black">Anda telah terdampar di halaman yang datanya tidak ada lagi di web ini.<br>Mohon periksa kembali, atau laporkan kepada kami.</p>
            <a href="<?= site_url() ?>">
                <button class="btn btn-success success-gradient btn-rounded mb-4" type="button">
                    <span class="icon fa fa-angle-double-left mr-2"></span> Kembali ke Halaman Utama
                </button>
            </a>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if($single_artikel["id"]): ?>
<?php $this->load->view("$folder_themes/partials/home/banner"); ?>
<?php endif; ?>
