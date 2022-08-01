<?php

/*
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
 * Hak Cipta 2016 - 2022 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 *
 * Dengan ini diberikan izin, secara gratis, kepada siapa pun yang mendapatkan salinan
 * dari perangkat lunak ini dan file dokumentasi terkait ("Aplikasi Ini"), untuk diperlakukan
 * tanpa batasan, termasuk hak untuk menggunakan, menyalin, mengubah dan/atau mendistribusikan,
 * asal tunduk pada syarat berikut:
 *
 * Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam
 * setiap salinan atau bagian penting Aplikasi Ini. Barang siapa yang menghapus atau menghilangkan
 * pemberitahuan ini melanggar ketentuan lisensi Aplikasi Ini.
 *
 * PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, BAIK TERSURAT MAUPUN
 * TERSIRAT. PENULIS ATAU PEMEGANG HAK CIPTA SAMA SEKALI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU
 * KEWAJIBAN APAPUN ATAS PENGGUNAAN ATAU LAINNYA TERKAIT APLIKASI INI.
 *
 * @package   OpenSID
 * @author    Tim Pengembang OpenDesa
 * @copyright Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * @copyright Hak Cipta 2016 - 2022 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 * @license   http://www.gnu.org/licenses/gpl.html GPL V3
 * @link      https://github.com/OpenSID/OpenSID
 *
 */

defined('BASEPATH') || exit('No direct script access allowed');

class Migrasi_fitur_kominfo_1 extends MY_model
{
    public function up()
    {
        $hasil = true;

        //**Set Value libreoffice path jadi / */
        $this->db->where('key','libreoffice_path');
        $hasil =& $this->db->update('setting_aplikasi', array('value' => '/'));

        //**create column nik di tabel user*/
        if(! $this->db->field_exists('nik','user')){
            $fields= array(
                'nik' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '16'
                )
            );
            $hasil =& $this->dbforge->add_column('user',$fields);
        }

        //**Insert data current_version_kominfo di table setting_aplikasi 
        $data = array(
            'key'=>'current_version_kominfo',
            'value'=>'1',
            'keterangan'=>' Versi Database Pengembangan Kominfo'
        );
        $hasil =& $this->db->insert('setting_aplikasi',$data);

        //**Insert data Role SIgner di tabel user_grup */
        $data = array(
            'nama'=>'Signer',
            'jenis'=>'2',
            'updated_by'=>'1',
            'created_by'=>'1'
           
        );
        $hasil =& $this->db->insert('user_grup',$data);
        $id_grup = $this->db->insert_id();
        
        //**Inser data-data yang perlu di tabel grup_akses */
        $data=array(
            array(
            'id_grup'=>$id_grup,
            'id_modul'=>'1',
            'akses'=>'7'
            ),array(
                'id_grup'=>$id_grup,
                'id_modul'=>'4',
                'akses'=>'0'
            ),array(
                'id_grup'=>$id_grup,
                'id_modul'=>'31',
                'akses'=>'7'
            ),array(
                'id_grup'=>$id_grup,
                'id_modul'=>'32',
                'akses'=>'7'
            ),array(
                'id_grup'=>$id_grup,
                'id_modul'=>'33',
                'akses'=>'7'
            ),array(
                'id_grup'=>$id_grup,
                'id_modul'=>'14',
                'akses'=>'0'
            ),array(
                'id_grup'=>$id_grup,
                'id_modul'=>'98',
                'akses'=>'7'
            ),array(
                'id_grup'=>$id_grup,
                'id_modul'=>'55',
                'akses'=>'7'
            ),array(
                'id_grup'=>$id_grup,
                'id_modul'=>'312',
                'akses'=>'7'
            ),array(
                'id_grup'=>$id_grup,
                'id_modul'=>'321',
                'akses'=>'7'
            )
        );
        foreach($data as $dat){
            $hasil =& $this->db->insert('grup_akses',$dat);
        }
        status_sukses($hasil);
        return $hasil;
    }
}