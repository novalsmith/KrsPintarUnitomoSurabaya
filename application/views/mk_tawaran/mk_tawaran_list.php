
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Matakuliah yang di tawarkan</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('mk_tawaran/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('mk_tawaran/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('mk_tawaran/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Matakuliah</th>
		    <th>Semester</th>

		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($mk_tawaran_data as $mk_tawaran)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $mk_tawaran->nama_matakuliah ?></td>
		    <td><?php echo $mk_tawaran->nama_semester ?></td>
		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('mk_tawaran/read/'.$mk_tawaran->id_mk_tawaran),'Read');
			echo ' | ';
			echo anchor(site_url('mk_tawaran/update/'.$mk_tawaran->id_mk_tawaran),'Update');
			echo ' | ';
			echo anchor(site_url('mk_tawaran/delete/'.$mk_tawaran->id_mk_tawaran),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
