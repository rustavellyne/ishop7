<div class="container">
    <div class="row centered-form m_4">
        <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please sign in</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="/user/login" >
                        <div class="form-group <?= isset($errors['login']) ? 'has-error' : '' ?>">
                            <input type="text" name="login" id="login" class="form-control input-sm" placeholder="Login" value="<?= $form['login'] ?? ''?>">
                            <?php if (!empty($errors['login'])): ?>
                                <span class="help-block">
                                    <?= implode('<br>', $errors['login'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['password']) ? 'has-error' : '' ?>">
                            <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
                            <?php if (!empty($errors['password'])): ?>
                                <span class="help-block">
                                    <?= implode('<br>', $errors['password'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <input type="submit" value="Register" class="btn btn-info btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>