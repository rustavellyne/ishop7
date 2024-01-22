<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $page['title'] ?? 'Users Create'?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Users</li>
                    <li class="breadcrumb-item active"><?= $page['breadcrumb'] ?? 'Create'?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- TODO: rewrite traverse TREE-->
<style>
    .user-admin-registered-form .error.invalid-feedback {
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
                    <form class="card-body user-admin-registered-form" method="post">
                        <?php if (isset($form['user_id'])): ?>
                        <input
                                value="<?= $form['user_id'] ?? ''?>"
                                type="text" name="user_id" class="form-control" hidden
                        >
                        <?php endif; ?>
                        <div class="form-group <?= isset($errors['name']) ? 'has-error is-invalid' : '' ?>">
                            <label for="userName">Name</label>
                            <input
                                value="<?= $form['name'] ?? ''?>"
                                type="text" id="userName" name="name" class="form-control" required
                            >
                            <?php if (!empty($errors['name'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['name'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['email']) ? 'has-error is-invalid' : '' ?>">
                            <label for="userEmail">Email</label>
                            <input
                                value="<?= $form['email'] ?? ''?>"
                                type="email" id="userEmail" name="email" class="form-control" required
                            >
                            <?php if (!empty($errors['email'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['email'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['login']) ? 'has-error is-invalid' : '' ?>">
                            <label for="userLogin">Login</label>
                            <input
                                value="<?= $form['login'] ?? ''?>"
                                type="text" id="userLogin" name="login" class="form-control" required
                            >
                            <?php if (!empty($errors['login'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['login'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['address']) ? 'has-error is-invalid' : '' ?>">
                            <label for="userAddress">Address</label>
                            <input
                                value="<?= $form['address'] ?? ''?>"
                                type="text" id="userAddress" name="address" class="form-control" required
                            >
                            <?php if (!empty($errors['address'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['address'])?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?= isset($errors['password']) ? 'has-error is-invalid' : '' ?>">
                            <label for="userPassword">Password</label>
                            <input
                                value="<?= $form['password'] ?? ''?>"
                                type="password" id="userPassword" name="password" class="form-control" <?= $page['pass_not_required'] ? '' : 'required'?>
                            >
                            <?php if (!empty($errors['password'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['password'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['password_confirmation']) ? 'has-error is-invalid' : '' ?>">
                            <label for="userRePassword">Retype Password</label>
                            <input
                                value="<?= $form['password_confirmation'] ?? ''?>"
                                type="password" id="userRePassword" name="password_confirmation" class="form-control" <?= $page['pass_not_required'] ? '' : 'required'?>
                            >
                            <?php if (!empty($errors['password_confirmation'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['password_confirmation'])?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?= isset($errors['role']) ? 'has-error is-invalid' : '' ?>">
                            <label for="userRole">Role</label>
                            <select id="userRole" class="form-control custom-select" name="role" required>
                                <option <?= $form['role'] == '' ? 'selected' : '' ?> selected="" disabled="">Select one</option>
                                <option <?= $form['role'] == 'user' ? 'selected' : '' ?> value="user">User</option>
                                <option <?= $form['role'] == 'admin' ? 'selected' : '' ?> value="admin">Admin</option>
                            </select>
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
