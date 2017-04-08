
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Minat List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('minat/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('minat/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('minat/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama Minat</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($minat_data as $minat)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $minat->nama_minat ?></td>
		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('minat/read/'.$minat->id_minat),'Read');
			echo ' | ';
			echo anchor(site_url('minat/update/'.$minat->id_minat),'Update');
			echo ' | ';
			echo anchor(site_url('minat/delete/'.$minat->id_minat),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    
