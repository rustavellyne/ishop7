<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Orders</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Orders</li>
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
<!--                    <div class="card-header">-->
<!--                        <h3 class="card-title">Orders list</h3>-->
<!--                    </div>-->
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (!empty($orders)): ?>
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                           role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example2"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Order ID: activate to sort column descending">
                                                Order ID
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                colspan="1" aria-label="Customer: activate to sort column ascending">
                                                Customer
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                colspan="1" aria-label="Customer: activate to sort column ascending">
                                                Totals
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                Status
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                colspan="1"
                                                aria-label="Engine version: activate to sort column ascending">
                                                Date creating
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                colspan="1"
                                                aria-label="Engine version: activate to sort column ascending">
                                                Date Update
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($orders as $id => $order): ?>
                                            <tr class="<?= $id % 2 ? 'odd' : 'even' ?>">
                                                <td class="dtr-control sorting_1" tabindex="0"><?= $order['order_id']?></td>
                                                <td><?= $order['customer_name'] ?: 'Guest' ?></td>
                                                <td><?= $order['totals'] ?: '0' ?></td>
                                                <td>
                                                    <span class="badge <?= $order['order_status'] == '1' ? 'badge-success' : 'badge-info' ?>">
                                                        <?= $order['order_status'] ? 'Approved' : 'Processing'?>
                                                    </span>
                                                </td>
                                                <td><?= $order['order_create_date'] ?: '-' ?></td>
                                                <td><?= $order['order_update_date'] ?: '-' ?></td>
                                                <td><a href="/admin/order/view?id=<?= $order['order_id']?>">View</a></td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">Order ID</th>
                                            <th rowspan="1" colspan="1">Customer</th>
                                            <th rowspan="1" colspan="1">Totals</th>
                                            <th rowspan="1" colspan="1">Status</th>
                                            <th rowspan="1" colspan="1">Date creating</th>
                                            <th rowspan="1" colspan="1">Date Update</th>
                                            <th rowspan="1" colspan="1">Actions</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                        Showing <?= $pagination['amount']['start'] ?? 0 ?> to <?= $pagination['amount']['end'] ?? 0 ?> of <?= $pagination['amount']['totals'] ?? 0 ?> entries
                                    </div>
                                </div>
                                <?php if($pagination['numbers']): ?>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        <ul class="pagination" style="justify-content: flex-end;">
                                            <li class="paginate_button page-item previous disabled"
                                                id="example2_previous"><a href="#" aria-controls="example2"
                                                                          data-dt-idx="0" tabindex="0"
                                                                          class="page-link">Previous</a></li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                                                            aria-controls="example2"
                                                                                            data-dt-idx="1" tabindex="0"
                                                                                            class="page-link">1</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                                                      data-dt-idx="2" tabindex="0"
                                                                                      class="page-link">2</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                                                      data-dt-idx="3" tabindex="0"
                                                                                      class="page-link">3</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                                                      data-dt-idx="4" tabindex="0"
                                                                                      class="page-link">4</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                                                      data-dt-idx="5" tabindex="0"
                                                                                      class="page-link">5</a></li>
                                            <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                                                      data-dt-idx="6" tabindex="0"
                                                                                      class="page-link">6</a></li>
                                            <li class="paginate_button page-item next" id="example2_next"><a href="#"
                                                                                                             aria-controls="example2"
                                                                                                             data-dt-idx="7"
                                                                                                             tabindex="0"
                                                                                                             class="page-link">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php else: ?>
                            <h3>No orders</h3>
                        <?php endif; ?>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
