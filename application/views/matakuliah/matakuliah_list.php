
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Matakuliah List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('matakuliah/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('matakuliah/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('matakuliah/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Kode Mk</th>
		   
            <th>Nama Matakuliah</th>
		    <th>Sks</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($matakuliah_data as $matakuliah)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $matakuliah->kode_mk ?></td>

		    <td><?php echo $matakuliah->nama_matakuliah ?></td>
		    <td><?php echo $matakuliah->sks ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('matakuliah/read/'.$matakuliah->id_mk),'Read'); 
			echo ' | '; 
			echo anchor(site_url('matakuliah/update/'.$matakuliah->id_mk),'Update'); 
			echo ' | '; 
			echo anchor(site_url('matakuliah/delete/'.$matakuliah->id_mk),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>