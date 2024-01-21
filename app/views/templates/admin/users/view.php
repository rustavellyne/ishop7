<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User View</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">User view</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- TODO: rewrite traverse TREE-->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (!empty($user)): ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">User Details</h3>
                            <div class="card-tools">
                                <div class="actions">
                                    <a class="btn btn-app bg-success" href="/admin/users/edit?id=<?= $user->id ?>">
                                        <i class="fas fa-pen-alt"></i> Edit User
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>User ID</td>
                                    <td><?= $user->id ?></td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td><?= $user->name ?></td>
                                </tr>
                                <tr>
                                    <td>Login</td>
                                    <td><?= $user->login ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?= $user->email ?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><?= $user->address ?></td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td><?= $user->role ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                <?php endif; ?>
                <?php if (!empty($userOrders)): ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Orders</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Date</th>
                                    <th>Update date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($userOrders as $order): ?>
                                <tr>
                                    <td>
                                        <?= $order->id ?>
                                    </td>
                                    <td>
                                        <?= $order->date ?>
                                    </td>
                                    <td>
                                        <?= $order->update_at ?>
                                    </td>
                                    <td>
                                        <span class="badge <?= $order->status == '1' ? 'badge-success' : 'badge-info' ?>">
                                            <?= $order->status == '1' ? 'Approved' : 'Processing'?>
                                        </span>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="/admin/order/view?id=<?= $user->id?>">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                <?php else: ?>
                    <h3>No orders yet</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
