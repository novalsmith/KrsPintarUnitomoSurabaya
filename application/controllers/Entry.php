<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Entry extends CI_Controller {

	function __construct() {

		parent::__construct();

		$this->load->model('Mk_tawaran_model');
		$this->load->model('Nilai_model');
		$this->load->library('form_validation');
		$this->load->library('form_validation');
		if ($this->session->userdata('nim') == "") {

			redirect('loginmhs');
		}
	}

	public function index() {
		$data = array(

			'expert_ganjil'     => $this->Mk_tawaran_model->semester_ganjil(),
			'expert_genap'      => $this->Mk_tawaran_model->semester_genap(),
			'id_mahasiswa'      => $this->session->userdata('id_mahasiswa'),
			'nama_mahasiswa'    => $this->session->userdata('nama_mahasiswa'),
			'content'           => 'expertkrs/expert',
			'semester_sekarang' => $this->db->get('semester_sekarang')->row(),
			'judul'             => 'Lembar Entry KRS',
		);

		$this->load->view('template_expert', $data);
	}

	  public function read($id) {
		$row = $this->Entry_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id_entry'  => $row->id_entry,
				'id_nilai'  => $row->id_nilai,
				'nim'       => $row->nim,
				'id_mk'     => $row->id_mk,
				'id_syarat' => $row->id_syarat,
				'id_rekom'  => $row->id_rekom,
			);
			$this->load->view('entry/entry_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('entry'));
		}
	}

	public function create() {
		$data = array(
			'button'    => 'Create',
			'action'    => site_url('entry/create_action'),
			'id_entry'  => set_value('id_entry'),
			'id_nilai'  => set_value('id_nilai'),
			'nim'       => set_value('nim'),
			'id_mk'     => set_value('id_mk'),
			'id_syarat' => set_value('id_syarat'),
			'id_rekom'  => set_value('id_rekom'),
		);
		$this->load->view('entry/entry_form', $data);
	}

	public function create_action() {

		// cek nama matakuliah
		$this->db->join('mk_tawaran mt', 'mt.id_mk_tawaran = jm.id_mk_tawaran');
		$this->db->join('matakuliah mk', 'mk.id_mk = mt.id_mk');

	//	$this->db->join('entry_temporary et', 'et.id_mk_tawaran = jm.id_mk_tawaran');
		$this->db->where_in('jm.id_mk_tawaran', $_POST['mk']);
		$dataku = $this->db->get('jadwal_mk jm');

		$nama = array();

		echo '<ul>';
		foreach ($dataku->result() as $key) {
		$nama[] = $key->nama_matakuliah;

		}
//	$this->db->join('entry_temporary et', 'et.id_mk_tawaran = j.id_mk_tawaran');
$this->db->where_in('j.id_mk_tawaran', $_POST['mk']);
//$this->db->where_in('j.id_mk_tawaran', 'et.id_mk_tawaran');

$this->db->where_in('j.hari', 'SELASA');
$jm = $this->db->get('jadwal_mk j');
//-------------------------cek data hari,jam,ruagan,kelas-----------------------------

			if ($jm->num_rows()>0 ) {

	# code..
	$this->session->set_flashdata('message',
		'<div class="alert alert-info fade in">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Maff.. Anda Kres Jadwal !</strong> Matakuliah Bentrok Hari, Kelas, Ruangan.<br/>* '.implode("<br/>* ", $nama).'	</div>');

	redirect(site_url('entry'));


		} else {


		//$mks    = $_POST['mk'];
		//$result = array();
		//foreach ($mks AS $key => $val) {

		//	$result[] = array("id_mk_tawaran" => $_POST['mk'][$key]);
		///
		//}
		//$data = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
		//$cek = array();
		//$this->db->order_by('id_mk_tawaran', 'desc');
		//$data11 = implode(',', $_POST['mk']);

		//$this->db->join('mk_tawaran mt', 'mt.id_mk_tawaran = et.id_mk_tawaran');
		//$this->db->join('matakuliah mk', 'mk.id_mk = mt.id_mk');

		$this->db->where_in('id_mk_tawaran', $_POST['mk']);
		$dataku = $this->db->get('entry_temporary et');

		$data = array();
		foreach ($dataku->result() as $key) {
			$data[] = $key->id_mk_tawaran;

		}

		$insert  = $_POST["mk"];
		$tmp     = array();
		$success = '';

		for ($i = 0; $i <= count($data); $i++) {
			if (in_array($data[$i], $insert)) {
				$tmp[] = $data[$i];

			} else {

				$sukses = "wes masuk data ne";
			}
		}

		if (!empty($success)) {




			$this->session->set_flashdata('message',
				'<div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Opps..Maaf !</strong> Data Berikut ini sudah ada di lembar Entry.'.$success.'<br/>

    </div>');

		}

		}
		if (count($tmp) > 0) {

			$this->db->join('mk_tawaran mt', 'mt.id_mk_tawaran = et.id_mk_tawaran');
			$this->db->join('matakuliah mk', 'mk.id_mk = mt.id_mk');

					//$this->db->join('entry_temporary et', 'et.id_mk_tawaran = jm.id_mk_tawaran');
				$this->db->where_in('et.id_mk_tawaran', $_POST['mk']);
				$dataku = $this->db->get('entry_temporary et');

			$nama = array();
			echo '<ul>';
			foreach ($dataku->result() as $key) {

				$nama[] = $key->nama_matakuliah;

			}

			$this->session->set_flashdata('message',
				'<div class="alert alert-danger fade in">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Opps..Maaf !!!!</strong> Data Berikut ini sudah ada di table.<br/>* '.implode("<br/>* ", $nama).'	</div>');
			echo '</ul>';
			redirect(site_url('entry'));

		} else {// data sukses di insert

$kelas_A = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='A'")->row();
$kelas_B = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='B'")->row();
$kelas_K = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='K'")->row();
$kelas_L = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='L'")->row();
$kelas_X = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='X'")->row();
$kelas_Y = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='Y'")->row();

$total_A = $this->db->query('select count(id_kelas) as total_A from entry_temporary where id_kelas='.$kelas_A->id_kelas)->row();
$total_B = $this->db->query('select count(id_kelas) as total_B from entry_temporary where id_kelas='.$kelas_B->id_kelas)->row();
$total_K = $this->db->query('select count(id_kelas) as total_K from entry_temporary where id_kelas='.$kelas_K->id_kelas)->row();
$total_L = $this->db->query('select count(id_kelas) as total_L from entry_temporary where id_kelas='.$kelas_L->id_kelas)->row();
$total_X = $this->db->query('select count(id_kelas) as total_X from entry_temporary where id_kelas='.$kelas_X->id_kelas)->row();
$total_Y = $this->db->query('select count(id_kelas) as total_Y from entry_temporary where id_kelas='.$kelas_Y->id_kelas)->row();
//

// validasi kelas penuh

$data_kelas = $this->db->get('entry_temporary');
foreach ($data_kelas->result() as $key) {
	# code...
	if ($key->id_kelas='' || $key->id_kelas = $kelas_K->id_kelas and $total_K->total_K < $kelas_K->kapasitas ) {
		# code...

					// validasi data kelas
					$mks    = $this->input->post('mk');
					$result = array();
					foreach ($mks AS $key => $val) {
						$result[] = array(
							"id_mahasiswa"   => 7,
							"waktu_entry"    => date('Y'),
							"semester_aktif" => 2,
							"validasi"       => 'BELUM',
							"id_mk_tawaran"  => $_POST['mk'][$key],
							"id_kelas"       => $kelas_K->id_kelas,
						);
					}

					$test = $this->db->insert_batch('entry_temporary', $result);// fungsi dari codeigniter untuk menyimpan multi array
					if ($test) {
						$this->session->set_flashdata('message',
							'<div class="alert alert-success">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        <strong>Success Saved!</strong> Your Data is Successful.
		                 </div>');
						redirect(site_url('entry'));
					} else {
						echo "gagal di input";
					}
	} elseif ($key->id_kelas = $kelas_L->id_kelas and $total_L->total_L < $kelas_L->kapasitas ) {
		# code...

					// validasi data kelas
					$mks    = $this->input->post('mk');
					$result = array();
					foreach ($mks AS $key => $val) {
						$result[] = array(
							"id_mahasiswa"   => 7,
							"waktu_entry"    => date('Y'),
							"semester_aktif" => 2,
							"validasi"       => 'BELUM',
							"id_mk_tawaran"  => $_POST['mk'][$key],
							"id_kelas"       => $kelas_L->id_kelas,
						);
					}

					$test = $this->db->insert_batch('entry_temporary', $result);// fungsi dari codeigniter untuk menyimpan multi array
					if ($test) {
						$this->session->set_flashdata('message',
							'<div class="alert alert-success">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        <strong>Success Saved!</strong> Your Data is Successful.
		                 </div>');
						redirect(site_url('entry'));
					} else {
						echo "gagal di input";
					}
	}elseif ($key->id_kelas = $kelas_X->id_kelas and $total_X->total_X < $kelas_X->kapasitas ) {
		# code...

					// validasi data kelas
					$mks    = $this->input->post('mk');
					$result = array();
					foreach ($mks AS $key => $val) {
						$result[] = array(
							"id_mahasiswa"   => 7,
							"waktu_entry"    => date('Y'),
							"semester_aktif" => 2,
							"validasi"       => 'BELUM',
							"id_mk_tawaran"  => $_POST['mk'][$key],
							"id_kelas"       => $kelas_X->id_kelas,
						);
					}

					$test = $this->db->insert_batch('entry_temporary', $result);// fungsi dari codeigniter untuk menyimpan multi array
					if ($test) {
						$this->session->set_flashdata('message',
							'<div class="alert alert-success">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        <strong>Success Saved!</strong> Your Data is Successful.
		                 </div>');
						redirect(site_url('entry'));
					} else {
						echo "gagal di input";
					}
	}
		# code...
	elseif ($key->id_kelas = $kelas_Y->id_kelas and $total_Y->total_L < $kelas_Y->kapasitas ) {
		# code...

					// validasi data kelas
					$mks    = $this->input->post('mk');
					$result = array();
					foreach ($mks AS $key => $val) {
						$result[] = array(
							"id_mahasiswa"   => 7,
							"waktu_entry"    => date('Y'),
							"semester_aktif" => 2,
							"validasi"       => 'BELUM',
							"id_mk_tawaran"  => $_POST['mk'][$key],
							"id_kelas"       => $kelas_Y->id_kelas,
						);
					}

					$test = $this->db->insert_batch('entry_temporary', $result);// fungsi dari codeigniter untuk menyimpan multi array
					if ($test) {
						$this->session->set_flashdata('message',
							'<div class="alert alert-success">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        <strong>Success Saved!</strong> Your Data is Successful.
		                 </div>');
						redirect(site_url('entry'));
					} else {
						echo "gagal di input";
					}
	}

	else{
		# code...
		$this->session->set_flashdata('message',
			'<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>NO DATA IS INSERTED !</strong> Your Data is Successful.
						 </div>');
		redirect(site_url('entry'));
	}
}



// validasi kelas penuh

}

 }

	public function update($id) {
		$row = $this->Entry_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button'    => 'Update',
				'action'    => site_url('entry/update_action'),
				'id_entry'  => set_value('id_entry', $row->id_entry),
				'id_nilai'  => set_value('id_nilai', $row->id_nilai),
				'nim'       => set_value('nim', $row->nim),
				'id_mk'     => set_value('id_mk', $row->id_mk),
				'id_syarat' => set_value('id_syarat', $row->id_syarat),
				'id_rekom'  => set_value('id_rekom', $row->id_rekom),
			);
			$this->load->view('entry/entry_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('entry'));
		}
	}

	public function update_action() {
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id_entry', TRUE));
		} else {
			$data = array(
				'id_nilai'  => $this->input->post('id_nilai', TRUE),
				'nim'       => $this->input->post('nim', TRUE),
				'id_mk'     => $this->input->post('id_mk', TRUE),
				'id_syarat' => $this->input->post('id_syarat', TRUE),
				'id_rekom'  => $this->input->post('id_rekom', TRUE),
			);

			$this->Entry_model->update($this->input->post('id_entry', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('entry'));
		}
	}

	public function delete($id) {
		$row = $this->Entry_model->get_by_id($id);

		if ($row) {
			$this->Entry_model->delete($id);

			$this->session->set_flashdata('message',
				'<div class="alert alert-success fade in">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Terhapus !</strong> Your Data is Successful.

                 </div>');

			redirect(site_url('entry'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('entry'));
		}
	}

	public function _rules() {
		$this->form_validation->set_rules('id_nilai', 'id nilai', 'trim|required');
		$this->form_validation->set_rules('nim', 'nim', 'trim|required');
		$this->form_validation->set_rules('id_mk', 'id mk', 'trim|required');
		$this->form_validation->set_rules('id_syarat', 'id syarat', 'trim|required');
		$this->form_validation->set_rules('id_rekom', 'id rekom', 'trim|required');

		$this->form_validation->set_rules('id_entry', 'id_entry', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel() {
		$this->load->helper('exportexcel');
		$namaFile  = "entry.xls";
		$judul     = "entry";
		$tablehead = 0;
		$tablebody = 1;
		$nourut    = 1;
		//penulisan header
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=".$namaFile."");
		header("Content-Transfer-Encoding: binary ");

		xlsBOF();

		$kolomhead = 0;
		xlsWriteLabel($tablehead, $kolomhead++, "No");
		xlsWriteLabel($tablehead, $kolomhead++, "Id Nilai");
		xlsWriteLabel($tablehead, $kolomhead++, "Nim");
		xlsWriteLabel($tablehead, $kolomhead++, "Id Mk");
		xlsWriteLabel($tablehead, $kolomhead++, "Id Syarat");
		xlsWriteLabel($tablehead, $kolomhead++, "Id Rekom");

		foreach ($this->Entry_model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteNumber($tablebody, $kolombody++, $data->id_nilai);
			xlsWriteNumber($tablebody, $kolombody++, $data->nim);
			xlsWriteNumber($tablebody, $kolombody++, $data->id_mk);
			xlsWriteNumber($tablebody, $kolombody++, $data->id_syarat);
			xlsWriteNumber($tablebody, $kolombody++, $data->id_rekom);

			$tablebody++;
			$nourut++;
		}

		xlsEOF();
		exit();
	}

	public function word() {
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=entry.doc");

		$data = array(
			'entry_data' => $this->Entry_model->get_all(),
			'start'      => 0
		);

		$this->load->view('entry/entry_doc', $data);
	}

	public function simpan_entry() {

		$nm     = $this->input->post('nama_mk');
		$result = array();
		foreach ($nm AS $key => $val) {
			$result[] = array(
				"kodemk"          => 'ueue77',
				"nama_matakuliah" => $_POST['nama_mk'][$key],
				"sks"             => 3,
				"id_semester"     => 1,
			);
		}

		$test = $this->db->insert_batch('matakuliah', $result);// fungsi dari codeigniter untuk menyimpan multi array

		if ($test) {
			echo "nama sukses di input";
			redirect('expert');} else {
			echo "gagal di input";
		}

	}

}

/* End of file Entry.php */
/* Location: ./application/controllers/Entry.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:14 */
/* http://harviacode.com */
