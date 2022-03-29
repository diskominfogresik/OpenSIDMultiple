<div class="row">

    <div class='col-sm-12'>
        <div class="form-group subtitle_head">
            <label class="text-right"><strong>Data Lapak :</strong></label>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="nama_lapak">Nama Lapak </label>
            <input id="nama_lapak" name="nama_lapak" class="form-control input-sm required nama" maxlength="100" type="text" placeholder="Nama Lapak"></input>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <input id=" id_lapak" name="id_lapak" class="form-control input-sm " type="hidden" placeholder="Id Lapak"></input>
        </div>
    </div>
    <div class='col-sm-12'>

        <div class=" row" id="section_ktp_el">
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="kontak_lapak">Kontak Lapak (No. Whatsapp) </label>
                    <input id="kontak_lapak" name="kontak_lapak" class="form-control input-sm" maxlength="100" type="text" placeholder="Kontak Lapak"></input>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="tempat_cetak_ktp">Lokasi Lapak</label>
                    <input id="lokasi_lapak" name="lokasi_lapak" class="form-control input-sm" maxlength="100" type="text" placeholder="Lokasi Lapak"></input>
                </div>
            </div>

        </div>
    </div>
    <div class="col-sm-12">

    </div>
    <div class='col-sm-8'>
        <div class='form-group'>
            <label for="deskripsi">Deskripsi</label>
            <input id="deskripsi" name="deskripsi" class="form-control input-sm " maxlength="30" type="text" placeholder="Deskripsi"></input>
        </div>
    </div>

</div>
<!-- 
    <div class='col-sm-12'>
        <div class="form-group subtitle_head">
            <label class="text-right"><strong>Data Lapak :</strong></label>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <label for="nama_lapak">Nama Lapak </label>
            <input id="nama_lapak" name="nama_lapak" class="form-control input-sm required nama" maxlength="100" type="text" placeholder="Nama Lapak" value="<?= $lapak['nik'] ?>"></input>
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='form-group'>
            <input id="id_lapak" name="id_lapak" class="form-control input-sm " type="hidden" placeholder="Id Lapak" value="<?= $lapak['id_lapak'] ?>"></input>
        </div>
    </div>
    <div class='col-sm-12'>

        <div class="row" id="section_ktp_el">
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="kontak_lapak">Kontak Lapak (No. Whatsapp) </label>
                    <input id="kontak_lapak" name="kontak_lapak" class="form-control input-sm" maxlength="100" type="text" placeholder="Kontak Lapak" value="<?= $lapak['kontak_lapak'] ?>"></input>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="tempat_cetak_ktp">Lokasi Lapak</label>
                    <input id="lokasi_lapak" name="lokasi_lapak" class="form-control input-sm" maxlength="100" type="text" placeholder="Lokasi Lapak" value="<?= $lapak['lokasi'] ?>"></input>
                </div>
            </div>

        </div>
    </div>
    <div class="col-sm-12">

    </div>
    <div class='col-sm-8'>
        <div class='form-group'>
            <label for="deskripsi">Deskripsi</label>
            <input id="deskripsi" name="deskripsi" class="form-control input-sm " maxlength="30" type="text" placeholder="Deskripsi" value="<?= $lapak['deskripsi'] ?>"></input>
        </div>
    </div>

</div> -->

<script type="text/javascript">
    function AmbilFoto(foto, ukuran = "kecil_") {


        ukuran_foto = ukuran || null
        file_foto = '<?= base_url() . LOKASI_LAPAK_PICT; ?>' + ukuran_foto + foto;

        return file_foto;
    }
</script>