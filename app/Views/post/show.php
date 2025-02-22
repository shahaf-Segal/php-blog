<div>
    <h2><?= htmlspecialchars($post->title) ?></h2>
    <p><?= htmlspecialchars($post->content) ?></p>
    <p>Views: <?= $post->views ?> ,<?= $post->created_at ?></p>
    <?php foreach ($comments as $comment): ?>
        <article>
            <p><?= $comment->content ?></p>
        </article>
    <?php endforeach; ?>
</div>