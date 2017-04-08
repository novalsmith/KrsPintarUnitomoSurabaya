
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px"><?php echo $nama ?></h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('mk_syarat/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('mk_syarat/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('mk_syarat/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Kode MK</th>

		    <th>MataKuliah</th>
		    <th>Semester</th>
		    <th>Harus Lulus</th>

		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php





            $start = 0;
            foreach ($mk_syarat_data->result() as $mk_syarat)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
        <td><?php echo $mk_syarat->kode_mk?></td>

            <td><?php echo $mk_syarat->nama_matakuliah?></td>
		    <td><?php echo $mk_syarat->nama_semester ?></td>
		    <td>

        <?php

    echo $mk_syarat->syarat;

          ?>

            </td>


		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('mk_syarat/read/'.$mk_syarat->id_syarat),'Read');
			echo ' | ';
			echo anchor(site_url('mk_syarat/update/'.$mk_syarat->id_syarat),'Update');
			echo ' | ';
			echo anchor(site_url('mk_syarat/delete/'.$mk_syarat->id_syarat),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
