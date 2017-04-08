        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Semester List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('semester/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('semester/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('semester/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama Semester</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($semester_data as $semester)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $semester->nama_semester ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('semester/read/'.$semester->id_semester),'Read'); 
			echo ' | '; 
			echo anchor(site_url('semester/update/'.$semester->id_semester),'Update'); 
			echo ' | '; 
			echo anchor(site_url('semester/delete/'.$semester->id_semester),'Delete','onclick="javasciprt: return confirm(\'Are You Sure to Delete ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>