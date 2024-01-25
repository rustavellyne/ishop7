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
                    <li class="breadcrumb-item">EAV</li>
                    <li class="breadcrumb-item active">Attributes</li>
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
                        <h3 class="card-title text-bold">Attributes List</h3>
                        <div class="card-tools">
                            <div class="actions">
                                <a class="btn btn-app bg-success" href="/admin/attributes/create">
                                    <i class="fas fa-file"></i> Create New Attribute
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
                                <th>Group Title</th>
                                <th style="width: 160px">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($groupsAndAttributes)): ?>
                                <?php foreach ($groupsAndAttributes as $key => $attr): ?>
                                    <?php if (!empty($attr['attr_id'])): ?>
                                    <tr>
                                        <td><?= $attr['attr_id'] ?></td>
                                        <td><?= $attr['attribute_title'] ?></td>
                                        <td><?= $attr['group_title'] ?></td>
                                        <td>
                                            <a class="btn btn-outline-success" href="/admin/attributes/edit?id=<?= $attr['attr_id'] ?>">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a class="btn btn-outline-danger" href="/admin/attributes/delete?id=<?= $attr['attr_id'] ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No Attributes yet</td>
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
