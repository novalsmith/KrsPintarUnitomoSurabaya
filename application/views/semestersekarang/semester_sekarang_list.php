
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Semester Sekarang List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">

		<?php echo anchor(site_url('semestersekarang/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('semestersekarang/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Semester Sekarang</th>
        <th>Tahun Akademik</th>

		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($semestersekarang_data as $semestersekarang)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $semestersekarang->sekarang ?></td>
        <td><?php echo $semestersekarang->tahun_ajaran ?></td>

		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('semestersekarang/read/'.$semestersekarang->id_semester_sekarang),'Read');
			echo ' | ';
			echo anchor(site_url('semestersekarang/update/'.$semestersekarang->id_semester_sekarang),'Update');

			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
