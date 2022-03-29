<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">

<head>
    <?php $this->load->view("$folder_themes/commons/meta.php"); ?>
</head>

<body>
    <!--
<div id="preloader">
		<div id="status">&nbsp;</div>
</div>
-->
    <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
    <div class="container" style="background-color: #f6f6f6;">
        <header id="header">
            <?php $this->load->view("$folder_themes/partials/header.php"); ?>
        </header>
        <div id="navarea">
            <?php $this->load->view("$folder_themes/partials/menu_head.php"); ?>
        </div>
        <div class="row">
            <section>
                <div class="content_middle"></div>
                <div class="content_bottom">
                    <div class="col-lg-9 col-md-9">
                        <?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


                        <div class="single_page_area" id="<?= 'artikel-' . $single_artikel['judul'] ?>">
                            <div style="margin-top:0px;">
                                <?php if (!empty($teks_berjalan)) : ?>
                                    <marquee onmouseover="this.stop()" onmouseout="this.start()">
                                        <?php $this->load->view($folder_themes . '/layouts/teks_berjalan.php'); ?>
                                    </marquee>
                                <?php endif; ?>
                            </div>
                            <div class="single_category wow fadeInDown">
                                <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <span class="title_text">Lapak</span> </h2>
                            </div>

                        </div>






                        <div class="row">
                            <?php foreach ($lapak as $row) : ?>
                                <div class="modal fade" id="exampleModal_<?php echo $row->id_lapak; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Deskripsi</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true"></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><?php echo $row->deskripsi ?></p>
                                                <p>Lokasi : <?php echo $row->lokasi_lapak ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="caption text-center" onclick="location.href='https://flow.microsoft.com/en-us/connectors/shared_slack/slack/'">
                                        <div class="position-relative">
                                            <!-- <img src="https://az818438.vo.msecnd.net/icons/slack.png" style="width:72px;height:72px;" /> -->
                                            <img src="https://az818438.vo.msecnd.net/icons/slack.png" />
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="font-weight-bold "><b> <?php echo $row->nama_lapak ?></b></div>
                                        <br>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone=+62<?php echo $row->kontak_lapak ?>&amp;text=Silahkan ketik pesan anda" rel="noopener noreferrer" target="_blank" title="WhatsApp +628157985118"><i class="fa fa-whatsapp"></i> Pesan</a>
                                                <a class="btn btn-sm btn-danger text-white" href="<?php echo $row->koordinat ?>" title="Titik Lokasi"><i class="fa fa-map"></i> Lokasi</a>
                                                <a class="btn btn-sm btn-primary text-white" data-remote="false" data-toggle="modal" data-target="#exampleModal" title="Deskripsi"><i class="fa fa-info-circle"></i> Deskripsi</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-3">
                        <?php $this->load->view("$folder_themes/partials/bottom_content_right.php"); ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <footer id="footer">
        <?php $this->load->view("$folder_themes/partials/footer_top.php"); ?>
        <?php $this->load->view("$folder_themes/partials/footer_bottom.php"); ?>
    </footer>
    <?php $this->load->view("$folder_themes/commons/meta_footer.php"); ?>
</body>

</html>