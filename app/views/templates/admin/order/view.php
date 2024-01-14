<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-bold">Order #<?= $order['order_id']?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/order">Order List</a></li>
                    <li class="breadcrumb-item active">Order</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Order Details</h3>
                        <div class="card-tools">

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Order Number</td>
                                    <td><?= $order['order_id'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Date Create</td>
                                    <td><?= $order['order_create_date'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Date Update</td>
                                    <td><?= $order['order_update_date'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td>Totals</td>
                                    <td><?= $order['totals'] ? $order['totals'] . ' ' . $order['currency'] : '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td><?= $order['customer_name'] ?: 'Guest' ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <span class="badge <?= $order['order_status'] == '1' ? 'badge-success' : 'badge-info' ?>">
                                            <?= $order['order_status'] ? 'Approved' : 'Processing'?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Comment</td>
                                    <td><?= $order['note'] ? json_decode($order['note'], true)['notes'] : '-' ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <?php if (!empty($orderProducts)): ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Order Products</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orderProducts as $product): ?>
                                <tr>
                                    <td><?= $product['id'] ?? '-'?></td>
                                    <td><?= $product['title'] ?? '-'?></td>
                                    <td><?= $product['qty'] ?? '-'?></td>
                                    <td><?= $product['price'] ?$product['price'] . ' ' . $order['currency'] : '-'?></td>
                                </tr>
                                <?php endforeach; ?>
                                <tr class="bg-dark">
                                    <td class="text-bold" colspan="2">Summary</td>
                                    <td class="text-bold"> <?= array_reduce($orderProducts, fn($sum, $item) => $sum + $item['qty'], 0) ?> </td>
                                    <td class="text-bold"> <?= $order['totals'] . ' ' . $order['currency']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
