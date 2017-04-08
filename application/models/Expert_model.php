<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entry_model extends CI_Model
{

    public $table = 'entry';
    public $id = 'id_entry';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_entry', $q);
	$this->db->or_like('id_nilai', $q);
	$this->db->or_like('nim', $q);
	$this->db->or_like('id_mk', $q);
	$this->db->or_like('id_syarat', $q);
	$this->db->or_like('id_rekom', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_entry', $q);
	$this->db->or_like('id_nilai', $q);
	$this->db->or_like('nim', $q);
	$this->db->or_like('id_mk', $q);
	$this->db->or_like('id_syarat', $q);
	$this->db->or_like('id_rekom', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }


//update validasi matakuliah
      function update_validasi_mk($id_entry, $data)
    {
        $this->db->where('id_entry', $id_entry);
        $this->db->update('entry', $data);
    }



    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }



    public function ganjil()
    {
        $data = $this->db->query('SELECT * FROM `semester` WHERE nama_semester%2');
        return $data;
    }

     public function genap()
    {
        $data = $this->db->query('SELECT * FROM `semester` WHERE nama_semester%2=0');
        return $data;
    }

    public function paket_mk()
    {

        $this->db->join('semester', 'semester.id_semester = paket_mk.id_semester');

        $this->db->join('matakuliah', 'matakuliah.id_mk = paket_mk.id_mk');
    return $this->db->get('paket_mk')->result();

    }

      public function entry_join($id)
    {
        $semester_aktif = $this->db->query('SELECT max(semester_aktif) as aktif from
            entry where id_mahasiswa='.$id)->row();

       $waktu = date('Y-m');
        $this->db->join('semester', 'semester.id_semester = entry.id_semester');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = entry.id_mahasiswa');

        $this->db->join('matakuliah', 'matakuliah.id_mk = entry.id_mk');
      // $this->db->where(array('semester.id_semester'=>13));
    $this->db->where(array('mahasiswa.id_mahasiswa'=>$id));
    $this->db->where(array('entry.semester_aktif'=>$semester_aktif->aktif));
    $this->db->where('waktu_entry', $waktu);
        return $this->db->get('entry')->result();
       // return $data->result();
    }


    function sum_sks($id,$waktu)
{

        $this->db->join('semester', 'semester.id_semester = entry.id_semester');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = entry.id_mahasiswa');

        $this->db->join('matakuliah', 'matakuliah.id_mk = entry.id_mk');
      // $this->db->where(array('semester.id_semester'=>13));
        $this->db->select('SUM(sks) as sks_total');
    $this->db->where(array('entry.id_mahasiswa'=>$id));
    $this->db->where('waktu_entry', $waktu);
        return $this->db->get('entry')->row();
}


 function sum_sks_banding($id)
{
     $waktu = date('Y-m');
        $this->db->join('semester', 'semester.id_semester = entry.id_semester');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = entry.id_mahasiswa');

        $this->db->join('matakuliah', 'matakuliah.id_mk = entry.id_mk');
      // $this->db->where(array('semester.id_semester'=>13));
        $this->db->select('SUM(sks) as sks_total');
    $this->db->where(array('mahasiswa.id_mahasiswa'=>$id));
    $this->db->where('waktu_entry', $waktu);
        return $this->db->get('entry')->row();
}

//model

 public function join_mk_syarat($mk,$mhs)
    {

        return $this->db->query("SELECT m.id_mk,m.syarat,n.akhir,n.huruf FROM
            nilai n join mk_syarat m on n.id_mk=m.syarat where m.id_mk=".$mk.
            " and n.akhir<=56 and n.id_mahasiswa=".$mhs);

    }
 public function join_mk_syarat_kosong($mk,$mhs)
    {

        return $this->db->query("SELECT * FROM
        nilai n join mk_syarat m on n.id_mk=m.syarat where m.id_mk=".$mk);

    }

    public function nama_mk($id)

    {
       //  $this->db->join('matakuliah', 'matakuliah.id_mk = syarat.id_mk');
         $this->db->where('id_mk', $id);
    $data = $this->db->get('matakuliah');
    return $data;

    }

//query Penting dont toch

//               SELECT m.id_mk,m.syarat,n.akhir,n.huruf FROM nilai n
//               join mk_syarat m on n.id_mk=m.syarat where m.id_mk=50 and n.akhir<=56
//               and n.id_mahasiswa=1
//

// Pemilihan semester
    public function semester_1()
    {
             $data =$this->db->query('SELECT * from matakuliah natural join semester
                           where semester.nama_semester =1');
             return $data;
    }
     public function semester_2()
    {
             $data =$this->db->query('SELECT * from matakuliah natural join semester
                           where semester.nama_semester =2');
             return $data;
    }
     public function semester_3()
    {
             $data =$this->db->query('SELECT * from matakuliah natural join semester
                           where semester.nama_semester =3');
             return $data;
    } public function semester_4()
    {
             $data =$this->db->query('SELECT * from matakuliah natural join semester
                           where semester.nama_semester =4');
             return $data;
    } public function semester_5()
    {
             $data =$this->db->query('SELECT * from matakuliah natural join semester
                           where semester.nama_semester =5');
             return $data;
    } public function semester_6()
    {
             $data =$this->db->query('SELECT * FROM matakuliah mk  WHERE mk.id_mk not in ( select bm.id_mk from bidangminat bm) and mk.id_semester=16 ORDER BY `id_mk` ASC');
             return $data;
    }



public function semester_6_all()
    {
              $data =$this->db->query('SELECT * from matakuliah natural join semester
                           where semester.nama_semester =6');
             return $data;
    }




    public function semester_7()
    {
             $data =$this->db->query('SELECT * FROM matakuliah mk  WHERE mk.id_mk not in ( select bm.id_mk from bidangminat bm) and mk.id_semester=17 ORDER BY `id_mk` ASC');
             return $data;
    } public function semester_8()
    {
             $data =$this->db->query('SELECT * from matakuliah natural join semester
                           where semester.nama_semester =8');
             return $data;
    }


    // validasi data sudah ada

    public function validasi($mk, $mhs)
    {

         $waktu = date('Y-m');
      $this->db->where('waktu_entry', $waktu);
        $this->db->where('id_mk', $mk);
        $this->db->where('id_mahasiswa', $mhs);
        return $this->db->get('entry');

    }
 // Validasi data sudah ada, dengan tidak ada syarat MK tertentu
    public function validasi_not_syarat($mk, $mhs)
    {

        $this->db->join('nilai', 'nilai.id_mk = entry.id_mk');
        $this->db->where('entry.id_mk', $mk);
          $this->db->where('nilai.akhir >',56);
        $this->db->where('nilai.id_mahasiswa', $mhs);
        return $this->db->get('entry');

    }

    public function nilai_sebelumnya($id)
    {
        $this->db->join('matakuliah', 'matakuliah.id_mk = nilai.id_mk');

        $this->db->join('semester', 'semester.id_semester = nilai.id_semester');
             $this->db->where('id_mahasiswa', $id);
        return $this->db->get('nilai');
    }



// For rekomendation
    public function rek_sc($mhs,$minat)
    {


        return $this->db->query('SELECT * from nilai
            join bidangminat_bersyarat bb
            on bb.id_mk = nilai.id_mk
            where nilai.id_mahasiswa='.$mhs.' and bb.id_minat='.$minat.' and nilai.akhir < 56 ');

    }
public function rek_ppk($mhs,$minat)
    {


        return $this->db->query('SELECT * from nilai join bidangminat_bersyarat bb on bb.id_mk = nilai.id_mk where nilai.id_mahasiswa='.$mhs.' and bb.id_minat='.$minat.' and nilai.id_mk=19');

    }
public function rek_jcm($mhs,$minat)
    {


        return $this->db->query('SELECT * from nilai join bidangminat_bersyarat bb on bb.id_mk = nilai.id_mk where nilai.id_mahasiswa='.$mhs.' and bb.id_minat='.$minat.' and nilai.id_mk=48');

    }



    public function rek_sc_join_mk($semester)
    {
        $this->db->join('matakuliah mk', 'mk.id_mk = bidangminat.id_mk');
        $this->db->where(array('semester'=>$semester));
        $this->db->where(array('id_minat'=>1));
 return $this->db->get('bidangminat');



    }


      public function rek_ppk_join_mk($semester)
    {
        $this->db->join('matakuliah mk', 'mk.id_mk = bidangminat.id_mk');
        $this->db->where(array('semester'=>$semester));
        $this->db->where(array('id_minat'=>2));
 return $this->db->get('bidangminat');



    }


        public function rek_jcm_join_mk($semester)
    {
        $this->db->join('matakuliah mk', 'mk.id_mk = bidangminat.id_mk');
        $this->db->where(array('semester'=>$semester));
        $this->db->where(array('id_minat'=>3));

       return $this->db->get('bidangminat');



    }


// rekomendasi kosong untuk halaman validasi

// untuk  semester 6 mk umum
// SELECT * FROM matakuliah mk WHERE mk.id_mk not in ( select bm.id_mk from bidangminat bm) and mk.id_semester=16 ORDER BY `id_mk` ASC limit 3 // masih pake limit

 public function get_validasi_mk($mk,$mhs)
    {


        $data = $this->db->query('select * from entry where id_entry='.$mk)->row();



        $this->db->join('matakuliah', 'matakuliah.id_mk = entry.id_mk');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = entry.id_mahasiswa');

        $this->db->where('entry.id_mahasiswa', $mhs);
          $this->db->where('entry.id_entry', $mk);
        $this->db->where('entry.id_semester', $data->id_semester);
        return $this->db->get('entry');
    }
// batas untuk validasi matakuliah

    public function val_semester_1($mhs)
    {
        $this->db->join('matakuliah', 'matakuliah.id_mk = entry.id_mk');
        $this->db->where('entry.id_mahasiswa', $mhs);
        $this->db->where('entry.id_semester', 11);
        return $this->db->get('entry');
    }

public function val_semester_2($mhs)
    {
        $this->db->join('matakuliah', 'matakuliah.id_mk = entry.id_mk');
        $this->db->where('entry.id_mahasiswa', $mhs);
        $this->db->where('entry.id_semester', 12);
        return $this->db->get('entry');
    }

    public function val_semester_3($mhs)
    {
        $this->db->join('matakuliah', 'matakuliah.id_mk = entry.id_mk');
        $this->db->where('id_mahasiswa', $mhs);
        $this->db->where('semester_aktif', 3);
        return $this->db->get('entry');
    }

    public function val_semester_4($mhs)
    {
        $this->db->join('matakuliah', 'matakuliah.id_mk = entry.id_mk');
        $this->db->where('id_mahasiswa', $mhs);
        $this->db->where('semester_aktif', 4);
        return $this->db->get('entry');
    }

    public function val_semester_5($mhs)
    {
        $this->db->join('matakuliah', 'matakuliah.id_mk = entry.id_mk');
        $this->db->where('id_mahasiswa', $mhs);
        $this->db->where('semester_aktif', 5);
        return $this->db->get('entry');
    }

    public function val_semester_6($mhs)
    {
        $this->db->join('matakuliah', 'matakuliah.id_mk = entry.id_mk');
        $this->db->where('id_mahasiswa', $mhs);
        $this->db->where('semester_aktif', 6);
        return $this->db->get('entry');
    }

    public function val_semester_7($mhs)
    {
        $this->db->join('matakuliah', 'matakuliah.id_mk = entry.id_mk');
        $this->db->where('id_mahasiswa', $mhs);
        $this->db->where('semester_aktif', 7);
        return $this->db->get('entry');
    }

    public function val_semester_8($mhs)
    {
        $this->db->join('matakuliah', 'matakuliah.id_mk = entry.id_mk');
        $this->db->where('id_mahasiswa', $mhs);
        $this->db->where('semester_aktif', 8);
        return $this->db->get('entry');
    }


// valida update

    public function cek_update($id_entry,$data)
    {
         $this->db->where('id_entry', $id_entry);
         return $this->db->update('entry', $data);
    }


  public function bm_sc_7($mhs)
    {
      return   $this->db->query('SELECT * FROM nilai join bidangminat bm on bm.id_mk=nilai.id_mk where nilai.id_semester=16 and nilai.id_mahasiswa='.$mhs.' and bm.id_minat=1');

    }

  public function bm_jcm_7($mhs)
    {
      return   $this->db->query('SELECT * FROM nilai join bidangminat bm on bm.id_mk=nilai.id_mk where nilai.id_semester=16 and nilai.id_mahasiswa='.$mhs.' and bm.id_minat=3');

    }

  public function bm_ppk_7($mhs)
    {
      return   $this->db->query('SELECT * FROM nilai join bidangminat bm on bm.id_mk=nilai.id_mk where nilai.id_semester=16 and nilai.id_mahasiswa='.$mhs.' and bm.id_minat=2');

    }






  public function bm_sc_8($mhs)
    {
      return   $this->db->query('SELECT * FROM nilai join bidangminat bm on bm.id_mk=nilai.id_mk where nilai.id_semester=17 and nilai.id_mahasiswa='.$mhs.' and bm.id_minat=1');

    }

  public function bm_jcm_8($mhs)
    {
      return   $this->db->query('SELECT * FROM nilai join bidangminat bm on bm.id_mk=nilai.id_mk where nilai.id_semester=17 and nilai.id_mahasiswa='.$mhs.' and bm.id_minat=3');

    }

  public function bm_ppk_8($mhs)
    {
      return   $this->db->query('SELECT * FROM nilai join bidangminat bm on bm.id_mk=nilai.id_mk where nilai.id_semester=17 and nilai.id_mahasiswa='.$mhs.' and bm.id_minat=2');

    }






}

/* End of file Entry_model.php */
/* Location: ./application/models/Entry_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:14 */
/* http://harviacode.com */
