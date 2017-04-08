
        <h2 style="margin-top:0px">Nilai Read</h2>
        <table class="table">
	    <tr><td>Mata Kuliah</td><td><?php echo $nama_matakuliah; ?></td></tr>
	    <tr><td>Mahasiswa</td><td><?php echo $nama_mahasiswa; ?></td></tr>
	    <tr><td>Semester</td><td><?php echo $nama_semester; ?></td></tr>
	    <tr><td>Tugas</td><td><?php echo $tugas; ?></td></tr>
	    <tr><td>Uts</td><td><?php echo $uts; ?></td></tr>
	    <tr><td>Uas</td><td><?php echo $uas; ?></td></tr>

	    <tr><td>Nilai Huruf</td><td><a href="#" title="Nilai Anda (<?php echo $huruf; ?>)" class="btn btn-primary"><?php echo $huruf; ?></a></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('nilai') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
