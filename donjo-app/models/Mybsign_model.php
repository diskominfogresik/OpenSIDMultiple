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
            $sql = "SELECT pamong_id, jabatan, pamong_nama AS nama, pamong_nik AS nik, pamong_nip FROM tweb_desa_pamong WHERE pamong_id= $data->id_pamong";
            $pamong = $this->db->query($sql)->row();
            if (!$pamong) {
                $sql = "select pamong_id, jabatan, nama, nik, pamong_nip 
                from tweb_desa_pamong tdp 
                left outer join tweb_penduduk tp 
                on tdp.id_pend = tp.id 
                where tdp.pamong_id = $data->id_pamong";
                $pamong = $this->db->query($sql)->row();
            }

            return $pamong;
        } else {
            return null;
        }
    }

    /**
     * fungsi get data pamong berdasarkan pamong_id
     * @param int $id ID pamong
     */
    function getPamongFromPamongId($id)
    {
        // get pamong ID dari permohonan surat
        try {
            $sql = "SELECT * FROM tweb_desa_pamong WHERE pamong_id= $id";
            $data = $this->db->query($sql)->row();
            return $data;
        } catch (Exception $ex) {
            return null;
        }
    }

    /**
     * fungsi get data user berdasarkan id
     * @param int $id ID pamong
     */
    function getUserFromId($id)
    {
        // get pamong ID dari permohonan surat
        try {
            $sql = "SELECT * FROM user WHERE id=$id";
            $data = $this->db->query($sql)->row();
            return $data;
        } catch (Exception $ex) {
            return null;
        }
    }

    /**
     * fungsi get data permohonan_surat by ID
     * @param int $id ID permohonan_surat
     */
    function getPermohonanSuratFromId($id)
    {
        try {
            $sql = "SELECT * FROM permohonan_surat WHERE id=$id";
            $data = $this->db->query($sql)->row();
            return $data;
        } catch (Exception $ex) {
            return null;
        }
    }
}
