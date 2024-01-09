<?php
$filters = $filters ?? [];
$checked = $checked ?? [];
?>
<?php if (!empty($filters)): ?>
<form method="GET">
    <div class="col-sm-12" style="margin-bottom: 10px">
        <input type="submit" class="btn btn-info" VALUE="submit">
    </div>
<?php foreach ($filters as $filter): ?>
<section class="sky-form">
    <h4> <?= $filter['group']['group_title'] ?> </h4>
    <div class="row1 scroll-pane">
        <?php foreach ($filter['attributes'] as $attr): ?>
        <div class="col col-4">
            <label class="checkbox">
                <input type="checkbox" name="filters[]" <?= in_array($attr['attr_id'], $checked) ? 'checked' : '' ?> value="<?= $attr['attr_id']?>">
                <i></i>
                <?= $attr['attribute_title']?>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endforeach; ?>

</form>
<?php endif; ?>