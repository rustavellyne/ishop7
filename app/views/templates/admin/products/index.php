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
                    <li class="breadcrumb-item">Catalog</li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- TODO: rewrite traverse TREE-->
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
                        <h3 class="card-title text-bold">Products List</h3>
                        <div class="card-tools">
                            <div class="actions">
                                <a class="btn btn-app bg-success" href="/admin/products/create">
                                    <i class="fas fa-file"></i> Create New Product
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
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th style="width: 160px">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($products)): ?>
                                <?php foreach ($products as $key => $product): ?>
                                    <tr>
                                        <td><?= $product->id ?></td>
                                        <td class="text-center">
                                            <div>
                                                <img src="images/<?= $product->img?>" class="img-thumbnail" alt="" width="50" height="50"/>
                                            </div>
                                        </td>
                                        <td><?= $product->title ?></td>
                                        <td><?= $product->price ?></td>
                                        <td><?= $product->status ? 'Active' : 'Disabled' ?></td>
                                        <td>
                                            <a class="btn btn-outline-primary" href="/admin/products/view?id=<?= $product->id?>">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn btn-outline-success" href="/admin/products/edit?id=<?= $product->id?>">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a class="btn btn-outline-danger" href="/admin/products/delete?id=<?= $product->id?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No Products yet</td>
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
