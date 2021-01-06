<?php

namespace Anax\View;

/**
 * View to create a new book.
 */

$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToViewItems = url("book");



?><h1>Create a item</h1>

<?= $form ?>

<p>
    <a href="<?= $urlToViewItems ?>">View all</a>
</p>