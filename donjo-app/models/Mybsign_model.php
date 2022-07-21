<?php class Mybsign_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // MYB
    /**
     * fungsi ambil nama file
     * berdasarkan id permohonan surat dibandingkan dengan explode log keterangan
     * @param int $id ID permohonan
     * @param bool $isForSignedFile flag apakah ambil doc yg sudah signed bssn atau belum
     */
    public function getNamaSuratFromLogById($id, $isForSignedFile = false)
    {
        $namasurat = '';
        try {
            $sql = "SELECT * FROM
				(
				SELECT log_surat.* 
				, SUBSTRING_INDEX(keterangan, '_', 1) AS tmp
				FROM log_surat
				) A
				WHERE A.tmp=$id ORDER BY id DESC LIMIT 1";
            // $data = $this->db->query($sql)->row()->nama_surat;
            $data = $this->db->query($sql)->row();
        } catch (Exception $ex) {
            $data = null;
        }

        if ($data) {
            if ($isForSignedFile === false) {
                $namasurat = $data->nama_surat;
            } else {
                $namasurat = explode('.', $data->nama_surat)[0] . MYB_SUFFIX_DS1 . '.pdf';
            }
        }

        return $namasurat;
    }

    /**
     * fungsi get data pamong berdasarkan tabel log
     * @param int $id ID permohonan
     */
    function getPamongFromLogPermohonanSurat($id)
    {
        // get pamong ID dari permohonan surat
        try {
            $sql = "SELECT * FROM
				(
				SELECT log_surat.* 
				, SUBSTRING_INDEX(keterangan, '_', 1) AS tmp
				FROM log_surat
				) A
				WHERE A.tmp=$id ORDER BY id DESC LIMIT 1";
            $data = $this->db->query($sql)->row();
        } catch (Exception $ex) {
            $data = null;
        }

        if ($data) {
            $sql = "select pamong_id, jabatan, nama, nik, pamong_nip 
                    from tweb_desa_pamong tdp 
                    left outer join tweb_penduduk tp 
                    on tdp.id_pend = tp.id 
                    where tdp.pamong_id = $data->id_pamong";
            $pamong = $this->db->query($sql)->row();
            return $pamong;
        } else {
            return null;
        }
    }
}
