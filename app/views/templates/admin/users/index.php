<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users Control</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- TODO: rewrite traverse TREE-->
<style>
    .users-card-header::after {
        content: none;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header users-card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title text-bold">Users List</h3>
                        <div class="card-tools">
                            <div class="actions">
                                <a class="btn btn-app bg-success">
                                    <i class="fas fa-users"></i> Create New User
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Login</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th style="width: 160px">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($users)): ?>
                                <?php foreach ($users as $key => $user): ?>
                                <tr>
                                    <td><?= $user->id ?></td>
                                    <td><?= $user->name ?></td>
                                    <td><?= $user->login ?></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $user->role ?></td>
                                    <td>
                                        <a class="btn btn-outline-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-outline-success">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a class="btn btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No users</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <?php if (!empty($pagination)): ?>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">

                            <li class="page-item <?= $pagination['prev']['state'] ?>">
                                <a class="page-link" href="<?= $pagination['prev']['value'] ?>">«</a>
                            </li>
                            <?php foreach ($pagination['numbers'] as $number): ?>
                                <li class="page-item <?= $number['state'] ?>">
                                    <a class="page-link" href="<?= $number['value'] ?>">
                                        <?= $number['label'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li class="page-item <?= $pagination['next']['state'] ?>">
                                <a class="page-link" href="<?= $pagination['next']['value'] ?>">»</a>
                            </li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
