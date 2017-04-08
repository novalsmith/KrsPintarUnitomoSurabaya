
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px"><?php echo $nama ?> List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('bidangminat_bersyarat/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('bidangminat_bersyarat/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('bidangminat_bersyarat/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Bidang Minat</th>
		    <th>Mata Kuliah</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($bidangminat_bersyarat_data as $bidangminat_bersyarat)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $bidangminat_bersyarat->nama_minat ?></td>
		    <td><?php echo $bidangminat_bersyarat->nama_matakuliah ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('bidangminat_bersyarat/read/'.$bidangminat_bersyarat->id_bminat_syarat),'Read'); 
			echo ' | '; 
			echo anchor(site_url('bidangminat_bersyarat/update/'.$bidangminat_bersyarat->id_bminat_syarat),'Update'); 
			echo ' | '; 
			echo anchor(site_url('bidangminat_bersyarat/delete/'.$bidangminat_bersyarat->id_bminat_syarat),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
  