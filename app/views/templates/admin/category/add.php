<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add New Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Add New Category</li>
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
                <form class="card card-primary" method="POST">
                    <div class="card-header">
                        <h3 class="card-title">General</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="parent_name">Parent Category Name</label>
                            <input type="text" id="parent_name" class="form-control" disabled value="<?= $parentCat->title ?? ''?>">
                            <input type="text" id="parent_id" name="parent_id" class="form-control" hidden value="<?= $parentCat->id ?? '0'?>">
                        </div>
                        <div class="form-group">
                            <label for="category_title">Category Title</label>
                            <input type="text" id="category_title" name="category_title" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="category_description">Category Description</label>
                            <textarea id="category_description" name="category_description" class="form-control" rows="2" placeholder="separate list items with comma"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category_keywords">Category Keywords</label>
                            <textarea id="category_keywords" name="category_keywords" class="form-control" rows="2" placeholder="separate list items with comma"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success float-right" value="Save">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </div>
</section>
