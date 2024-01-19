<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Categories</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
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
                <?php if(!empty($tree)): ?>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span> Root </span>
                            <div class="btn-group">
                                <a href="/admin/category/add?id=0" class="btn btn-success btn-block m-0"><i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <ul class="list-group">
                            <?php foreach ($tree as $node): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><?= $node['title']?></span>
                                    <div class="btn-group">
                                        <a href="/admin/category/add?id=<?= $node['id'] ?>" class="btn btn-success btn-block m-0"><i class="fa fa-plus"></i>
                                        </a>
                                        <a href="/admin/category/remove?id=<?= $node['id'] ?>" class="btn btn-danger btn-block m-0"><i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </li>
                                <?php if (isset($node['children']) && is_array($node['children'])): ?>
                                    <li class="list-group-item">
                                        <ul class="list-group ml-5">
                                        <?php foreach ($node['children'] as $node1): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span><?= $node1['title']?></span>
                                                <div class="btn-group">
                                                    <a href="/admin/category/add?id=<?= $node1['id'] ?>" class="btn btn-success btn-block m-0"><i class="fa fa-plus"></i>
                                                    </a>
                                                    <a href="/admin/category/remove?id=<?= $node1['id'] ?>" class="btn btn-danger btn-block m-0"><i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <?php if (isset($node1['children']) && is_array($node1['children'])): ?>
                                            <li class="list-group-item">
                                                <ul class="list-group ml-5">
                                                    <?php foreach ($node1['children'] as $node2): ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <span><?= $node2['title']?></span>
                                                            <div class="btn-group">
                                                                <a href="/admin/category/add?id=<?= $node2['id'] ?>" class="btn btn-success btn-block m-0"><i class="fa fa-plus"></i>
                                                                </a>
                                                                <a href="/admin/category/remove?id=<?= $node2['id'] ?>" class="btn btn-danger btn-block m-0"><i class="fa fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <?php if (isset($node2['children']) && is_array($node2['children'])): ?>

                                                        <?php endif ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif ?>
                            <?php endforeach; ?>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
