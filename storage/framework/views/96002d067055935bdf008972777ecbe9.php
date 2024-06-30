<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<div class="container py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h1 class="text-2xl font-bold mb-5">Детали рейса</h1>
            <h2 class="text-xl mb-3">Маршрут: <?php echo e($flight->route->start_city); ?>-<?php echo e($flight->route->end_city); ?></h2>
            <h2 class="text-xl mb-3">Время отправления <?php echo e($flight->departure_datetime); ?></h2>
            <h2 class="text-xl mb-3">Информация о машине: <?php echo e($flight->car->name); ?>, <?php echo e($flight->car->color); ?>, <?php echo e($flight->car->license_plate); ?></h2>
            <h2 class="text-xl mb-3">Данные водителя: <?php echo e($flight->driver->name); ?>, <?php echo e($flight->driver->phone_number); ?></h2>
            <h2 class="text-xl mb-3">Остановки:</h2>
            <table class="table-auto w-full mb-6">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Название остановки</th>
                        
                        <th class="px-4 py-2">Departure Time</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $stops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo e($stop->stop_name); ?></td>
                            
                            <td class="border px-4 py-2"><?php echo e($stop->departure_time); ?></td>
                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
            <?php if(Auth::check()): ?>
                <a href="<?php echo e(route('booking.create', $flight->id)); ?>" class="btn btn-primary">Перейти к бронированию</a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">Прежде чем бронировать билет, надо авторизоваться</a>
            <?php endif; ?>
        </div>
    </div>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH D:\diplom\proj\diplom\resources\views/flight_details.blade.php ENDPATH**/ ?>