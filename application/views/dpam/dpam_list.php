
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Dpam List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('dpam/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('dpam/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('dpam/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nidn</th>
		    <th>Nama Dpam</th>
		    <th>Pin Dpam</th>
		 
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($dpam_data as $dpam)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $dpam->username ?></td>
		    <td><?php echo $dpam->nama_dpam ?></td>
		    <td><?php echo $dpam->password ?></td>
		    
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('dpam/read/'.$dpam->id_dpam),'Read'); 
			echo ' | '; 
			echo anchor(site_url('dpam/update/'.$dpam->id_dpam),'Update'); 
			echo ' | '; 
			echo anchor(site_url('dpam/delete/'.$dpam->id_dpam),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
     
