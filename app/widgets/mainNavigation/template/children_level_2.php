<?php /** @var array $items */ ?>
<ul>
    <?php foreach ($items as $item): ?>
        <li>
            <a href="category/view/<?= $item['alias'] ?>">
                <?= $item['title'] ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>