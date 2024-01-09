<?php
$items = $cart['items'] ?? [];
$totals_qty = $cart['totals_qty'] ?? 0;
$totals_currency= $cart['totals_currency'] ?? 0;
$totals = $cart['totals'] ?? 0;
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <?php if (!empty($items)): ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Total</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#">
                                    <img class="media-object" src="images/<?=$item['img']?>" style="width: 72px; height: 72px;">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#"><?=$item['title']?></a></h4>
                                    <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
                                    <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                                </div>
                            </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                            <input type="text" class="form-control" value="<?= $item['qty'] ?>">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?= priceCurrency($item['price'])?> </strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?= priceCurrency($item['price'] * $item['qty'])?> </strong></td>
                        <td class="col-sm-1 col-md-1">
                        <button type="button" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button></td>
                    </tr>
                    <?php endforeach; ?>
                    <!--<tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>$24.59</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Estimated shipping</h5></td>
                        <td class="text-right"><h5><strong>$6.94</strong></h5></td>
                    </tr>-->
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong><?= priceCurrency($totals)?> </strong></h3></td>
                    </tr>
                </tbody>
            </table>
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_auth']):?>
                            <h2> Hi <?= $_SESSION['user']['name']?></h2>
                        <?php else: ?>
                            <h3 class="panel-title">Please sign up<small>It's free!</small></h3>
                        <?php endif; ?>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="/cart/placeOrder" >
                            <?php if (!isset($_SESSION['user'])):?>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group <?= isset($errors['name']) ? 'has-error' : '' ?>">
                                        <input type="text" name="name" id="first_name" class="form-control input-sm" placeholder="First Name" value="<?= $form['name'] ?? ''?>">
                                        <?php if (!empty($errors['name'])): ?>
                                            <span class="help-block">
                                        <?= implode('<br>', $errors['name'])?>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group <?= isset($errors['last_name']) ? 'has-error' : '' ?>">
                                        <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" value="<?= $form['last_name'] ?? ''?>">
                                        <?php if (!empty($errors['last_name'])): ?>
                                            <span class="help-block">
                                        <?= implode('<br>', $errors['last_name'])?>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?= isset($errors['address']) ? 'has-error' : '' ?>">
                                <input type="text" name="address" id="address" class="form-control input-sm" placeholder="Address" value="<?= $form['address'] ?? ''?>">
                                <?php if (!empty($errors['address'])): ?>
                                    <span class="help-block">
                                <?= implode('<br>', $errors['address'])?>
                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?>">
                                <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" value="<?= $form['email'] ?? ''?>">
                                <?php if (!empty($errors['email'])): ?>
                                    <span class="help-block">
                                <?= implode('<br>', $errors['email'])?>
                            </span>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group <?= isset($errors['notes']) ? 'has-error' : '' ?>">
                                        <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Enter notes to order"></textarea>
                                        <?php if (!empty($errors['notes'])): ?>
                                            <span class="help-block">
                                        <?= implode('<br>', $errors['notes'])?>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">
                                Place Order <span class="glyphicon glyphicon-play"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

    </div>
</div>
