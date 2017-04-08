
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Admin List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
               
		<?php echo anchor(site_url('admin/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('admin/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Username</th>
		    <th>Password</th>
		    <th>Email</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($admin_data as $admin)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $admin->username ?></td>
		    <td><?php echo $admin->password ?></td>
		    <td><?php echo $admin->email ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('admin/read/'.$admin->id_admin),'Read'); 
			echo ' | '; 
			echo anchor(site_url('admin/update/'.$admin->id_admin),'Update'); 
			
			
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
