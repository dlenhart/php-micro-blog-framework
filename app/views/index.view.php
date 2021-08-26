<?php require('partials/header.view.php'); ?>

<?php if (count($posts) <= 0): ?>
  <div class="row">
        <div class="middlecolumn">
            <div class="card">
              No posts found. Check configuration or start writing!
            </div>
        </div>
  </div>
<?php else: ?>
  <?php foreach ($posts as $post): ?>
      <div class="row">
        <div class="middlecolumn">
            <div class="card">
              <h2><?= $post['meta']['title']; ?></h2>
              <h5>By <?= $post['meta']['author']; ?> -- <em><strong><?= $post['meta']['date']; ?></strong></em></h5>
              <p><?= $post['content']; ?>...</p><br />
              <a href="/post?post=<?= $post['file']; ?>">Read more >></a>
            </div>
        </div>
      </div>
  <?php endforeach; ?>
<?php endif; ?>

<?php require('partials/footer.view.php'); ?>
