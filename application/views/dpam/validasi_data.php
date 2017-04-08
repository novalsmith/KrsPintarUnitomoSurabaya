


        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-8">
                <h2 style="margin-top:0px">Daftar Mahasiswa  <small>Validasi Mata Kuliah yg Sudah Di Program</small></h2>
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

$data = array(
  'class' => 'btn btn-success btn-sm'
  );

echo anchor(site_url('validasi/validasi_nilai/'.$dpam->id_mahasiswa),'Validasi  <p class="glyphicon glyphicon-exclamation-sign"   ',$data); 
 
 ?>











            </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
     
