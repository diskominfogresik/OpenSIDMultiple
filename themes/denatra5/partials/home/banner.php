<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $is_premium = preg_match('/premium/', ambilVersi()); ?>
<?php $action_link = $is_premium ? site_url('lapak') : site_url('first/statistik/bantuan_keluarga') ?>
<?php $desc_link = $is_premium ? 'Lapak' : 'Bantuan' ?>
<?php $idm_link = $is_premium ? site_url('status-idm/' . date('Y')) : site_url('first/status_idm') ?>

<div class="card mb-1 has-background-img">
	<section class="py-0 bg-white">
		<div class="container-fluid mt-2 main-container">
			<div class="row">
            <div class="col-lg-12">
                    <div class="row text-center">
                        <div class="col-4 col-lg-2 col-md-2">
                            <div class="counter-box text-center mt-2 mb-2">
                                <a href="<?= site_url() ?>first/wilayah">
                                    <img src="<?= base_url("$this->theme_folder/$this->theme/assets/image/statistik.svg") ?>" height="60" />
                                    <div class="small">Statistik</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-4 col-lg-2 col-md-2">
                            <div class="counter-box text-center mt-2 mb-2">
                                <a href="<?= $action_link ?>">
                                    <img src="<?= base_url("$this->theme_folder/$this->theme/assets/image/bantuan.svg") ?>" height="60" />
                                    <div class="small"><?= $desc_link ?></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-4 col-lg-2 col-md-2">
                            <div class="counter-box text-center mt-2 mb-2">
                                <a href="<?= $idm_link ?>">
                                    <img src="<?= base_url("$this->theme_folder/$this->theme/assets/image/idm.svg") ?>" height="60" />
                                    <div class="small">Status IDM</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-4 col-lg-2 col-md-2">
                            <div class="counter-box text-center mt-2 mb-2">
                                <a href="<?= site_url() ?>peta">
                                    <img src="<?= base_url("$this->theme_folder/$this->theme/assets/image/peta.svg") ?>" height="60" />
                                    <div class="small">Peta Desa</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-4 col-lg-2 col-md-2">
                            <div class="counter-box text-center mt-2 mb-2">
                                <a href="<?= site_url() ?>peraturan_desa" rel="noopener noreferrer" target="_top">
                                    <img src="<?= base_url("$this->theme_folder/$this->theme/assets/image/grafik.svg") ?>" height="60" />
                                    <div class="small">Peraturan Desa</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-4 col-lg-2 col-md-2">
                            <div class="counter-box text-center mt-2 mb-2">
                                <a href="<?= site_url() ?>arsip" rel="noopener noreferrer" target="_top">
                                    <img src="<?= base_url("$this->theme_folder/$this->theme/assets/image/apk.svg") ?>" height="60" />
                                    <div class="small">Artikel</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
