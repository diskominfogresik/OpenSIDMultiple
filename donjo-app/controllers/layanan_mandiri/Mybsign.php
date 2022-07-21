<?php
// MYB
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mybsign extends CI_Controller
{
    private $errorMessage = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('keluar_model');
        $this->load->model('mybsign_model');
    }

    private function setErrorMessage($msg)
    {
        $this->errorMessage = $msg;
    }
    private function getErrorMessage()
    {
        return $this->errorMessage;
    }
    // MYB
    /**
     * fungsi ambil nama file
     * berdasarkan id permohonan surat dibandingkan dengan explode log keterangan
     */
    public function getNamaSuratFromLogById()
    {
        $res = array(
            'success' => false,
            'data' => null,
            'message' => ''
        );

        // form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'id', 'trim|numeric|required');
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors();
            return;
        }

        $id = $this->input->post('id', true);
        $isForSignedFile = $this->input->post('sign', true) ? $this->input->post('sign', true) : false;
        $isForSignedFile = $isForSignedFile === 'true' ? true : false;

        try {
            $tmp = $this->mybsign_model->getNamaSuratFromLogById($id, $isForSignedFile);

            if ($tmp) {
                $res['success'] = true;
                // $res['data'] = base_url(LOKASI_ARSIP) . $this->keluar_model->getNamaSuratFromLogById($id);
                $res['data'] = base_url(LOKASI_ARSIP) . $tmp;
            } else {
                $res['success'] = false;
                $res['message'] = $this->getErrorMessage();
            }
        } catch (Exception $ex) {
            $res['message'] = 'ERROR';
        }

        echo json_encode($res);
    }

    public function pseudoEsign()
    {
        $res = array(
            'success' => false,
            'data' => null,
            'message' => ''
        );
        // form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'id', 'trim|numeric|required');
        $this->form_validation->set_rules('passphrase', 'passphrase', 'required');
        if ($this->form_validation->run() === FALSE) {
            // echo validation_errors();
            $res['message'] = validation_errors();
            echo json_encode($res);
            return;
        }

        $id = $this->input->post('id', true);
        $passphrase = $this->input->post('passphrase', true);
        try {
            // ambil pdf
            $tmp = $this->mybsign_model->getNamaSuratFromLogById($id);
            $namaSurat = explode('.', $tmp)[0] . MYB_SUFFIX_FS . '.pdf';
            // $namaSurat = base_url(LOKASI_ARSIP) . $namaSurat; // obsolete
            $namaSurat = LOKASI_ARSIP . $namaSurat;
            $namaSuratSigned = explode('.', $tmp)[0] . MYB_SUFFIX_DS1 . '.pdf';

            if ($namaSurat) {
                $hasil = $this->prosesEsign($namaSurat, $namaSuratSigned, $id, $passphrase);
                if ($hasil === true) {
                    $res['success'] = true;
                    // update status dok
                    $status = 3;
                    $this->load->model('permohonan_surat_model');
                    // $this->permohonan_surat_model->update_status($id, array('status' => $status));
                    // update versi 2207
                    $this->permohonan_surat_model->proses($id, 3);
                }

                echo json_encode($res);
            } else {
                echo json_encode($res);
                return;
            }
        } catch (Exception $ex) {
            echo 'ERROR';
            return;
        }
    }

    // public function pseudoEsign()
    private function prosesEsign($namaSurat, $namaSuratSigned, $idPermohonan, $passphrase = '')
    {
        /*
        // jika pake file image ttd
        $lokasittd = LOKASI_ARSIP . 'contoh_ttd.jpeg';
        $infoFileTTD = pathinfo($lokasittd);
        $extFileTTD  = $infoFileTTD['extension'];
        if ($extFileTTD == 'png') {
            $mime = 'image/png';
        } else if ($extFileTTD == 'jpg') {
            $mime = 'image/jpg';
        } else if ($extFileTTD == 'jpeg') {
            $mime = 'image/jpeg';
        }
        */
        try {
            $pamong = $this->mybsign_model->getPamongFromLogPermohonanSurat($idPermohonan);
            if (!$pamong) {
                return false;
            }
            $nik = $pamong->nik;

            $tgl = date('d-m-Y H:i');
            // $isiQR = "Pemerintah Desa {$this->setting->sebutan_desa} Kabupaten Gresik. <br />Ditandatangani secara elektronik pada {$tgl}.";
            $isiQR = "Ditandatangani secara elektronik pada {$tgl} oleh :
{$pamong->jabatan}
{$pamong->nama}
NIP. {$pamong->pamong_nip}
";

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => ESIGN_SERV, // update server var to ignored 
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',

                CURLOPT_POSTFIELDS => array(
                    'file' => new \CURLFile($namaSurat, 'application/pdf'),
                    // 'imageTTD' => new \CURLFile($lokasittd, $mime),
                    'nik' => $nik,
                    'passphrase' => $passphrase,
                    'tampilan' => 'visible',
                    // // //'page' => '1',
                    // 'image' => 'true',
                    'image' => 'false',
                    'linkQR' => $isiQR,
                    // // //'xAxis' => '0',
                    // // //'yAxis' => '0',
                    'width' => '100',
                    'height' => '100',
                    'tag_koordinat' => '$' //awalnya '#'
                ),

                CURLOPT_HTTPHEADER => array(
                    ESIGN_AUTH // update header var to ignored 
                ),

                CURLOPT_RETURNTRANSFER => 1
            ));

            $response = curl_exec($curl);
            $content_type = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);

            if ($response == false) {
                // echo 'Curl error: ' . curl_error($curl);
                $this->setErrorMessage(curl_error($curl));
                curl_close($curl);
                return false;
            }

            if (!$content_type) {
                $downloadPath = LOKASI_ARSIP . $namaSuratSigned;

                // $file = fopen($downloadPath, "w+");
                $file = fopen($downloadPath, "wa+");
                fputs($file, $response);
                fclose($file);
            } elseif ($content_type === 'application/json;charset=UTF-8') {
                // do nothing
                curl_close($curl);
                return false;
            }

            /* cek ada pesan error nggak */
            $decodes = json_decode($response);
            if (isset($decodes->error)) {
                // error
                $this->setErrorMessage($decodes->error);
                curl_close($curl);
                return false;
            }

            curl_close($curl);
            return true;

            // if ($response) {
            //     return true;
            // } else {
            //     return false;
            // }
        } catch (Exception $ex) {
            return false;
        }
    }
}
