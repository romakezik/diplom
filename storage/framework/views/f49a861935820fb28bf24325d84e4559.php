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
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Рейс: <?php echo e($flight->route->start_city); ?> - <?php echo e($flight->route->end_city); ?> - <?php echo e(\Carbon\Carbon::parse($flight->departure_datetime)); ?></h1>

        <?php $__currentLoopData = $stops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white shadow rounded-lg p-6 mb-4">
                <h2 class="text-xl font-bold mb-2">Остановка: <?php echo e($stop->stop_name); ?></h2>
                <p class="mb-2">Время прибытия: <?php echo e(\Carbon\Carbon::parse($flight->departure_datetime)->addMinutes($stop->additional_time_from_departure)->format('H:i')); ?></p>


                <h3 class="text-lg font-semibold mb-2">Билеты на вход:</h3>
                <?php $__currentLoopData = $stop->entrance_tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($ticket->flight_id == $flight->id): ?>
                        <p class="mb-1">Пользователь: <?php echo e($ticket->user->email); ?> - <?php echo e($ticket->user->phone_number); ?> - Статус: <?php echo e($ticket->status); ?> Цена: <?php echo e($ticket->price); ?> 
                            <a href="<?php echo e(route('driver.ticket.confirm', $ticket)); ?>" class="text-blue-500 hover:underline confirm-action">Подтвердить оплату</a>
                            <a href="<?php echo e(route('driver.ticket.noShow', $ticket)); ?>" class="text-red-500 hover:underline confirm-action ml-4">Подтвердить неявку</a>
                        </p>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <h3 class="text-lg font-semibold mb-2 mt-4">Билеты на выход:</h3>
                <?php $__currentLoopData = $stop->exit_tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($ticket->flight_id == $flight->id): ?>
                        <p class="mb-1">Пользователь: <?php echo e($ticket->user->email); ?> - <?php echo e($ticket->user->phone_number); ?> - Статус: <?php echo e($ticket->status); ?> Цена: <?php echo e($ticket->price); ?></p>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <script>
        document.querySelectorAll('.confirm-action').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                if (confirm('Вы уверены?')) {
                    window.location.href = event.target.href;
                }
            });
        });
    </script>
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
<?php /**PATH D:\diplom\proj\diplom\resources\views/driver/flight_users.blade.php ENDPATH**/ ?>