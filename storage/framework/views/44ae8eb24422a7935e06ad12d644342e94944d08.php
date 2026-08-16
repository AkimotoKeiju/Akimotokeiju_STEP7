<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">商品一覧画面</h1>

    
    <form action="<?php echo e(route('products.index')); ?>" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search_name" class="form-control" placeholder="検索キーワード" value="<?php echo e(request('search_name')); ?>">
        </div>
        <div class="col-md-4">
            <select name="search_company" class="form-select">
                <option value="">メーカーを選択</option>
                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($company->id); ?>" <?php echo e(request('search_company') == $company->id ? 'selected' : ''); ?>>
                        <?php echo e($company->company_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-outline-secondary">検索</button>
        </div>
    </form>

    
    <div class="mb-3">
        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-warning">新規登録</a>
    </div>

    
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($product->id); ?></td>
                    <td>
                        <?php if($product->img_path): ?>
                            <img src="<?php echo e(asset('storage/' . $product->img_path)); ?>" alt="商品画像" width="50">
                        <?php else: ?>
                            <span>なし</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($product->product_name); ?></td>
                    <td>¥<?php echo e(number_format($product->price)); ?></td>
                    <td><?php echo e($product->stock); ?></td>
                    <td><?php echo e($product->company?->company_name ?? ''); ?></td>
                    <td>
                        <a href="<?php echo e(route('products.show', $product->id)); ?>" class="btn btn-info btn-sm">詳細</a>
                        <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('本当に削除しますか？');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/akimotokeiju/Desktop/vending_machine/resources/views/products/index.blade.php ENDPATH**/ ?>