<?php

use Core\View; ?>
<div>
    <h1>Home</h1>
    <h2>Recnt Posts</h2>
    <?= View::renderPartial(
        '_posts',
        ['posts' => $posts]
    ) ?>
</div>