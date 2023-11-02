<option value="<?= /** @var array $currency */ $currency['code']?>" class="label"><?= $currency['title']?> :</option>
<?php
/** @var array $currencies */
foreach ($currencies as $code => $item): ?>
    <?php if ($code !== $currency['code']): ?>
        <option value="<?= $code ?>">
            <?= $item['title'] ?>
        </option>
    <?php endif; ?>
<?php endforeach; ?>