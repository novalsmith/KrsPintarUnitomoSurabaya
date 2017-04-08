
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">List Syarat Batas Sks </h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('SyaratBatasSks/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('SyaratBatasSks/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('SyaratBatasSks/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Matakuliah</th>
		    <th>Batas SKS</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($syaratbatassks_data as $syaratbatassks)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $syaratbatassks->nama_matakuliah ?></td>
		    <td><?php echo $syaratbatassks->batas_sks ?></td>
		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('SyaratBatasSks/read/'.$syaratbatassks->id_mk_syarat_sks),'Read');
			echo ' | ';
			echo anchor(site_url('SyaratBatasSks/update/'.$syaratbatassks->id_mk_syarat_sks),'Update');
			echo ' | ';
			echo anchor(site_url('SyaratBatasSks/delete/'.$syaratbatassks->id_mk_syarat_sks),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
