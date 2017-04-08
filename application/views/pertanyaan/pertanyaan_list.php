
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Expert Rule List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
              <?php echo anchor(base_url('assets/kode.pdf'), 'Lihat Daftar Kode', 'class="btn btn-primary"'); ?>

                <?php echo anchor(site_url('pertanyaan/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('pertanyaan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('pertanyaan/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>

                    <th>Kode Rule</th>
		    <th>Semester</th>
		    <th>Mulai Pertanyaan</th>
        <th>Nama Rule Pertanyaan / Jawaban</th>

		    <th>Jika Ya</th>
		    <th>Jika Tidak</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($pertanyaan_data as $pertanyaan)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
        <td><?php echo $pertanyaan->id_pertanyaan?></td>

		    <td><?php echo $pertanyaan->nama_semester ?></td>
        <td><?php echo $pertanyaan->mulai ?></td>

		    <td><?php echo $pertanyaan->nama_pertanyaan ?></td>
		    <td><?php echo $pertanyaan->jika_ya ?></td>
		    <td><?php echo $pertanyaan->jika_tidak ?></td>
		    <td style="text-align:center" width="200px">
			<?php
			echo anchor(site_url('pertanyaan/read/'.$pertanyaan->id_pertanyaan),'Read');
			echo ' | ';
			echo anchor(site_url('pertanyaan/update/'.$pertanyaan->id_pertanyaan),'Update');
			echo ' | ';
			echo anchor(site_url('pertanyaan/delete/'.$pertanyaan->id_pertanyaan),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
