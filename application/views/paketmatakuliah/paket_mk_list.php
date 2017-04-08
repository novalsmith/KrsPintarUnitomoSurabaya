
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">List Paket Matakuliah </h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('paketmatakuliah/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('paketmatakuliah/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('paketmatakuliah/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Semester</th>
		    <th>Mata Kuliah</th>
		        <th>SKS</th>
            <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($paketmatakuliah_data as $paketmatakuliah)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $paketmatakuliah->nama_semester ?></td>
		    <td><?php echo $paketmatakuliah->nama_matakuliah ?></td>
		              <td><?php echo $paketmatakuliah->sks ?></td>
            <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('paketmatakuliah/read/'.$paketmatakuliah->id_paket),'Read'); 
			echo ' | '; 
			echo anchor(site_url('paketmatakuliah/update/'.$paketmatakuliah->id_paket),'Update'); 
			echo ' | '; 
			echo anchor(site_url('paketmatakuliah/delete/'.$paketmatakuliah->id_paket),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
  