


        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-6">
                <h2 style="margin-top:0px">Daftar Mahasiswa  <small>Enty Matakuliah Mahasiswa </small></h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
              
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>NIM</th>
		    <th>Nama Mahasiswa</th>
		    <th>Pin</th>
		  
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($mhs_all->result() as $dpam)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $dpam->nim ?></td>
		    <td><?php echo $dpam->nama_mahasiswa ?></td>
		    <td><?php echo $dpam->pin ?></td>
	
		    <td style="text-align:center" width="200px">
		
<?php 




$set_paket = $this->db->get_where('entry',array('id_mahasiswa'=>$dpam->id_mahasiswa));

if ($set_paket->num_rows() >0) {  // ada data di tabel entry untuk mahasiswa




$data = array(
  'class' => 'btn btn-primary btn-sm'
  );

echo anchor(site_url('validasi/detail_mhs/'.$dpam->id_mahasiswa),'Lihat Detail  <p class="glyphicon glyphicon-eye-open"   ',$data); 
 


} else {
    // tidak ada data 

$data = array(
  'class' => 'btn btn-danger btn-sm'
  );

echo anchor(site_url('validasi/simpan_paket/'.$dpam->id_mahasiswa),'Beri Paket Matakuliah',$data);


}

 
 ?>











            </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
     
