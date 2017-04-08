
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Mahasiswa List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('mahasiswa/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('mahasiswa/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('mahasiswa/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nim</th>
		    <th>Nama Mahasiswa</th>
		    <th>Pin</th>
        <th>Paket Matakuliah</th>
        <th>Jenis Kelas</th>

		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($mahasiswa_data as $mahasiswa)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $mahasiswa->nim ?></td>
		    <td><?php echo $mahasiswa->nama_mahasiswa ?></td>
		    <td><?php echo $mahasiswa->pin ?></td>

        <?php
        $data_entry = $this->db->get_where('entry',array('id_mahasiswa' =>$mahasiswa->id_mahasiswa))->num_rows();
        if ($data_entry < 1): ?>
        <td>

              <a href="<?php echo base_url()?>mahasiswa/replace/<?php echo $mahasiswa->id_mahasiswa; ?>" class="btn btn-default btn-sm" role="button">Belum <b  class="glyphicon glyphicon-remove"></b>
              </a>
            </td>

        <?php else: ?>
          <td>
            <a href="#" class="btn btn-success btn-sm" role="button">Sudah <b  class="glyphicon glyphicon-ok"></b>
            </a>
              </td>
    <?php endif; ?>
              <td><?php

  echo $mahasiswa->jenis_kelas;


               ?></td>




		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('mahasiswa/read/'.$mahasiswa->id_mahasiswa),'Read');
			echo ' | ';
			echo anchor(site_url('mahasiswa/update/'.$mahasiswa->id_mahasiswa),'Update');
			echo ' | ';
			echo anchor(site_url('mahasiswa/delete/'.$mahasiswa->id_mahasiswa),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
