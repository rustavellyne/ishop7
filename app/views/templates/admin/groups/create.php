<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $page['title'] ?? 'Group Create'?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item">EAV</li>
                    <li class="breadcrumb-item active">Group</li>
                    <li class="breadcrumb-item active"><?= $page['breadcrumb'] ?? 'Create'?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- TODO: rewrite traverse TREE-->
<style>
    .eav-admin-registered-form .error.invalid-feedback {
        display: block;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?= $page['breadcrumb'] ?? 'Create'?> Form</h3>
                    </div>
                    <form class="card-body eav-admin-registered-form" method="post">

                        <?php if (isset($formData['id'])): ?>
                            <input
                                value="<?= $formData['id'] ?? ''?>"
                                type="text" name="id" class="form-control" hidden
                            >
                        <?php endif; ?>

                        <div class="form-group <?= isset($errors['title']) ? 'has-error is-invalid' : '' ?>">
                            <label for="eavName">Title</label>
                            <input
                                value="<?= $formData['title'] ?? ''?>"
                                type="text" id="eavName" name="title" class="form-control" required
                            >
                            <?php if (!empty($errors['title'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['title'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="submit_save">Actions</label>
                            <input type="submit" id="submit_save" class="btn btn-success form-control" value="Save">
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
