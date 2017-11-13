<?php if ($page): // Node template if your displaying the page ?>

  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>

  <?php if(!$status) {
    print '<div class="node-unpublished unpublished-publication">';
    print '<div class="unpublished">unpublished</div>';
  } ?>
  <div class="content">
    <?php print $content; ?>
  </div>
  <?php if(!$status) {
    print '</div>';
  } ?>

  <?php print $links; ?>



<?php else: // Node template if your displaying the teaser ?>
<article>
  <h2 class="title">
    <a href="<?php print $node_url; ?>" title="<?php print $title ?>"><?php print $title; ?></a>
  </h2>

  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>

  <div class="content">
    <?php print $content; ?>
  </div>

  <a href="<?php print $node_url; ?>" title="<?php print $title; ?>" class="btn btn-primary">Read more</a>
  
  <hr>

</article>
<?php endif; ?>

