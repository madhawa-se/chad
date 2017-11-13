<?php $date = format_date($created , 'custom', 'jS F Y', $timezone, "en"); ?>

<?php if ($page): // Node template if your displaying the page ?>

  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>

  <p><i><?php print $date; ?></i></p>

  <?php if(!$status) {
    print '<div class="node-unpublished unpublished-news">';
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
  <h2 class="title node-news-teaser">
    <a href="<?php print $node_url; ?>" title="<?php print $title ?>"><?php print $title; ?></a>
  </h2>

  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>
  
  <p><?php print $date; ?></p>

  <?php print $content; ?>
  
  <?php print '<p><a href="' . $node_url . '" title="Read more" class="btn btn-primary">Read more</a></p>'; ?>
  
  <hr>
</article>
<?php endif; ?>

