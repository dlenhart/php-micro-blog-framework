<?php require('partials/header.view.php'); ?>
    <div class="row">
      <div class="middlecolumn">
          <div class="card">
            <h2><?= $meta['title']; ?></h2>
            <h5>By <?= $meta['author']; ?> -- <em><strong><?= $meta['date']; ?></strong></em></h5>
            <p><?= $post; ?></p>
          </div>
      </div>
    </div>
<?php require('partials/footer.view.php'); ?>