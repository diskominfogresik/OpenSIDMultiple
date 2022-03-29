<?php class lapak_model extends CI_Model
{

	private $table = 'lapak';
	public $id_lapak;
	public $nama_lapak;
	public $deskripsi;
	public $foto_lapak = "default.jpg";
	public $kontak_lapak;
	public $lokasi_lapak;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('keluarga_model');
	}

	public function get_data()
	{
		return $this->db->get('lapak')->result();
	}

	public function getById($id)
	{
		$this->db->where('id_lapak', $id);
		$query = $this->db->get('lapak');
		return $query->row();
	}

	public function getDataLapakDetail($id)
	{
		$this->db->where('id_lapak', $id);
		$query = $this->db->get('lapak');
		return $query->row();
	}

	public function cari($keyword = null)
	{
		$this->db->select('*');
		$this->db->from('lapak');
		if (!empty($keyword)) {
			$this->db->like('nama_lapak', $keyword);
		}
		return $this->db->get()->result_array();
	}

	public function insert($data)
	{
		$post = $this->input->post();
		$id_lapak = $post['id_lapak'];

		// $foto = $post['foto'];
		unset($data['file_foto']);
		unset($data['old_foto']);
		// $idku = $this->getById($data);
		$this->db->insert('lapak', $data);
		$idku = $this->db->insert_id();

		// Upload foto dilakukan setelah ada id, karena nama foto berisi id pend
		if ($foto = $this->upload_foto($idku))
			$this->db->where('id_lapak', $id_lapak)->update('lapak', ['foto_lapak' => $foto]);
	}



	private function upload_foto($id)
	{

		$post = $this->input->post();
		$foto = $post['foto'];
		$old_foto = $post['old_foto'];
		$nama_file = 'foto' . '-' . $id;


		$nama_file = $nama_file . '.png';
		$foto = str_replace('data:image/png;base64,', '', $foto);
		$foto = base64_decode($foto, true);



		file_put_contents(LOKASI_LAPAK_PICT . $nama_file, $foto);
		// file_put_contents(LOKASI_LAPAK_PICT . 'kecil_' . $nama_file, $foto);



		return $nama_file;
	}

	public function delete_all()
	{
		$this->session->success = 1;

		$id_cb = $_POST['id_cb'];
		foreach ($id_cb as $id_lapak) {
			$this->delete($id_lapak, $semua = true);
		}
	}

	public function update()
	{
		$post = $this->input->post();
		$this->nama_lapak = $post["nama_lapak"];
		$this->kontak_lapak = $post["kontak_lapak"];
		$this->lokasi_lapak = $post["lokasi_lapak"];
		$this->deskripsi = $post["deskripsi"];
		$this->foto_lapak = $post["foto_lapak"];
		return $this->db->update($this->lapak, $this, array('id_lapak' => $post['id_lapak']));
	}


	public function delete($id = '')
	{
		// if (!$semua) $this->session->success = 1;

		// Catat data penduduk yg di hapus di log_hapus_penduduk
		// $penduduk_hapus = $this->getById($id);
		// $log = [
		// 	'id_pend' => $penduduk_hapus['id'],
		// 	'nik' => $penduduk_hapus['nik'],
		// 	'foto' => $penduduk_hapus['foto'],
		// 	'deleted_by' => $this->session->user,
		// 	'deleted_at' => date('Y-m-d H:i:s')
		// ];


		$this->db->where('id_lapak', $id)->delete('lapak');

		// status_sukses($outp, $gagal_saja = true); //Tampilkan Pesan
	}


	// protected function search_sql() {
	// 	if ($this->session->cari) {
	// 		$cari=$this->session->cari;
	// 		$cari=$this->db->escape_like_str($cari);
	// 		$this->db ->group_start() ->like('u.nama', $cari) ->or_like('u.nik', $cari) ->or_like('u.tag_id_card', $cari) ->group_end();
	// 	}
	// }
}
