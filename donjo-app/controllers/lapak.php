<?php class Lapak extends Admin_Controller
{
    private $_set_page;
    private $_list_session;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('lapak_model');
        $this->modul_ini = 16;
        $this->sub_modul_ini = 21;
        $this->_set_page = ['50', '100', '200'];
        // $this->_list_session = ['filter_tahun', 'filter_bulan', 'status_hanya_tetap', 'jenis_peristiwa', 'filter', 'status_dasar', 'sex', 'agama', 'dusun', 'rw', 'rt', 'cari', 'umur_min', 'umur_max', 'umurx', 'pekerjaan_id', 'status', 'pendidikan_sedang_id', 'pendidikan_kk_id', 'status_penduduk', 'judul_statistik', 'cacat', 'cara_kb_id', 'akta_kelahiran', 'status_ktp', 'id_asuransi', 'status_covid', 'penerima_bantuan', 'log', 'warganegara', 'menahun', 'hubungan', 'golongan_darah', 'hamil', 'kumpulan_nik'];
    }

    private function clear_session()
    {
        $this->session->unset_userdata($this->_list_session);
        $this->session->status_dasar = 1; // default status dasar = hidup
        $this->session->per_page = $this->_set_page[0];
    }

    public function clear()
    {
        $this->clear_session();
        redirect('lapak');
    }

    public function index($p = 1, $o = 0)
    {
        $data['p'] = $p;
        $data['o'] = $o;




        $data['func'] = 'index';
        // $data['set_page'] = $this->_set_page;
        $data['lapak'] = $this->lapak_model->get_data();
        // $data['main'] = $this->penduduk_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
        $this->set_minsidebar(1);
        $this->render('lapak', $data);
    }

    public function cari()
    {
        $this->load->model('lapak');
        $keyword = $this->input->get('keyword');
        $data = $this->lapak_model->cari($keyword);
        $data = array(
            'keyword'    => $keyword,
            'data'        => $data
        );
        $this->render('lapak', $data);
    }
    public function get_minsidebar()
    {
        return $this->minsidebar;
    }


    public function set_minsidebar($minsidebar)
    {
        $this->minsidebar = $minsidebar;
        $this->header['minsidebar'] = $this->get_minsidebar();

        return $this;
    }



    public function form($p = 1, $o = 0, $id = '')
    {




        $data['p'] = $p;
        $data['o'] = $o;
        $data['lapak'] = $this->lapak_model->getById($id);


        // var_dump($data);


        // $this->session->set_flashdata('success', 'Berhasil disimpan');
        $this->session->unset_userdata(['dari_internal']);



        $this->set_minsidebar(1);
        // $this->render('lapak_form', $data);
        $this->header['minsidebar'] = $this->get_minsidebar();
        $this->load->view('header', $this->header);
        $this->load->view('nav');
        $this->load->view('lapak_form', $data);
        $this->load->view('footer');
    }


    public function edit($p = 1, $o = 0, $id = '')
    {


        $data['p'] = $p;
        $data['o'] = $o;
        $query = $this->lapak_model->getById($id);
        // $data['lapak'] = $query;
        // echo json_encode($data);




        $this->set_minsidebar(1);
        $this->render('lapak_form_edit', $data);
    }

    public function insert()
    {
        $id_lapak = $this->input->post("id_lapak", TRUE);
        $deskripsi = $this->input->post("deskripsi", TRUE);
        $nama = $this->input->post("nama_lapak", TRUE);
        $kontak = $this->input->post("kontak_lapak", TRUE);
        $foto = $this->input->post("foto");
        $lokasi = $this->input->post("lokasi_lapak", TRUE);
        $koordinat = $this->input->post("koordinat", TRUE);




        // $upload = $this->lapak_model->upload_foto($foto);


        $ArrInsert =
            [
                'id_lapak' => $id_lapak,
                'nama_lapak' => $nama,
                'kontak_lapak' => $kontak,
                'lokasi_lapak' => $lokasi,
                'foto_lapak' => $foto,
                'deskripsi' => $deskripsi,
                'koordinat' => $koordinat
            ];



        $this->lapak_model->insert($ArrInsert);
        redirect(base_url('lapak'));
    }




    public function update($id)
    {
        $lapak = $this->lapak_model;
        $id_lapak = $this->input->post("id_lapak");
        $deskripsi = $this->input->post("deskripsi");
        $nama = $this->input->post("nama_lapak");
        $kontak = $this->input->post("kontak_lapak");
        $lokasi = $this->input->post("lokasi_lapak");
        $foto = $this->input->post("foto_lapak");
        // $upload = $this->lapak_model->upload_foto($foto);

        $ArrInsert =
            [
                'id_lapak' => $id_lapak,
                'nama_lapak' => $nama,
                'kontak_lapak' => $kontak,
                'lokasi_lapak' => $lokasi,
                // 'foto_lapak' => $foto,
                'deskripsi' => $deskripsi
            ];
        print_r($ArrInsert);
        $this->lapak_model->insert($ArrInsert);
        redirect(base_url('lapak'));
    }
    public function delete($p = 1, $o = 0, $id = '')
    {
        // $this->redirect_hak_akses('h', "lapak/index/$p/$o");
        $this->lapak_model->delete($id);
        redirect(site_url('lapak'));
    }

    public function deleteall()
    {


        $this->lapak_model->delete_all(); // Panggil fungsi delete dari model

        redirect('lapak/index');
    }
}
