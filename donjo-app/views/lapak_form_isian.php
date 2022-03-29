<div class="col-md-3">

    <div class="box box-primary">
        <div class="box-body box-profile">
            <img class="penduduk profile-user-img img-responsive img-circle" id="foto" src="<?= AmbilFoto($lapak['foto_lapak']); ?>" alt="Foto">
            <br />
            <div class="input-group input-group-sm text-center">
                <input type="file" class="input" id="file" name="foto">
                <!-- <input type="text" class="hidden" id="file_path" name="foto"> -->
                <input type="hidden" name="old_foto" id="old_foto" value="<?= $lapak['foto_lapak'] ?>">
                <!-- <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat" id="file_browser"><i class="fa fa-upload"></i> Unggah</button>
                    <button type="button" class="btn btn-danger btn-flat" onclick="kamera();"><i class="fa fa-camera"></i> Kamera</button>
                </span> -->
            </div>
        </div>
    </div>
</div>
<div class="col-md-9">
    <div class='box box-primary'>
        <div class="box-header with-border">
            <a href="<?= site_url('lapak') ?>" class="btn btn-social btn-flat btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Data Lapak"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Data Lapak</a>
        </div>
        <div class='box-body'>
            <?php $this->load->view('lapak_form_isian_bersama'); ?>
        </div>

        <div class='box-footer'>
            <button href="<?= site_url('lapak') ?>" type='reset' class='btn btn-social btn-flat btn-danger btn-sm'><i class='fa fa-times'></i> Batal</button>
            <button type="submit" name="upload" value="upload" class="btn btn-social btn-flat btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
        </div>

    </div>
</div>
<?php $this->load->view('global/capture'); ?>