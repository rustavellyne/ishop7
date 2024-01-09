<?php
/** @var array $categoryCurrent */ ?>
<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">
                    <?= $categoryCurrent->title ?>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- End of breadcrumbs-->

<!--start-single-->
<div class="single category">
    <div class="container">
        <h2> <?=$categoryCurrent->title ?></h2>
        <?php if (!empty($products)): ?>
        <div class="product-top">
            <div class="product-one col-md-9">
                <?php
                foreach ($products as $id => $product): ?>
                    <div class="col-md-4 product-left">
                        <div class="product-main simpleCart_shelfItem">
                            <a href="product/view/<?= $product['alias'] ?>" class="mask">
                                <img class="img-responsive zoom-img" src="images/<?= $product['img'] ?>"
                                     alt="<?= $product['title'] ?>"/>
                            </a>
                            <div class="product-bottom">
                                <h3><?= $product['title'] ?></h3>
                                <p>Explore Now</p>
                                <h4>
                                    <a class="item_add add-to-cart-link" href="cart/add?product_id=<?= $id ?>">
                                        <i></i>
                                    </a>
                                    <span class=" item_price"><?=
                                        priceCurrency($product['price']); ?></span>
                                    <?php
                                    if ($product['old_price']): ?>
                                        <small>
                                            <del> <?= priceCurrency($product['old_price']); ?></del>
                                        </small>
                                    <?php
                                    endif; ?>
                                </h4>
                            </div>
                            <div class="srch">
                                <span>-50%</span>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach; ?>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-3 single-right">
                <div class="w_sidebar">
                    <?= (new \IShop\widgets\categoryFilters\CategoryFilter())->toHtml() ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php if (!empty($pagination)): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="<?= $pagination['prev']['state'] ?>">
                            <a href="<?= $pagination['prev']['value'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php foreach ($pagination['numbers'] as $number): ?>
                            <li class="<?= $number['state'] ?>">
                                <a href="<?= $number['value'] ?>">
                                    <?= $number['label'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li class="<?= $pagination['next']['state'] ?>">
                            <a href="<?= $pagination['next']['value'] ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <p> No products in current category</p>
        <?php endif; ?>
    </div>
</div>