<?php if($semester_sekarang->sekarang == 'Ganjil') : ?>

<?php redirect('smartGanjil/index'); ?>

<?php else: ?>

  <?php redirect('smartGenap/index'); ?>


<?php endif; ?>
