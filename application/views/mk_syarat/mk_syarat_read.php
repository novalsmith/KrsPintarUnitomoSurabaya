
        <h2 style="margin-top:0px"><?php echo $nama ?>  Read</h2>
        <table class="table">
	    <tr><td>Matakuliah</td><td><?php echo $id_mk; ?></td></tr>
	    <tr><td>Semester</td><td><?php echo $id_semester; ?></td></tr>
	    <tr><td>Nama Mk Syarat</td><td><?php echo $syarat; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('mk_syarat') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
