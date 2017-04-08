
        <h2 style="margin-top:0px">Jadwal matakuliah Read</h2>
        <table class="table">
	    <tr><td>Id Mk</td><td><?php echo $id_mk; ?></td></tr>
	    <tr><td>Id Kelas</td><td><?php echo $id_kelas; ?></td></tr>
	    <tr><td>Jam Masuk</td><td><?php echo $jam_masuk; ?></td></tr>
	    <tr><td>Jam Selesai</td><td><?php echo $jam_selesai; ?></td></tr>
	    <tr><td>Ruangan</td><td><?php echo $ruangan; ?></td></tr>
	    <tr><td>Hari</td><td><?php echo $hari; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('jadwal_mk') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
