
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">ExpertRule List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('expertrule/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('expertrule/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('expertrule/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Id Semester</th>
		    <th>Id Expert Kasus</th>
		    <th>Id Expert Jawaban</th>
		    <th>Jika Ya</th>
		    <th>Jika Tidak</th>
		    <th>Mulai</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($expertrule_data as $expertrule)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $expertrule->id_semester ?></td>
		    <td><?php echo $expertrule->id_expert_kasus ?></td>
		    <td><?php echo $expertrule->id_expert_jawaban ?></td>
		    <td><?php echo $expertrule->jika_ya ?></td>
		    <td><?php echo $expertrule->jika_tidak ?></td>
		    <td><?php echo $expertrule->mulai ?></td>
		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('expertrule/read/'.$expertrule->id_expertrule),'Read');
			echo ' | ';
			echo anchor(site_url('expertrule/update/'.$expertrule->id_expertrule),'Update');
			echo ' | ';
			echo anchor(site_url('expertrule/delete/'.$expertrule->id_expertrule),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
