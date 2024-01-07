<div class="container">
    <div class="row centered-form m_4">
        <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please sign up<small>It's free!</small></h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="/user/register" >
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group <?= isset($errors['name']) ? 'has-error' : '' ?>">
                                    <input type="text" name="name" id="first_name" class="form-control input-sm" placeholder="First Name" value="<?= $form['name'] ?? ''?>">
                                    <?php if (!empty($errors['name'])): ?>
                                        <span class="help-block">
                                            <?= implode('<br>', $errors['name'])?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group <?= isset($errors['last_name']) ? 'has-error' : '' ?>">
                                    <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" value="<?= $form['last_name'] ?? ''?>">
                                    <?php if (!empty($errors['last_name'])): ?>
                                        <span class="help-block">
                                            <?= implode('<br>', $errors['last_name'])?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group <?= isset($errors['address']) ? 'has-error' : '' ?>">
                            <input type="text" name="address" id="address" class="form-control input-sm" placeholder="Address" value="<?= $form['address'] ?? ''?>">
                            <?php if (!empty($errors['address'])): ?>
                                <span class="help-block">
                                    <?= implode('<br>', $errors['address'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['login']) ? 'has-error' : '' ?>">
                            <input type="text" name="login" id="login" class="form-control input-sm" placeholder="Login" value="<?= $form['login'] ?? ''?>">
                            <?php if (!empty($errors['login'])): ?>
                                <span class="help-block">
                                    <?= implode('<br>', $errors['login'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?>">
                            <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" value="<?= $form['email'] ?? ''?>">
                            <?php if (!empty($errors['email'])): ?>
                                <span class="help-block">
                                    <?= implode('<br>', $errors['email'])?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group <?= isset($errors['password']) ? 'has-error' : '' ?>">
                                    <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
                                    <?php if (!empty($errors['password'])): ?>
                                        <span class="help-block">
                                            <?= implode('<br>', $errors['password'])?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group <?= isset($errors['password_confirmation']) ? 'has-error' : '' ?>">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
                                    <?php if (!empty($errors['password_confirmation'])): ?>
                                        <span class="help-block">
                                            <?= implode('<br>', $errors['password_confirmation'])?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="Register" class="btn btn-info btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>