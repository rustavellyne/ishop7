<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">EAV Control</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Currencies</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<style>
    .product-card-header::after {
        content: none;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header product-card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title text-bold">Currencies List</h3>
                        <div class="card-tools">
                            <div class="actions">
                                <a class="btn btn-app bg-success" href="/admin/currency/create">
                                    <i class="fas fa-file"></i> Create New Currency
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
                                <th>Title</th>
                                <th>Code</th>
                                <th>Symbol left</th>
                                <th>Symbol Right</th>
                                <th>Value</th>
                                <th>Base</th>
                                <th style="width: 160px">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($currencies)): ?>
                                <?php foreach ($currencies as $key => $currency): ?>
                                    <tr>
                                        <td><?= $currency->id ?></td>
                                        <td><?= $currency->title ?></td>
                                        <td><?= $currency->code ?></td>
                                        <td><?= $currency->symbol_left ?></td>
                                        <td><?= $currency->symbol_right ?></td>
                                        <td><?= $currency->value ?></td>
                                        <td><?= $currency->base ?></td>
                                        <td>
                                            <a class="btn btn-outline-success" href="/admin/currency/edit?id=<?= $currency->id  ?>">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a class="btn btn-outline-danger" href="/admin/currency/delete?id=<?= $currency->id  ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No Currencies yet</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
