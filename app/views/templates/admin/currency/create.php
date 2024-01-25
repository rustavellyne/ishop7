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
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Currency</li>
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
                            <label for="currencyName">Title</label>
                            <input
                                value="<?= $formData['title'] ?? ''?>"
                                type="text" id="currencyName" name="title" class="form-control" required
                            >
                            <?php if (!empty($errors['title'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['title'])?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?= isset($errors['code']) ? 'has-error is-invalid' : '' ?>">
                            <label for="currencyCode">Code</label>
                            <input
                                    value="<?= $formData['code'] ?? ''?>"
                                    type="text" id="currencyCode" name="code" class="form-control" required
                            >
                            <?php if (!empty($errors['code'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['code'])?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?= isset($errors['symbol_left']) ? 'has-error is-invalid' : '' ?>">
                            <label for="symbolLeft">Symbol Left</label>
                            <input
                                    value="<?= $formData['symbol_left'] ?? ''?>"
                                    type="text" id="symbolLeft" name="symbol_left" class="form-control"
                            >
                            <?php if (!empty($errors['symbol_left'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['symbol_left'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['symbol_right']) ? 'has-error is-invalid' : '' ?>">
                            <label for="symbolRight">Symbol right</label>
                            <input
                                    value="<?= $formData['symbol_right'] ?? ''?>"
                                    type="text" id="symbolRight" name="symbol_right" class="form-control"
                            >
                            <?php if (!empty($errors['symbol_right'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['symbol_right'])?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?= isset($errors['value']) ? 'has-error is-invalid' : '' ?>">
                            <label for="valueCurrency">Value</label>
                            <input
                                    value="<?= $formData['value'] ?? ''?>"
                                    type="text" id="valueCurrency" name="value" class="form-control"
                            >
                            <?php if (!empty($errors['value'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['value'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['value']) ? 'has-error is-invalid' : '' ?>">
                            <label for="baseCurrency">Base</label>
                            <select name="base" id="baseCurrency" class="form-control custom-select">
                                <option <?= isset($formData['base']) && $formData['base'] == '0' ? 'selected' : '' ?> value="0">
                                    0
                                </option>
                                <option <?= isset($formData['base']) && $formData['base'] == '1' ? 'selected' : '' ?> value="1">
                                    1
                                </option>
                            </select>
                            <?php if (!empty($errors['base'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['base'])?>
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
