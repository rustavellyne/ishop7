<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">
                    Поиск
                </li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->

<?php
if (!empty($products)) : ?>

    <div class="product">
        <div class="container">
            <h1> Search results for '<?= $query ?>' </h1>
            <div class="product-top">
                <div class="product-one">
                    <?php
                    foreach ($products as $id => $product): ?>
                        <div class="col-md-3 product-left">
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
                                        <span class=" item_price">
                                            <?= priceCurrency($product['price']); ?></span>
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
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container">
        <div class="row">
            <h1 style="margin: 40px 10px"> No results for '<?= $query ?>' </h1>
        </div>
    </div>

<?php endif; ?>
