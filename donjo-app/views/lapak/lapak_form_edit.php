<div class="content-wrapper">
    <section class="content-header">
        <h1>Data Lapak</h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('hom_sid') ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?= site_url('lapak/clear') ?>"> Daftar Lapak</a></li>
            <li class="active">Data Lapak</li>
        </ol>
    </section>
    <section class="content" id="maincontent">
        <form action="<?php echo site_url('lapak/update') ?>" id="mainform" name="mainform" method="POST" enctype="multipart/form-data">
            <div class="row">
                <?php include("donjo-app/views/lapak/lapak_form_isian_edit.php"); ?>
            </div>
        </form>
    </section>
</div>