	<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	class lapak_model extends MY_Model
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
		
		}

		public function get_data()
		{
			return $this->db->get('lapak')->result();
		}

		public function getById($id)
		{
			$this->db->where('id_lapak', $id);
		//	$query = $this->db->get('lapak');
			return $this->db->get('lapak')->row_array();
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
		
			unset($data['file_foto']);
			unset($data['old_foto']);
			
			$this->db->insert('lapak', $data);
			$idku = $this->db->insert_id();
			// echo($idku); die;

			// Upload foto dilakukan setelah ada id, karena nama foto berisi id lapak
			if ($foto = $this->upload_foto($idku))
				$this->db->where('id_lapak', $idku)->update('lapak', ['foto_lapak' => $foto]);
		}

		
		public function update($data)
		{
			$post = $this->input->post();
			$id = $post['id_lapak'];

			

			$data['foto_lapak'] = $this->upload_foto($id);
			$this->db->where('id_lapak', $id)->update('lapak', $data);
		}
		
		private function upload_foto($id)
		{

			$post = $this->input->post();
			$foto = $post['foto'];
			$old_foto = $post['old_foto'];
			$nama_file = 'foto' . '-' . $id;


			if ($_FILES['foto']['tmp_name']) {
				$nama_file = $nama_file . get_extension($_FILES['foto']['name']);
				UploadFotoLapak($nama_file, $old_foto);
			} elseif ($foto) {
				$nama_file = $nama_file . '.png';
				$foto = str_replace('data:image/png;base64,', '', $foto);
				$foto = base64_decode($foto, true);

				if ($old_foto != '') {
					// Hapus old_foto
					unlink(LOKASI_LAPAK_PICT . $old_foto);
					unlink(LOKASI_LAPAK_PICT . 'kecil_' . $old_foto);
				}

				file_put_contents(LOKASI_LAPAK_PICT . $nama_file, $foto);
				file_put_contents(LOKASI_LAPAK_PICT . 'kecil_' . $nama_file, $foto);
			} else {
				$nama_file = null;
			}

			return $nama_file;
		}

		public function delete_all()
		{
			

			$id_cb = $_POST['id_cb'];
			foreach ($id_cb as $id_lapak) {
				$this->delete($id_lapak, $semua = true);
			}
		}
		


		public function delete($id)
		{
		
			$lapak = $this->getById($id);
			
			$file_foto = LOKASI_LAPAK_PICT . $lapak['foto_lapak'];
			// echo($file_foto); die;
			if (is_file($file_foto)) {
				unlink($file_foto);
				//break;
			}
			

			// Hapus file foto kecil lapak yg di hapus di folder desa/upload/LAPAK_pict
			$file_foto_kecil = LOKASI_LAPAK_PICT . "kecil_" . $lapak['foto_lapak'];
			if (is_file($file_foto_kecil)) {
				unlink($file_foto_kecil);
				//break;
			}
		$this->db->where('id_lapak', $id)->delete('lapak');

			
		}
	}
