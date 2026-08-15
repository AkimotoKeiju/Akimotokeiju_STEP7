<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">商品情報詳細画面</h1>

    <div class="mb-3">
        <strong>ID:</strong> <?php echo e($product->id); ?>

    </div>
    <div class="mb-3">
        <strong>商品画像:</strong><br>
        <?php if($product->img_path): ?>
            <img src="<?php echo e(asset('storage/' . $product->img_path)); ?>" alt="商品画像" width="150">
        <?php else: ?>
            <span>なし</span>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <strong>商品名:</strong> <?php echo e($product->product_name); ?>

    </div>
    <div class="mb-3">
        <strong>メーカー:</strong> <?php echo e($product->company->company_name ?? ''); ?>

    </div>
    <div class="mb-3">
        <strong>価格:</strong> ¥<?php echo e(number_format($product->price)); ?>

    </div>
    <div class="mb-3">
        <strong>在庫数:</strong> <?php echo e($product->stock); ?>

    </div>
    <div class="mb-3">
        <strong>コメント:</strong> <?php echo e($product->comment); ?>

    </div>

    <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="btn btn-warning">編集</a>
    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">戻る</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/akimotokeiju/Desktop/vending_machine/resources/views/products/show.blade.php ENDPATH**/ ?>