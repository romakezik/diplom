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
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="bg-white shadow-md rounded-lg p-8">
            <?php if(!auth()->hasUser()): ?>
                <h2 class="text-2xl font-bold">Ваши билеты будут отображаться здесь как только вы войдете в систему!</h2>
                <hr><br>
                <h2 class="text-xl  ">Пожалуйста помните что отменить билет можно не позже часа до поездки!</h2>
            <?php else: ?>
            <h2 class="text-2xl font-bold">Ваши билеты!</h2>
            <hr><br>
            <h2 class="text-xl  ">Пожалуйста помните что отменить билет можно не позже часа до поездки!</h2>
            <?php endif; ?>
        </div>
    </div>
<?php if(!auth()->hasUser()): ?>
    

 
    <?php else: ?>    
        <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-2">
                <div class="bg-white shadow-md rounded-lg px-8 py-3">
                    <div class="mb-4">
                        <h3 class="text-xl font-bold">Маршрут: <?php echo e($ticket->flight->route->start_city); ?> - <?php echo e($ticket->flight->route->end_city); ?></h3>
                        <hr><br>
                        <p>Время отправления: <?php echo e($ticket->flight->departure_datetime); ?></p>
                        <p>Машина: <?php echo e($ticket->flight->car->name); ?>, <?php echo e($ticket->flight->car->license_plate); ?>, <?php echo e($ticket->flight->car->color); ?></p>
                        <p>Водидетль: <?php echo e($ticket->flight->driver->name); ?>, <?php echo e($ticket->flight->driver->phone_number); ?></p>
                        <p>Остановка отправления: <?php echo e($ticket->entrance_stop->stop_name); ?> в <?php echo e(\Carbon\Carbon::parse($ticket->flight->departure_datetime)->addMinutes($ticket->entrance_stop->additional_time_from_departure)->format('H:i')); ?></p>
                        <p>Остановка прибытия: <?php echo e($ticket->exit_stop->stop_name); ?> в <?php echo e(\Carbon\Carbon::parse($ticket->flight->departure_datetime)->addMinutes($ticket->exit_stop->additional_time_from_departure)->format('H:i')); ?></p>
                        <p>Статус: <?php echo e($ticket->status); ?></p>
                        <p>Цена билета: <?php echo e($ticket->price); ?></p>
                        
                        <form action="<?php echo e(route('user.cancelTicket', $ticket->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Подтвердите отмену брони !')">Отменить бронь</button>
                        </form>
                    </div>
                </div>                
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
<?php endif; ?>
    
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
<?php /**PATH D:\diplom\proj\diplom\resources\views/user/tickets.blade.php ENDPATH**/ ?>