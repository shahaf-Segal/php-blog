<div>
    <h1><?= htmlspecialchars($post->title) ?></h1>
    <h2><?= htmlspecialchars($post->content) ?></h2>
    <p>Views: <?= $post->views ?> ,<?= $post->created_at ?></p>
    <?php foreach ($comments as $comment): ?>
        <article>
            <p><?= $comment->content ?></p>
        </article>
    <?php endforeach; ?>
</div>