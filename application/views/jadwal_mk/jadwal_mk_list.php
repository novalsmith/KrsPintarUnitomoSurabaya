
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">List Jadwal matakuliah </h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('jadwal_mk/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('jadwal_mk/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('jadwal_mk/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>

            <th width="80px">No</th>
		    <th>Matakuliah</th>
        <th>Semester</th>

		    <th>Jam Masuk</th>
		    <th>Jam Selesai</th>
		    <th>Ruangan</th>
		    <th>Hari</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($jadwal_mk_data as $jadwal_mk)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
        <td><?php echo $jadwal_mk->nama_matakuliah ?></td>

		    <td><?php echo $jadwal_mk->nama_semester ?></td>
		    <td><?php echo $jadwal_mk->jam_masuk ?></td>
		    <td><?php echo $jadwal_mk->jam_selesai ?></td>
		    <td><?php echo $jadwal_mk->nama_ruangan ?></td>
		    <td><?php echo $jadwal_mk->hari ?></td>
		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('jadwal_mk/read/'.$jadwal_mk->id_jadwal),'Read');
			echo ' | ';
			echo anchor(site_url('jadwal_mk/update/'.$jadwal_mk->id_jadwal),'Update');
			echo ' | ';
			echo anchor(site_url('jadwal_mk/delete/'.$jadwal_mk->id_jadwal),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
    </body>
