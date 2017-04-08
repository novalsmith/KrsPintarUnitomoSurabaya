
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-5">
                <h2 style="margin-top:0px">Rekomendasi Bidang Minat</h2>
            </div>
            <div class="col-md-3 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('bidangminat/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('bidangminat/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('bidangminat/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Matakuliah</th>
		    <th>Nama Bidangminat</th>
              <th>Semester</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($bidangminat_data as $bidangminat)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $bidangminat->nama_matakuliah ?></td>
		    <td><?php echo $bidangminat->nama_minat ?></td>
              <td><?php echo $bidangminat->semester ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('bidangminat/read/'.$bidangminat->id_bidangminat),'Read'); 
			echo ' | '; 
			echo anchor(site_url('bidangminat/update/'.$bidangminat->id_bidangminat),'Update'); 
			echo ' | '; 
			echo anchor(site_url('bidangminat/delete/'.$bidangminat->id_bidangminat),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
