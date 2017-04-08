
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">ExpertJawaban List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('expertjawaban/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('expertjawaban/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('expertjawaban/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Kode Jawaban</th>

		    <th>Nama Jawaban</th>
		    <th>Solusi</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($expertjawaban_data as $expertjawaban)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
        <td><?php echo $expertjawaban->id_expert_jawaban ?></td>

		    <td><?php echo $expertjawaban->nama_jawaban ?></td>
		    <td><?php echo $expertjawaban->solusi ?></td>
		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('expertjawaban/read/'.$expertjawaban->id_expert_jawaban),'Read');
			echo ' | ';
			echo anchor(site_url('expertjawaban/update/'.$expertjawaban->id_expert_jawaban),'Update');
			echo ' | ';
			echo anchor(site_url('expertjawaban/delete/'.$expertjawaban->id_expert_jawaban),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
