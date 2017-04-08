
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Jawaban List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('jawaban/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('jawaban/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('jawaban/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Kode_Jawaban</th>

		    <th>Nama Jawaban</th>
		    <th>Solusi</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($jawaban_data as $jawaban)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
        <td><?php echo $jawaban->id_jawaban ?></td>

		    <td><?php echo $jawaban->nama_jawaban ?></td>
		    <td><?php echo $jawaban->solusi ?></td>
		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('jawaban/read/'.$jawaban->id_jawaban),'Read');
			echo ' | ';
			echo anchor(site_url('jawaban/update/'.$jawaban->id_jawaban),'Update');
			echo ' | ';
			echo anchor(site_url('jawaban/delete/'.$jawaban->id_jawaban),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    
