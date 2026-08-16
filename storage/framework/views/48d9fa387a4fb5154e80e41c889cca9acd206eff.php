<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">商品情報編集画面</h1>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <strong>ID:</strong> <?php echo e($product->id); ?>

        </div>

        <div class="mb-3">
            <label class="form-label">商品名 <span class="text-danger">*</span></label>
            <input type="text" name="product_name" class="form-control" value="<?php echo e(old('product_name', $product->product_name)); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">メーカー名 <span class="text-danger">*</span></label>
            <select name="company_id" class="form-select">
                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($company->id); ?>" <?php echo e(old('company_id', $product->company_id) == $company->id ? 'selected' : ''); ?>>
                        <?php echo e($company->company_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">価格 <span class="text-danger">*</span></label>
            <input type="number" name="price" class="form-control" value="<?php echo e(old('price', $product->price)); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">在庫数 <span class="text-danger">*</span></label>
            <input type="number" name="stock" class="form-control" value="<?php echo e(old('stock', $product->stock)); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">コメント</label>
            <textarea name="comment" class="form-control" rows="3"><?php echo e(old('comment', $product->comment)); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">商品画像</label><br>
            <?php if($product->img_path): ?>
                <img src="<?php echo e(asset('storage/' . $product->img_path)); ?>" alt="商品画像" width="100" class="mb-2"><br>
            <?php endif; ?>
            <input type="file" name="img_path" class="form-control">
        </div>

        <button type="submit" class="btn btn-warning">更新</button>
        <a href="<?php echo e(route('products.show', $product->id)); ?>" class="btn btn-secondary">戻る</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/akimotokeiju/Desktop/vending_machine/resources/views/products/edit.blade.php ENDPATH**/ ?>