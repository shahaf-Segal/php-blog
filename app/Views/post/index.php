<div>
    <h1>Posts</h1>
    <h2>All Posts</h2>
    <form action="/posts" method="get">
        <input
            type="text" name="search" placeholder="Search"
            value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>
    <?= renderPartial(
        '_posts',
        ['posts' => $posts]
    ) ?>
</div>