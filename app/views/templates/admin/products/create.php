<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $page['title'] ?? 'Product Create'?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item">Catalog</li>
                    <li class="breadcrumb-item active">Product</li>
                    <li class="breadcrumb-item active"><?= $page['breadcrumb'] ?? 'Create'?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- TODO: rewrite traverse TREE-->
<style>
    .product-admin-registered-form .error.invalid-feedback {
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
                    <form class="card-body product-admin-registered-form" method="post" enctype="multipart/form-data">

                        <?php if (isset($formData['id'])): ?>
                        <input
                            value="<?= $formData['id'] ?? ''?>"
                            type="text" name="id" class="form-control" hidden
                        >
                        <?php endif; ?>

                        <div class="form-group <?= isset($errors['title']) ? 'has-error is-invalid' : '' ?>">
                            <label for="productName">Title</label>
                            <input
                                value="<?= $formData['title'] ?? ''?>"
                                type="text" id="productName" name="title" class="form-control" required
                            >
                            <?php if (!empty($errors['title'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['title'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['keywords']) ? 'has-error is-invalid' : '' ?>">
                            <label for="productKeywords">Keywords</label>
                            <input
                                value="<?= $formData['keywords'] ?? ''?>"
                                type="text" id="productKeywords" name="keywords" class="form-control"
                            >
                            <?php if (!empty($errors['keywords'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['keywords'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['description']) ? 'has-error is-invalid' : '' ?>">
                            <label for="productDescription">Description</label>
                            <textarea
                                id="productDescription" name="description" class="form-control"
                                rows="3"
                            >
                                <?= $formData['description'] ?? ''?>
                            </textarea>
                            <?php if (!empty($errors['description'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['description'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['content']) ? 'has-error is-invalid' : '' ?>">
                            <label for="productContent">Content</label>
                            <textarea
                                    id="productContent" name="content" class="form-control"
                                    rows="5"
                            >
                                <?= $formData['content'] ?? ''?>
                            </textarea>
                            <?php if (!empty($errors['content'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['content'])?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?= isset($errors['price']) ? 'has-error is-invalid' : '' ?>">
                            <label for="productPrice">Price</label>
                            <input
                                value="<?= $formData['price'] ?? ''?>"
                                type="number" min="0.00" step="0.01"
                                id="productPrice" name="price" class="form-control" required
                            >
                            <?php if (!empty($errors['price'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['price'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group <?= isset($errors['old_price']) ? 'has-error is-invalid' : '' ?>">
                            <label for="productOldPrice">Old Price</label>
                            <input
                                    value="<?= $formData['old_price'] ?? ''?>"
                                    type="number" min="0.00" step="0.01"
                                    id="productOldPrice" name="old_price" class="form-control"
                            >
                            <?php if (!empty($errors['old_price'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['old_price'])?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($categories)): ?>
                            <div class="form-group <?= isset($errors['category_id']) ? 'has-error is-invalid' : '' ?>">
                                <label for="productCategory">Category</label>
                                <select id="productCategory" class="form-control custom-select" name="category_id" required>
                                    <option <?= isset($formData['category_id']) && $formData['category_id'] == '' ? 'selected' : '' ?> selected="" disabled="" value="">Select one</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option <?= isset($formData['category_id']) && $formData['category_id'] == $category->id ? 'selected' : '' ?> value="<?= $category->id ?>">
                                            <?= $category->title ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($brands)): ?>
                        <div class="form-group <?= isset($errors['brand_id']) ? 'has-error is-invalid' : '' ?>">
                            <label for="productBrand">Brands</label>
                            <select id="productBrand" class="form-control custom-select" name="brand_id" required>
                                <option <?= isset($formData['brand_id']) && $formData['brand_id'] == '' ? 'selected' : '' ?> selected="" disabled="" value="">Select one</option>
                                <?php foreach ($brands as $brand): ?>
                                    <option <?= isset($formData['brand_id']) && $formData['brand_id'] == $brand->id ? 'selected' : '' ?> value="<?= $brand->id ?>">
                                        <?= $brand->title ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($statuses)): ?>
                            <div class="form-group <?= isset($errors['status']) ? 'has-error is-invalid' : '' ?>">
                                <label for="productStatus">Status</label>
                                <select id="productStatus" class="form-control custom-select" name="status" required>
                                    <option <?= isset($formData['status']) && $formData['status'] == '' ? 'selected' : '' ?> selected="" disabled="" value="">Select one</option>
                                    <?php foreach ($statuses as $key => $status): ?>
                                        <option <?= isset($formData['status']) && $formData['status'] == $key ? 'selected' : '' ?> value="<?=$key ?>">
                                            <?= $status ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>
                        <div class="form-group <?= isset($errors['hit']) ? 'has-error is-invalid' : '' ?>">
                            <label for="productHit">Hit</label>
                            <input
                                type="checkbox"
                                <?= isset($formData['hit']) && $formData['hit'] ? 'checked' : '' ?>
                                id="productHit" name="hit" class=""
                            >
                            <?php if (!empty($errors['hit'])): ?>
                                <span class="help-block error invalid-feedback">
                                    <?= implode('<br>', $errors['hit'])?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($attributes)): ?>
                        <div class="card">
                            <div class="card-header d-flex p-0">

                                <ul class="nav nav-pills p-2">
                                    <?php foreach ($attributes as $key => $attribute): ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?= $key === 1 ? 'active' : ''?>" href="#tab_<?= $attribute['group']['group_id'] ?>" data-toggle="tab"><?= $attribute['group']['group_title'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <h3 class="card-title p-3 ml-auto" >Attributes</h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <?php foreach ($attributes as $key => $group): ?>
                                    <div class="tab-pane <?= $key === 1 ? 'active' : ''?>" id="tab_<?= $group['group']['group_id'] ?>">
                                        <?php foreach ($group['attributes'] as $attribute): ?>
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    id ="attr_<?= $attribute['attr_id'] ?>"
                                                    type="radio"
                                                    name="group[<?= $group['group']['group_id'] ?>]"
                                                    <?= in_array($attribute['attr_id'], $productAttributes) ? 'checked' : ''?>
                                                    value="<?= $attribute['attr_id'] ?>"
                                                >
                                                <label class="form-check-label" for="attr_<?= $attribute['attr_id'] ?>"><?= $attribute['attribute_title'] ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
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
<script>
  window.onload = function () {
    $('#productContent').summernote();
  }
</script>
