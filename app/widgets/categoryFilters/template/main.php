<?php
$filters = $filters ?? [];
?>
<?php if (!empty($filters)): ?>
<?php foreach ($filters as $filter): ?>
<section class="sky-form">
    <h4> <?= $filter['group']['group_title'] ?> </h4>
    <div class="row1 scroll-pane">
        <?php foreach ($filter['attributes'] as $attr): ?>
        <div class="col col-4">
            <label class="checkbox"><input type="checkbox" name="filters" value="<?= $attr['attr_id']?>"><i></i>
                <?= $attr['attribute_title']?>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endforeach; ?>
<?php endif; ?>