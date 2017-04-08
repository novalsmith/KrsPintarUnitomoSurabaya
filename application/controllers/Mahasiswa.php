<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model');

        $this->load->model('Mk_tawaran_model');

        $this->load->library('form_validation');
        if ($this->session->userdata('username')=="") {
            redirect('login','refresh');
        }
    }

    public function index()
    {

$data['email'] = $this->session->userdata('email');
        $data['content'] = 'mahasiswa/mahasiswa_list.php';
         $data['judul']    = 'Mahasiswa';
         $data['nama']    = 'Data Mahasiswa';
         $data['mahasiswa_data'] = $this->Mahasiswa_model->get_all();

         $this->load->view('template',$data);


    }

public function replace()
{
  # code...
  $replace      = $this->Mk_tawaran_model->join_expert_replace();
  $idmhs = $this->uri->segment(3);
  $mhs_get = $this->db->query('select * from mahasiswa where id_mahasiswa='.$idmhs)->row();
  # ini pembuatan variabel untuk get data

    # code...
    $replace      = $this->Mk_tawaran_model->join_expert_replace();
    $idmhs = $this->uri->segment(3);
    $mhs_get = $this->db->query('select * from mahasiswa where id_mahasiswa='.$idmhs)->row();
    # ini pembuatan variabel untuk get data
    #Membuat Value untuk insert Nama Kelas secara otomatis
    $kelas_A = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='A'")->row();
    $kelas_B = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='B'")->row();
    $kelas_C = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='C'")->row();
    $kelas_D = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='D'")->row();
    $kelas_K = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='K'")->row();
    $kelas_L = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='L'")->row();
    $kelas_X = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='X'")->row();
    $kelas_Y = $this->db->query("SELECT * FROM kelas WHERE nama_kelas='Y'")->row();
    #Membuat hitung total kelas secara keseluruhan : contoh : Maks A = 10 !> 10 untuk data yg di isi
    $total_A = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_A from entry where id_kelas='.$kelas_A->id_kelas)->row();
    $total_B = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_B from entry where id_kelas='.$kelas_B->id_kelas)->row();
    $total_C = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_C from entry where id_kelas='.$kelas_C->id_kelas)->row();
    $total_D = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_D from entry where id_kelas='.$kelas_D->id_kelas)->row();
    $total_K = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_K from entry where id_kelas='.$kelas_K->id_kelas)->row();
    $total_L = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_L from entry where id_kelas='.$kelas_L->id_kelas)->row();
    $total_X = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_X from entry where id_kelas='.$kelas_X->id_kelas)->row();
    $total_Y = $this->db->query('select COUNT( DISTINCT(id_mahasiswa ) ) as total_Y from entry where id_kelas='.$kelas_Y->id_kelas)->row();

        $dat1 = date('Y');
        $dat2 = date('Y')-1;


    $data_kelas = $this->db->get('entry');


if ($mhs_get->jenis_kelas =='Pagi') {
  # code...

if ($total_A->total_A < $kelas_A->kapasitas ) {
  # code...
  foreach ($replace as $key) {
  $result_replace = array(
    "id_mk_tawaran"  => $key->id_mk_tawaran,
  "id_mahasiswa"   =>  $this->uri->segment(3),
  "waktu_entry"    => date('Y'),
  "semester_aktif" => 1,
  "validasi"       => 'BELUM',
  "id_kelas"       => $kelas_A->id_kelas,
  "semester_tahun_akademik" => 'Ganjil',
  "tahun_akademik" => $dat2.'/'.$dat1,
  );
  $this->db->insert('entry', $result_replace);

  }
  redirect(site_url('mahasiswa'));
  // batas pagi
}elseif ($total_B->total_B < $kelas_B->kapasitas ) {
  # code...
  foreach ($replace as $key) {
  $result_replace = array(
    "id_mk_tawaran"  => $key->id_mk_tawaran,
  "id_mahasiswa"   =>  $this->uri->segment(3),
  "waktu_entry"    => date('Y'),
  "semester_aktif" => 1,
  "validasi"       => 'BELUM',
  "id_kelas"       => $kelas_B->id_kelas,
  "semester_tahun_akademik" => 'Ganjil',
  "tahun_akademik" => $dat2.'/'.$dat1,
  );
  $this->db->insert('entry', $result_replace);

  }
  redirect(site_url('mahasiswa'));
  // batas pagi
}
elseif ($total_C->total_C < $kelas_C->kapasitas ) {
  # code...
  foreach ($replace as $key) {
  $result_replace = array(
    "id_mk_tawaran"  => $key->id_mk_tawaran,
  "id_mahasiswa"   =>  $this->uri->segment(3),
  "waktu_entry"    => date('Y'),
  "semester_aktif" => 1,
  "validasi"       => 'BELUM',
  "id_kelas"       => $kelas_C->id_kelas,
  "semester_tahun_akademik" => 'Ganjil',
  "tahun_akademik" => $dat2.'/'.$dat1,
  );
  $this->db->insert('entry', $result_replace);

  }
  redirect(site_url('mahasiswa'));
  // batas pagi
}
elseif ($total_D->total_D < $kelas_D->kapasitas ) {
  # code...
  foreach ($replace as $key) {
  $result_replace = array(
    "id_mk_tawaran"  => $key->id_mk_tawaran,
  "id_mahasiswa"   =>  $this->uri->segment(3),
  "waktu_entry"    => date('Y'),
  "semester_aktif" => 1,
  "validasi"       => 'BELUM',
  "id_kelas"       => $kelas_D->id_kelas,
  "semester_tahun_akademik" => 'Ganjil',
  "tahun_akademik" => $dat2.'/'.$dat1,
  );
  $this->db->insert('entry', $result_replace);

  }
  redirect(site_url('mahasiswa'));
  // batas pagi
}else {
  $this->session->set_flashdata('message',
    '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>NO DATA IS INSERTED !</strong> Your Data is not Successful.
           </div>');
  redirect(site_url('mahasiswa'));
}


}

else {



  if ($total_K->total_K < $kelas_K->kapasitas ) {
  # code...
  foreach ($replace as $key) {
  $result_replace = array(
    "id_mk_tawaran"  => $key->id_mk_tawaran,
  "id_mahasiswa"   =>  $this->uri->segment(3),
  "waktu_entry"    => date('Y'),
  "semester_aktif" => 1,
  "validasi"       => 'BELUM',
  "id_kelas"       => $kelas_K->id_kelas,
  "semester_tahun_akademik" => 'Ganjil',
  "tahun_akademik" => $dat2.'/'.$dat1,
  );
  $this->db->insert('entry', $result_replace);

  }
  redirect(site_url('mahasiswa'));
  // batas pagi
}elseif ($total_L->total_L < $kelas_L->kapasitas ) {
  # code...
  foreach ($replace as $key) {
  $result_replace = array(
    "id_mk_tawaran"  => $key->id_mk_tawaran,
  "id_mahasiswa"   =>  $this->uri->segment(3),
  "waktu_entry"    => date('Y'),
  "semester_aktif" => 1,
  "validasi"       => 'BELUM',
  "id_kelas"       => $kelas_L->id_kelas,
  "semester_tahun_akademik" => 'Ganjil',
  "tahun_akademik" => $dat2.'/'.$dat1,
  );
  $this->db->insert('entry', $result_replace);

  }
  redirect(site_url('mahasiswa'));
  // batas pagi
  }
  elseif ($total_X->total_X < $kelas_X->kapasitas ) {
  # code...
  foreach ($replace as $key) {
  $result_replace = array(
    "id_mk_tawaran"  => $key->id_mk_tawaran,
  "id_mahasiswa"   =>  $this->uri->segment(3),
  "waktu_entry"    => date('Y'),
  "semester_aktif" => 1,
  "validasi"       => 'BELUM',
  "id_kelas"       => $kelas_X->id_kelas,
  "semester_tahun_akademik" => 'Ganjil',
  "tahun_akademik" => $dat2.'/'.$dat1,
  );
  $this->db->insert('entry', $result_replace);

  }
  redirect(site_url('mahasiswa'));
  // batas pagi
  }
  elseif ($total_Y->total_Y < $kelas_Y->kapasitas ) {
  # code...
  foreach ($replace as $key) {
  $result_replace = array(
    "id_mk_tawaran"  => $key->id_mk_tawaran,
  "id_mahasiswa"   =>  $this->uri->segment(3),
  "waktu_entry"    => date('Y'),
  "semester_aktif" => 1,
  "validasi"       => 'BELUM',
  "id_kelas"       => $kelas_Y->id_kelas,
  "semester_tahun_akademik" => 'Ganjil',
  "tahun_akademik" => $dat2.'/'.$dat1,
  );
  $this->db->insert('entry', $result_replace);

  }
  redirect(site_url('mahasiswa'));
  // batas pagi
  }else {
  $this->session->set_flashdata('message',
    '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Maaf !</strong> Kapasitas Kelas Tidak Mencukupi Silahkan Tambah Jumlah Kapasitas Kelas.
           </div>');
  redirect(site_url('mahasiswa'));
  }


} // else tutup kelas Sore












} // endreplace

    public function read($id)
    {
        $row = $this->Mahasiswa_model->get_by_id($id);
        if ($row) {






            $data = array(
                'email' => $this->session->userdata('email'),
        'content'   => 'mahasiswa/mahasiswa_read',
        'nama'          => 'Mahasiswa List',
        'judul'         => 'Read Mahasiswa',
		'id_mahasiswa' => $row->id_mahasiswa,
		'nim' => $row->nim,
		'nama_mahasiswa' => $row->nama_mahasiswa,
		'pin' => $row->pin,
	    );

             $this->load->view('template',$data);

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mahasiswa'));
        }
    }

    public function create()
    {



        $data = array(

                'email' => $this->session->userdata('email'),
                  'content'   => 'mahasiswa/mahasiswa_form',
            'nama'          => 'Mahasiswa List',
        'judul'         => 'Mahasiswa Create',
            'button' => 'Create',
            'action' => site_url('mahasiswa/create_action'),
	    'id_mahasiswa' => set_value('id_mahasiswa'),
	    'nim' => set_value('nim'),
	    'nama_mahasiswa' => set_value('nama_mahasiswa'),
	    'pin' => set_value('pin'),
      'jenis_kelas' => set_value('jenis_kelas'),

	);

             $this->load->view('template',$data);

    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nim' => $this->input->post('nim',TRUE),
		'nama_mahasiswa' => $this->input->post('nama_mahasiswa',TRUE),
		'pin' => $this->input->post('pin',TRUE),
    'jenis_kelas' => $this->input->post('jenis_kelas',TRUE),

	    );

            $this->Mahasiswa_model->insert($data);

 $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Saved!</strong> Your Data is Successful.

                 </div>');

            redirect(site_url('mahasiswa'));
        }
    }

    public function update($id)
    {
        $row = $this->Mahasiswa_model->get_by_id($id);

        if ($row) {





            $data = array(

                'email' => $this->session->userdata('email'),
                        'content'   => 'mahasiswa/mahasiswa_form',
            'nama'          => 'Mahasiswa Update',
        'judul'         => 'Update Mahasiswa',
                'button' => 'Update',
                'action' => site_url('mahasiswa/update_action'),
		'id_mahasiswa' => set_value('id_mahasiswa', $row->id_mahasiswa),
		'nim' => set_value('nim', $row->nim),
		'nama_mahasiswa' => set_value('nama_mahasiswa', $row->nama_mahasiswa),
		'pin' => set_value('pin', $row->pin),
    'jenis_kelas' => set_value('pin', $row->jenis_kelas),

	    );



             $this->load->view('template',$data);


        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mahasiswa'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_mahasiswa', TRUE));
        } else {
            $data = array(
		'nim' => $this->input->post('nim',TRUE),
		'nama_mahasiswa' => $this->input->post('nama_mahasiswa',TRUE),
		'pin' => $this->input->post('pin',TRUE),
    'jenis_kelas' => $this->input->post('jenis_kelas',TRUE),

	    );

            $this->Mahasiswa_model->update($this->input->post('id_mahasiswa', TRUE), $data);


 $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Updated!</strong> Your Data is Successful.

                 </div>');


            redirect(site_url('mahasiswa'));
        }
    }

    public function delete($id)
    {
        $row = $this->Mahasiswa_model->get_by_id($id);

        if ($row) {
            $this->Mahasiswa_model->delete($id);



             $this->session->set_flashdata('message',
                '<div class="alert alert-success">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success Deleted!</strong> Your Data is Successful.

                 </div>');



            redirect(site_url('mahasiswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mahasiswa'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nim', 'nim', 'trim|required');
	$this->form_validation->set_rules('nama_mahasiswa', 'nama mahasiswa', 'trim|required');
	$this->form_validation->set_rules('pin', 'pin', 'trim|required');

	$this->form_validation->set_rules('id_mahasiswa', 'id_mahasiswa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mahasiswa.xls";
        $judul = "mahasiswa";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nim");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Mahasiswa");
	xlsWriteLabel($tablehead, $kolomhead++, "Pin");

	foreach ($this->Mahasiswa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nim);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_mahasiswa);
	    xlsWriteNumber($tablebody, $kolombody++, $data->pin);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mahasiswa.doc");

        $data = array(
            'mahasiswa_data' => $this->Mahasiswa_model->get_all(),
            'start' => 0
        );

        $this->load->view('mahasiswa/mahasiswa_doc',$data);
    }

}

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:15 */
/* http://harviacode.com */
