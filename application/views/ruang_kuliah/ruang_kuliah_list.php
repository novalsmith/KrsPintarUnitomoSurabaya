
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Ruang kuliah List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('ruang_kuliah/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('ruang_kuliah/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('ruang_kuliah/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama Ruangan</th>
		    <th>Ket Ruangan</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($ruang_kuliah_data as $ruang_kuliah)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $ruang_kuliah->nama_ruangan ?></td>
		    <td><?php echo $ruang_kuliah->ket_ruangan ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
			echo anchor(site_url('ruang_kuliah/read/'.$ruang_kuliah->id_ruang_kuliah),'Read'); 
			echo ' | '; 
			echo anchor(site_url('ruang_kuliah/update/'.$ruang_kuliah->id_ruang_kuliah),'Update'); 
			echo ' | '; 
			echo anchor(site_url('ruang_kuliah/delete/'.$ruang_kuliah->id_ruang_kuliah),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
