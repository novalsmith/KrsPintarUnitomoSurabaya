
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Nilai List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('nilai/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('nilai/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('nilai/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Matakuliah</th>
		    <th>Mahasiswa</th>
		    <th>Semester</th>
		    <th>Tugas</th>
		    <th>Uts</th>
		    <th>Uas</th>

		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($nilai_join as $nilai)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $nilai->nama_matakuliah ?></td>
		    <td><?php echo $nilai->nama_mahasiswa ?></td>
		    <td><?php echo $nilai->nama_semester ?></td>
		    <td><?php echo $nilai->tugas ?></td>
		    <td><?php echo $nilai->uts ?></td>
		    <td><?php echo $nilai->uas ?></td>
		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('nilai/read/'.$nilai->id_nilai),'Read');
			echo ' | ';
			echo anchor(site_url('nilai/update/'.$nilai->id_nilai),'Update');
			echo ' | ';
			echo anchor(site_url('nilai/delete/'.$nilai->id_nilai),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
