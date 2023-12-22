<!--banner-starts-->
<div class="bnr" id="home">
    <div id="top" class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <img src="images/bnr-1.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-2.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-3.jpg" alt=""/>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>
<!--banner-ends-->

<!--about-starts-->
<div class="about">
    <div class="container">
        <?php
        if (!empty($brands)): ?>

            <div class="about-top grid-1">
                <?php
                foreach ($brands as $brand): ?>
                    <div class="col-md-4 about-left">
                        <figure class="effect-bubba">
                            <img class="img-responsive" src="images/<?= $brand->img ?>" alt="<?= $brand->title ?>"/>
                            <figcaption>
                                <h2> <?= $brand->title ?> </h2>
                                <p> <?= $brand->description ?> </p>
                            </figcaption>
                        </figure>
                    </div>
                <?php
                endforeach; ?>
                <div class="clearfix"></div>
            </div>

        <?php
        endif ?>
    </div>
</div>
<!--about-end-->
<!--product-starts-->
<?php
if (!empty($popularProjects)) : ?>
    <div class="product">
        <div class="container">
            <div class="product-top">
                <div class="product-one">
                    <?php
                    foreach ($popularProjects as $product): ?>
                        <div class="col-md-3 product-left">
                            <div class="product-main simpleCart_shelfItem">
                                <a href="product/view/<?= $product->alias ?>" class="mask">
                                    <img class="img-responsive zoom-img" src="images/<?= $product->img ?>"
                                         alt="<?= $product->title ?>"/>
                                </a>
                                <div class="product-bottom">
                                    <h3><?= $product->title ?></h3>
                                    <p>Explore Now</p>
                                    <h4>
                                        <a class="item_add add-to-cart-link" href="cart/add?id=<?= $product->id ?>">
                                            <i></i>
                                        </a>
                                        <span class=" item_price"><?= /** @var array $currency */
                                            priceCurrency($product->price, $currency); ?></span>
                                        <?php
                                        if ($product->old_price): ?>
                                            <small>
                                                <del> <?= priceCurrency($product->old_price, $currency); ?></del>
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
<?php
endif; ?>
<!--product-end-->
