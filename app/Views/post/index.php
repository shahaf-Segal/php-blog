<div>
    <h1>Posts</h1>
    <h2>All Posts</h2>
    <?php foreach ($posts as $post): ?>
        <article>
            <h4>
                <a href="/posts/<?= $post->id ?>">
                    <?= $post->title ?>
                </a>
            </h4>
            <p>
                <?= $post->content ?>
            </p>
        </article>

    <?php endforeach; ?>
</div>