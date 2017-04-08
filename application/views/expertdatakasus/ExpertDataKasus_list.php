
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">ExpertDataKasus List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('expertdatakasus/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('expertdatakasus/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('expertdatakasus/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Kode DataKasus</th>

		    <th>Nama DataKasus</th>
		    <th>Keterangan</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($expertdatakasus_data as $expertdatakasus)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
        <td><?php echo $expertdatakasus->id_expert_kasus ?></td>

		    <td><?php echo $expertdatakasus->nama_DataKasus ?></td>
		    <td><?php echo $expertdatakasus->keterangan ?></td>
		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('expertdatakasus/read/'.$expertdatakasus->id_expert_kasus),'Read');
			echo ' | ';
			echo anchor(site_url('expertdatakasus/update/'.$expertdatakasus->id_expert_kasus),'Update');
			echo ' | ';
			echo anchor(site_url('expertdatakasus/delete/'.$expertdatakasus->id_expert_kasus),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
