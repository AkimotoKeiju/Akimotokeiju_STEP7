<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">商品新規登録画面</h1>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label class="form-label">商品名 <span class="text-danger">*</span></label>
            <input type="text" name="product_name" class="form-control" value="<?php echo e(old('product_name')); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">メーカー名 <span class="text-danger">*</span></label>
            <select name="company_id" class="form-select">
                <option value="">選択してください</option>
                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($company->id); ?>" <?php echo e(old('company_id') == $company->id ? 'selected' : ''); ?>>
                        <?php echo e($company->company_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">価格 <span class="text-danger">*</span></label>
            <input type="number" name="price" class="form-control" value="<?php echo e(old('price')); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">在庫数 <span class="text-danger">*</span></label>
            <input type="number" name="stock" class="form-control" value="<?php echo e(old('stock')); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">コメント</label>
            <textarea name="comment" class="form-control" rows="3"><?php echo e(old('comment')); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">商品画像</label>
            <input type="file" name="img_path" class="form-control">
        </div>

        <button type="submit" class="btn btn-warning">新規登録</button>
        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-secondary">戻る</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/akimotokeiju/Desktop/vending_machine/resources/views/products/create.blade.php ENDPATH**/ ?>