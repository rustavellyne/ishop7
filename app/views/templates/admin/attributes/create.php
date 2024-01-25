<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $page['title'] ?? 'Attribute Create'?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item">EAV</li>
                    <li class="breadcrumb-item active">Attribute</li>
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

                        <div class="form-group <?= isset($errors['value']) ? 'has-error is-invalid' : '' ?>">
                            <label for="attributeName">Title</label>
                            <input
                                value="<?= $formData['value'] ?? ''?>"
                                type="text" id="attributeName" name="value" class="form-control" required
                            >
                            <?php if (!empty($errors['value'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['value'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($groups)): ?>
                            <div class="form-group <?= isset($errors['attr_group_id']) ? 'has-error is-invalid' : '' ?>">
                                <label for="groupsSelect">Groups</label>
                                <select id="groupsSelect" class="form-control custom-select" name="attr_group_id" required>
                                    <option <?= isset($formData['attr_group_id']) && $formData['attr_group_id'] == '' ? 'selected' : '' ?> selected="" disabled="" value="">Select one</option>
                                    <?php foreach ($groups as $group): ?>
                                        <option <?= isset($formData['attr_group_id']) && $formData['attr_group_id'] == $group->id ? 'selected' : '' ?> value="<?= $group->id ?>">
                                            <?= $group->title ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>
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
