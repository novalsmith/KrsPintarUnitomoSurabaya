
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Jurusan List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('jurusan/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('jurusan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('jurusan/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Kode Jurusan</th>
		    <th>Nama Jurusan</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($jurusan_data as $jurusan)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $jurusan->kode_jurusan ?></td>
		    <td><?php echo $jurusan->nama_jurusan ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('jurusan/read/'.$jurusan->id_jurusan),'Read'); 
			echo ' | '; 
			echo anchor(site_url('jurusan/update/'.$jurusan->id_jurusan),'Update'); 
			echo ' | '; 
			echo anchor(site_url('jurusan/delete/'.$jurusan->id_jurusan),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>