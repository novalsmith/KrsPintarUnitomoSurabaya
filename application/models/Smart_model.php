<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Smart_model extends CI_Model
{


    function __construct()
    {
        parent::__construct();
    }

   public function max_semester($id)
{
  # code...
  $dataget = $this->db->query('select max(semester_aktif) as total from entry where id_mahasiswa='.$id)->row();
  return $dataget;
}

public function mulai_Y_1()
{
# code...
$this->db->where('mulai', 'Y');
$this->db->where('s.nama_semester', 1);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_2()
{
# code...
$this->db->where('mulai', 'Y');
$this->db->where('s.nama_semester', 2);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_3()
{
# code...
$this->db->where('mulai', 'Y');
$this->db->where('s.nama_semester', 3);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_4()
{
# code...
$this->db->where('mulai', 'Y');
$this->db->where('s.nama_semester', 4);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_5()
{
# code...
$this->db->where('mulai', 'Y');
$this->db->where('s.nama_semester', 5);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_6()
{
# code...
$this->db->where('mulai', 'Y');
$this->db->where('s.nama_semester', 6);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_7()
{
# code...
$this->db->where('mulai', 'Y');
$this->db->where('s.nama_semester', 7);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_8()
{
# code...
$this->db->where('mulai', 'Y');
$this->db->where('s.nama_semester', 8);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}


// Batas

public function mulai_Y_1_respon($respon)
{
# code...
$this->db->where('s.nama_semester', 1);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_2_respon($respon)
{
# code...
$this->db->where('s.nama_semester', 2);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_3_respon($respon)
{
# code...
$this->db->where('s.nama_semester', 3);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_4_respon($respon)
{
# code...
$this->db->where('s.nama_semester', 4);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_5_respon($respon)
{
# code...
$this->db->where('s.nama_semester', 5);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_6_respon($respon)
{
# code...
$this->db->where('s.nama_semester', 6);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_7_respon($respon)
{
# code...
$this->db->where('s.nama_semester', 7);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function mulai_Y_8_respon($respon)
{
# code...
$this->db->where('s.nama_semester', 8);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}


public function RB1($smt)
{
    $this->db->join('matakuliah mk', 'mk.id_mk = mk_tawaran.id_mk');
    $this->db->join('semester s', 's.id_semester = mk_tawaran.id_semester');
    $this->db->where('s.nama_semester', $smt);
    return $this->db->get('mk_tawaran')->result();
}

public function RB2($smt)
{
    $this->db->join('matakuliah mk', 'mk.id_mk = mk_tawaran.id_mk');
    $this->db->join('semester s', 's.id_semester = mk_tawaran.id_semester');
    $this->db->where('s.nama_semester', $smt);
    return $this->db->get('mk_tawaran')->result();
}

public function RB3($smt)
{
    $this->db->join('matakuliah mk', 'mk.id_mk = mk_tawaran.id_mk');
    $this->db->join('semester s', 's.id_semester = mk_tawaran.id_semester');
    $this->db->where('s.nama_semester', $smt);
    return $this->db->get('mk_tawaran')->result();
}
public function RB4($smt)
{
    $this->db->join('matakuliah mk', 'mk.id_mk = mk_tawaran.id_mk');
    $this->db->join('semester s', 's.id_semester = mk_tawaran.id_semester');
    $this->db->where('s.nama_semester', $smt);
    return $this->db->get('mk_tawaran')->result();
}
public function RB5($smt)
{
    $this->db->join('matakuliah mk', 'mk.id_mk = mk_tawaran.id_mk');
    $this->db->join('semester s', 's.id_semester = mk_tawaran.id_semester');
    $this->db->where('s.nama_semester', $smt);
    return $this->db->get('mk_tawaran')->result();
}
public function RB6($smt)
{
    $this->db->join('matakuliah mk', 'mk.id_mk = mk_tawaran.id_mk');
    $this->db->join('semester s', 's.id_semester = mk_tawaran.id_semester');
    $this->db->where('s.nama_semester', $smt);
    return $this->db->get('mk_tawaran')->result();
}
public function RB7($smt)
{
    $this->db->join('matakuliah mk', 'mk.id_mk = mk_tawaran.id_mk');
    $this->db->join('semester s', 's.id_semester = mk_tawaran.id_semester');
    $this->db->where('s.nama_semester', $smt);
    return $this->db->get('mk_tawaran')->result();
}
public function RB8($smt)
{
    $this->db->join('matakuliah mk', 'mk.id_mk = mk_tawaran.id_mk');
    $this->db->join('semester s', 's.id_semester = mk_tawaran.id_semester');
    $this->db->where('s.nama_semester', $smt);
    return $this->db->get('mk_tawaran')->result();
}
public function RB9($smt)
{
    $this->db->join('matakuliah mk', 'mk.id_mk = mk_tawaran.id_mk');
    $this->db->join('semester s', 's.id_semester = mk_tawaran.id_semester');
    $this->db->where('s.nama_semester', $smt);
    return $this->db->get('mk_tawaran')->result();
}



public function H1($idmhs)
{

}


public function H2($idmhs)
{
  # code...
  $dat1 = date('Y');
	$dat2 = date('Y')-1;
	$dat3= $dat2.'/'.$dat1;

	$this->db->where('semester_tahun_akademik', 'Genap');
	$this->db->where('id_mahasiswa', $idmhs);
	$this->db->where('tahun_akademik', $dat3);
return $this->db->get('entry_temporary')->result();

}

public function H_Genap($mhs)
{
  $sem_2 = 2;
  $sem_4 = 4;
  $sem_6 = 6;
  $sem_8 = 8;
  $dat1 = date('Y');
  $dat2 = date('Y')-1;
  $dat3= $dat2.'/'.$dat1;
  $this->db->join('mk_tawaran mt', 'mt.id_mk_tawaran = etmp.id_mk_tawaran');
  $this->db->join('kelas k', 'k.id_kelas = etmp.id_kelas');
  $this->db->join('jadwal_mk jmk', 'jmk.id_mk_tawaran = etmp.id_mk_tawaran');
  $this->db->join('matakuliah mk', 'mk.id_mk = mt.id_mk');

  $this->db->join('ruang_kuliah rk', 'rk.id_ruang_kuliah = jmk.id_ruang_kuliah');
  $this->db->join('semester s', 's.id_semester = mt.id_semester');
  $this->db->where('etmp.id_mahasiswa', $mhs);
  $this->db->where('etmp.semester_tahun_akademik', 'Genap');
  $this->db->where('etmp.tahun_akademik', $dat3);

  // $this->db->order_by('s.nama_semester', 'asc');
  return $this->db->get('entry etmp')->result();
}


public function H_Ganjil($mhs)
{
  $sem_1 = 1;
  $sem_3 = 3;
  $sem_5 = 5;
  $sem_7 = 7;
  $dat1 = date('Y');
  $dat2 = date('Y')-1;
  $dat3= $dat2.'/'.$dat1;
  $this->db->join('mk_tawaran mt', 'mt.id_mk_tawaran = etmp.id_mk_tawaran');
  $this->db->join('kelas k', 'k.id_kelas = etmp.id_kelas');
  $this->db->join('jadwal_mk jmk', 'jmk.id_mk_tawaran = etmp.id_mk_tawaran');
  $this->db->join('matakuliah mk', 'mk.id_mk = mt.id_mk');

  $this->db->join('ruang_kuliah rk', 'rk.id_ruang_kuliah = jmk.id_ruang_kuliah');
  $this->db->join('semester s', 's.id_semester = mt.id_semester');
  $this->db->where('etmp.id_mahasiswa', $mhs);
//  $this->db->where('s.nama_semester', $sem_1);
  //$this->db->or_where('s.nama_semester', $sem_3);
  //$this->db->or_where('s.nama_semester', $sem_5);
  //$this->db->or_where('s.nama_semester', $sem_7);

  $this->db->where('etmp.semester_tahun_akademik', 'Ganjil');
  $this->db->where('etmp.tahun_akademik', $dat3);
  // $this->db->order_by('s.nama_semester', 'asc');
  return $this->db->get('entry etmp')->result();
}

public function H4($idmhs)
{

}

public function H5($idmhs)
{

}
public function H6($idmhs)
{

}
public function H7($idmhs)
{

}
public function H8($idmhs)
{

}
public function validasiKRSentry($semester)
{
  $dat1 = date('Y');
	$dat2 = date('Y')-1;
	$dat3= $dat2.'/'.$dat1;
	$idmhs = $this->session->userdata('id_mahasiswa');


	$this->db->where('semester_tahun_akademik', 'Genap');
	$this->db->where('id_mahasiswa', $idmhs);
	$this->db->where('tahun_akademik', $dat3);
  $this->db->where('semester_aktif',$semester);

	// $this->db->order_by('s.nama_semester', 'asc');
	$replace_cek =  $this->db->get('entry')->num_rows();
  return $replace_cek;
}



public function validasiKRSentryGanjil($semester)
{
  $dat1 = date('Y');
	$dat2 = date('Y')-1;
	$dat3= $dat2.'/'.$dat1;
	$idmhs = $this->session->userdata('id_mahasiswa');


	$this->db->where('semester_tahun_akademik', 'Ganjil');
	$this->db->where('id_mahasiswa', $idmhs);
	$this->db->where('tahun_akademik', $dat3);
  $this->db->where('semester_aktif',$semester);

	// $this->db->order_by('s.nama_semester', 'asc');
	$replace_cek =  $this->db->get('entry')->num_rows();
  return $replace_cek;
}



public function validasiKRS()
{
  $dat1 = date('Y');
	$dat2 = date('Y')-1;
	$dat3= $dat2.'/'.$dat1;
	$idmhs = $this->session->userdata('id_mahasiswa');


	$this->db->where('semester_tahun_akademik', 'Genap');
	$this->db->where('id_mahasiswa', $idmhs);
	$this->db->where('tahun_akademik', $dat3);

	// $this->db->order_by('s.nama_semester', 'asc');
	$replace_cek =  $this->db->get('entry_temporary')->num_rows();
  return $replace_cek;
}

public function insertKRS3()
{
  $dat1 = date('Y');
  $dat2 = date('Y')-1;
  $dat3= $dat2.'/'.$dat1;
  $idmhs = $this->session->userdata('id_mahasiswa');


  $this->db->where('semester_tahun_akademik', 'Ganjil');
  $this->db->where('id_mahasiswa', $idmhs);
  $this->db->where('tahun_akademik', $dat3);

  // $this->db->order_by('s.nama_semester', 'asc');
  $replace =  $this->db->get('entry_temporary')->result();

return $replace;
}

public function insertKRS()
{
  $dat1 = date('Y');
  $dat2 = date('Y')-1;
  $dat3= $dat2.'/'.$dat1;
  $idmhs = $this->session->userdata('id_mahasiswa');


  $this->db->where('semester_tahun_akademik', 'Genap');
  $this->db->where('id_mahasiswa', $idmhs);
  $this->db->where('tahun_akademik', $dat3);

  // $this->db->order_by('s.nama_semester', 'asc');
  $replace =  $this->db->get('entry_temporary')->result();

return $replace;
}




public function hapus_entry_temp()
{
  $dat1 = date('Y');
  $dat2 = date('Y')-1;
  $dat3= $dat2.'/'.$dat1;
  $idmhs = $this->session->userdata('id_mahasiswa');


  $this->db->where('semester_tahun_akademik', 'Genap');
  $this->db->where('id_mahasiswa', $idmhs);
  $this->db->where('tahun_akademik', $dat3);

return   $this->db->delete('entry_temporary');
}


public function hapus_entry_temp_ganjil()
{
  $dat1 = date('Y');
  $dat2 = date('Y')-1;
  $dat3= $dat2.'/'.$dat1;
  $idmhs = $this->session->userdata('id_mahasiswa');


  $this->db->where('semester_tahun_akademik', 'Ganjil');
  $this->db->where('id_mahasiswa', $idmhs);
  $this->db->where('tahun_akademik', $dat3);

return   $this->db->delete('entry_temporary');
}



public function CekMinat($mhs)
{

$data=$this->db->query('SELECT e.id_mk_tawaran,mt.id_mk,m.nama_minat from entry e 
join mk_tawaran mt on mt.id_mk_tawaran=e.id_mk_tawaran join bidangminat bm on bm.id_mk=mt.id_mk 
join minat m on bm.id_minat=m.id_minat
 WHERE bm.semester=6 and e.semester_aktif=6 and e.id_mahasiswa="'.$mhs.'" ');
return $data;
}

public function viewMinat7($minat)
{

$data=$this->db->query('select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,
mk.kode_mk,mk.sks from mk_tawaran mt 
join matakuliah mk on mk.id_mk=mt.id_mk
  
where mt.id_semester=17

 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in
  (SELECT n.id_mk from nilai n WHERE n.akhir <=50) )
  and mt.id_mk in (SELECT b.id_mk FROM bidangminat b 
                   join minat m on m.id_minat=b.id_minat
                   WHERE m.nama_minat="'.$minat.'")
  
  UNION
  select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,
mk.kode_mk,mk.sks from mk_tawaran mt 
join matakuliah mk on mk.id_mk=mt.id_mk

 
where mt.id_semester=17
 
 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in
  (SELECT n.id_mk from nilai n WHERE n.akhir <=50) ) and mt.id_mk NOT in (SELECT b.id_mk FROM bidangminat b )
  
  
   ');
return $data->result();
}








public function viewMinat7empty()
{

$data=$this->db->query(' 
  select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,
mk.kode_mk,mk.sks from mk_tawaran mt 
join matakuliah mk on mk.id_mk=mt.id_mk

 
where mt.id_semester=17
 
 and mt.id_mk not in (select ms.id_mk from mk_syarat ms WHERE ms.syarat in
  (SELECT n.id_mk from nilai n WHERE n.akhir <=50) ) and mt.id_mk NOT in (SELECT b.id_mk FROM bidangminat b )
  
  
   ');
return $data->result();
}








public function hapus_entry()
{
  $dat1 = date('Y');
  $dat2 = date('Y')-1;
  $dat3= $dat2.'/'.$dat1;
  $idmhs = $this->session->userdata('id_mahasiswa');


  $this->db->where('semester_tahun_akademik', 'Genap');
  $this->db->where('id_mahasiswa', $idmhs);
  $this->db->where('tahun_akademik', $dat3);
return $this->db->delete('entry');
}

public function hapus_entry_H3()
{
  $dat1 = date('Y');
  $dat2 = date('Y')-1;
  $dat3= $dat2.'/'.$dat1;
  $idmhs = $this->session->userdata('id_mahasiswa');


  $this->db->where('semester_tahun_akademik', 'Ganjil');
  $this->db->where('id_mahasiswa', $idmhs);
  $this->db->where('tahun_akademik', $dat3);

return $this->db->delete('entry');
}

public function mengulang_semester1()
{
  $data_get = $this->db->query("select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=11 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=11)")->result();

  return $data_get;
}
public function mengulang_semester2()
{
  $data_get = $this->db->query("select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=12)")->result();

  return $data_get;
}public function mengulang_semester3()
{
  $data_get = $this->db->query("select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=13 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=13)")->result();

  return $data_get;
}public function mengulang_semester4()
{
  $data_get = $this->db->query("select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=14 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=14)")->result();

  return $data_get;
}public function mengulang_semester5()
{
  $data_get = $this->db->query("select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=15 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=15)")->result();

  return $data_get;
}public function mengulang_semester6()
{
  $data_get = $this->db->query("select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=16 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=16)")->result();

  return $data_get;
}public function mengulang_semester7()
{
  $data_get = $this->db->query("select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=17 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=17)")->result();

  return $data_get;
}public function mengulang_semester8()
{
  $data_get = $this->db->query("select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=18 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=18)")->result();

  return $data_get;
}
public function mengulang_semester1_cekData()
{
  $data_get = $this->db->query("
select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=11 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=11)")->num_rows();

  return $data_get;
}

public function mengulang_semester2_cekData()
{
  $data_get = $this->db->query("
select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks 
from mk_tawaran mt natural join matakuliah mk where mt.id_semester=12 and mt.id_mk_tawaran not in
 (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in 
 (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=12)")->num_rows();

  return $data_get;
}


public function mengulang_semester3_cekData()
{
  $data_get = $this->db->query("
select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=13 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=13)")->num_rows();

  return $data_get;
}
public function mengulang_semester4_cekData()
{
  $data_get = $this->db->query("
select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks 
from mk_tawaran mt natural join matakuliah mk where mt.id_semester=14 and mt.id_mk_tawaran 
not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n 
WHERE n.akhir <=50 and n.id_semester=14)")->num_rows();

  return $data_get;
}
public function mengulang_semester5_cekData()
{
  $data_get = $this->db->query("
select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=15 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=15)")->num_rows();

  return $data_get;
}
public function mengulang_semester6_cekData()
{
  $data_get = $this->db->query("
select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=16 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=16)")->num_rows();

  return $data_get;
}
public function mengulang_semester7_cekData()
{
  $data_get = $this->db->query("
select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=17 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=17)")->num_rows();

  return $data_get;
}
public function mengulang_semester8_cekData()
{
  $data_get = $this->db->query("
select DISTINCT (mt.id_mk_tawaran),mt.id_mk,mk.nama_matakuliah,mk.kode_mk,mk.sks from mk_tawaran mt natural join matakuliah mk where mt.id_semester=18 and mt.id_mk_tawaran not in (select ms.id_mk_tawaran from entry ms ) or mk.id_mk in (SELECT n.id_mk from nilai n WHERE n.akhir <=50 and n.id_semester=18)")->num_rows();

  return $data_get;
}


public function valid_semester1($respon)
{
# code...
$this->db->where('s.nama_semester', 1);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function valid_semester2($respon)
{
# code...
$this->db->where('s.nama_semester', 2);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}

public function valid_semester2s($respon)
{
# code...
 

return $this->db->query('select * from pertanyaan where id_pertanyaan="'.$respon.'"')->row();

}
 
public function valid_semester3($respon)
{
# code...
$this->db->where('s.nama_semester', 3);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function valid_semester4($respon)
{
# code...
$this->db->where('s.nama_semester', 4);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function valid_semester5($respon)
{
# code...
$this->db->where('s.nama_semester', 5);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function valid_semester6($respon)
{
# code...
$this->db->where('s.nama_semester', 6);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function valid_semester7($respon)
{
# code...
$this->db->where('s.nama_semester', 7);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}
public function valid_semester8($respon)
{
# code...
$this->db->where('s.nama_semester', 8);
$this->db->where('p.id_pertanyaan', $respon);
$this->db->join('semester s', 's.id_semester = p.id_semester');
return $this->db->get('pertanyaan p')->result();
}


public function rekomend($minat)
{
 $data = $this->db->query("SELECT bb.id_mk,m.nama_minat FROM bidangminat_bersyarat bb join minat m ON
m.id_minat=bb.id_minat WHERE m.nama_minat='".$minat."' and bb.id_mk 
in(select n.id_mk from nilai n where n.akhir<50)");
 return $data;
}

public function pkt6()
{
return  $this->db->query('SELECT * from mk_tawaran mt join matakuliah mk on mk.id_mk=mt.id_mk WHERE mt.id_mk 
not in (SELECT bm.id_mk from bidangminat bm WHERE bm.semester=6) and mt.id_semester=16  ')->result();
}

}

/* End of file Dpam_model.php */
/* Location: ./application/models/Dpam_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:14 */
/* http://harviacode.com */


/* End of file Dpam_model.php */
/* Location: ./application/models/Dpam_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-16 04:54:14 */
/* http://harviacode.com */
