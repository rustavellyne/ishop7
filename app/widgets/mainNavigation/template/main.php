<?php /** @var array $tree */?>

<ul class="memenu skyblue">
    <li class="grid active">
        <a href="index.html">Home</a>
    </li>
    <?php foreach ($tree as $item): ?>
    <li class="grid">
        <a href="<?= $item['alias'] ?>">
            <?= $item['title'] ?>
        </a>
        <?php if (isset($item['children'])): ?>
            <?= $this->renderChild($item['children'], 1) ?>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>

    <li class="grid">
        <a href="typo.html">Blog</a>
    </li>
    <li class="grid">
        <a href="contact.html">Contact</a>
    </li>
</ul>