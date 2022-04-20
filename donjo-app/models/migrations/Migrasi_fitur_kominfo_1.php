<?php

/**
 * File ini:
 *
 * Model untuk migrasi database
 *
 * donjo-app/models/migrations/Migrasi_2109_ke_2110.php
 *
 */

/**
 *
 * File ini bagian dari:
 *
 * OpenSID
 *
 * Sistem informasi desa sumber terbuka untuk memajukan desa
 *
 * Aplikasi dan source code ini dirilis berdasarkan lisensi GPL V3
 *
 * Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * Hak Cipta 2016 - 2020 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 *
 * Dengan ini diberikan izin, secara gratis, kepada siapa pun yang mendapatkan salinan
 * dari perangkat lunak ini dan file dokumentasi terkait ("Aplikasi Ini"), untuk diperlakukan
 * tanpa batasan, termasuk hak untuk menggunakan, menyalin, mengubah dan/atau mendistribusikan,
 * asal tunduk pada syarat berikut:

 * Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam
 * setiap salinan atau bagian penting Aplikasi Ini. Barang siapa yang menghapus atau menghilangkan
 * pemberitahuan ini melanggar ketentuan lisensi Aplikasi Ini.

 * PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, BAIK TERSURAT MAUPUN
 * TERSIRAT. PENULIS ATAU PEMEGANG HAK CIPTA SAMA SEKALI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU
 * KEWAJIBAN APAPUN ATAS PENGGUNAAN ATAU LAINNYA TERKAIT APLIKASI INI.
 *
 * @package   OpenSID
 * @author    Tim Pengembang OpenDesa
 * @copyright Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * @copyright Hak Cipta 2016 - 2021 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 * @license   http://www.gnu.org/licenses/gpl.html GPL V3
 * @link      https://github.com/OpenSID/OpenSID
 */
class Migrasi_fitur_kominfo_1 extends MY_model
{
	public function up()
	{
		$hasil = true;
    //*****Buat Tabel Lapak
    $fields = array(
      'id_lapak' => array(
        'type' => 'INT',
        'auto_increment' =>TRUE
      ),
      'nama_lapak'=> array(
        'type' => 'VARCHAR',
        'constraint' => '50'
      ),
      'deskripsi'=> array(
        'type'=> 'VARCHAR',
        'constraint'=>'200',
        'null'=>true
      ),
      'kontak_lapak'=>array(
        'type'=>'VARCHAR',
        'constraint'=>'14',
        'null'=>true
      ),
      'lokasi_lapak'=>array(
        'type'=>'VARCHAR',
        'constraint'=>'50',
        'null'=>true
      ),
      'foto_lapak'=>array(
        'type'=>'VARCHAR',
        'constraint'=>'100',
        'null'=>true
      ),
      'koordinat'=>array(
        'type'=>'VARCHAR',
        'constraint'=>'100',
        'null'=>true
      )
    );
    $hasil =& $this->dbforge->add_field($fields);
    $hasil =& $this->dbforge->add_key('id_lapak',TRUE);
    $hasil =& $this->dbforge->create_table('lapak',TRUE);

    //*****Tambah Data Menu Lapak di tabel setting modul
    $this->db->where('id','319');
    $lapak = $this->db->get('setting_modul')->row_array();
    if(!$lapak){
      $data=array(
        'id' => "319",
        "modul"=> "Lapak",
        "url" => "lapak",
        "aktif" => "1",
        "ikon" => "fa-shopping-cart",
        "urut" => "16",
        "ikon_kecil" => "fa-shopping-cart",
      );
      $hasil =& $this->db->insert('setting_modul',$data);  
    }
    //*****UBAH link Lapak di tabel menu (Untuk Menu Lapak diTampilan Awal)
    $data=array(
      'link' => 'home_lapak'
    );
    $this->db->where('id','119');
    $hasil =& $this->db->update('menu',$data);

		status_sukses($hasil);
		return $hasil;
	}
}
