<?php /** @var array $items */ ?>
<div class="mepanel">
    <div class="row">
        <?php foreach ($items as $item): ?>
            <div class="col1 me-one">
                <h4>
                    <?= $item['title'] ?>
                </h4>
                <?php if (isset($item['children'])):?>
                    <?= $this->renderChild($item['children'], 2) ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>