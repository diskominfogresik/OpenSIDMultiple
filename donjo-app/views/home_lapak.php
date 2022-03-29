<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php if ($single_artikel["id"]) : ?>
    <div class="single_page_area" id="<?= 'artikel-' . $single_artikel['judul'] ?>">
        <div style="margin-top:0px;">
            <?php if (!empty($teks_berjalan)) : ?>
                <marquee onmouseover="this.stop()" onmouseout="this.start()">
                    <?php $this->load->view($folder_themes . '/layouts/teks_berjalan.php'); ?>
                </marquee>
            <?php endif; ?>
        </div>
        <div class="single_category wow fadeInDown">
            <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <span class="title_text">Artikel</span> </h2>
        </div>
        <h2> TES </h2>
        <div id="printableArea">
            <h4 class="catg_titile" style="font-family: Oswald">
                <font color="#FFFFFF"><?= $single_artikel["judul"] ?></font>
            </h4>
            <div class="post_commentbox">
                <span class="meta_date"><?= tgl_indo2($single_artikel['tgl_upload']); ?>&nbsp;
                    <i class="fa fa-user"></i><?= $single_artikel['owner'] ?>&nbsp;
                    <i class="fa fa-eye"></i><?= hit($single_artikel['hit']) ?> Dibaca&nbsp;
                    <?php if (trim($single_artikel['kategori']) != '') : ?>
                        <a href="<?= site_url('first/kategori/' . $single_artikel['id_kategori']) ?>"><i class='fa fa-tag'></i><?= $single_artikel['kategori'] ?></a>
                    <?php endif; ?>
                </span>
                <div class="fb-like" data-href="<?= site_url('artikel/' . buat_slug($single_artikel['id'])) ?>" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
            </div>
            <div class="single_page_content" style="margin-bottom:10px;">
                <?php if ($single_artikel['id_kategori'] == 1000) : ?>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tanggal & Jam</span>
                                    <span class="progress-description">
                                        <?= tgl_indo2($detail_agenda['tgl_agenda']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="info-box bg-success box-primary-shadow">
                                <span class="info-box-icon"><i class="fa fa-map-marker"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Lokasi</span>
                                    <span class="progress-description">
                                        <?= $detail_agenda['lokasi_kegiatan'] ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="info-box bg-danger">
                                <span class="info-box-icon"><i class="fa fa-bullhorn"></i></span>
                                <div class="info-box-content">
                                <span class="info-box-text">Koordinator</span>
                                    <span class="progress-description">
                                        <?= $detail_agenda['koordinator_kegiatan'] ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="sampul">

                </div>
                <div class="teks"><?= $single_artikel["isi"] ?></div>

            </div>
        </div>

    </div>

    <div class="contact_bottom">
        <?php if (!empty($komentar)) : ?>
            <div class="contact_bottom">
                <div class="box-body">
                    <?php foreach ($komentar as $data) : ?>
                        <table class="table table-bordered table-striped dataTable table-hover">
                            <thead class="bg-gray disabled color-palette">
                                <tr>
                                    <th><i class="fa fa-comment"></i> <?= $data['owner'] ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <font color='green'><small><?= tgl_indo2($data['tgl_upload']) ?></small></font><br /><?= $data['komentar'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>


    </div>
    </div>
<?php else : ?>
    <span class='info'></span>
<?php endif; ?>
</div>