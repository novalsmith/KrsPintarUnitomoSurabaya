
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Kelas List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('kelas/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('kelas/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('kelas/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama Kelas</th>
        <th>Kapasitas Ruangan</th>

		    <th>Keterangan</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($kelas_data as $kelas)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>

		    <td><?php echo $kelas->nama_kelas ?></td>
        <td><?php echo $kelas->kapasitas ?></td>

		    <td><?php echo $kelas->keterangan ?></td>
		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('kelas/read/'.$kelas->id_kelas),'Read');
			echo ' | ';
			echo anchor(site_url('kelas/update/'.$kelas->id_kelas),'Update');
			echo ' | ';
			echo anchor(site_url('kelas/delete/'.$kelas->id_kelas),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
