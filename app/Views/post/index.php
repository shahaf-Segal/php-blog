<div>
    <h1>Posts</h1>
    <h2>All Posts</h2>
    <form action="/posts" method="get">
        <input
            type="text" name="search" placeholder="Search"
            value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>
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