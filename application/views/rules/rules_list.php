
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Rules List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('rules/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('rules/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('rules/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Pertanyaan</th>
		    <th>Jawaban</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($rules_data as $rules)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $rules->id_pertanyaan ?></td>
		    <td><?php echo $rules->id_jawaban ?></td>
		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('rules/read/'.$rules->id_rules),'Read');
			echo ' | ';
			echo anchor(site_url('rules/update/'.$rules->id_rules),'Update');
			echo ' | ';
			echo anchor(site_url('rules/delete/'.$rules->id_rules),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
