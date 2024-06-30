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
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form action="<?php echo e(route('admin.flights.update', $flight->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-4">
                <label for="route_id" class="block text-sm font-medium text-gray-700">Маршрут</label>
                <select class="form-select mt-1 block w-full" id="route_id" name="route_id" required>
                    <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($route->id); ?>" <?php echo e($flight->route_id == $route->id ? 'selected' : ''); ?>><?php echo e($route->start_city); ?> - <?php echo e($route->end_city); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="car_id" class="block text-sm font-medium text-gray-700">Автомобиль</label>
                <select class="form-select mt-1 block w-full" id="car_id" name="car_id" required>
                    <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($car->id); ?>" data-seats="<?php echo e($car->number_of_passenger_seats); ?>" <?php echo e($flight->car_id == $car->id ? 'selected' : ''); ?>><?php echo e($car->name); ?> - <?php echo e($car->license_plate); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="driver_id" class="block text-sm font-medium text-gray-700">Водитель</label>
                <select class="form-select mt-1 block w-full" id="driver_id" name="driver_id" required>
                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($driver->id); ?>" <?php echo e($flight->driver_id == $driver->id ? 'selected' : ''); ?>><?php echo e($driver->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="departure_datetime" class="block text-sm font-medium text-gray-700">Дата и время отправления</label>
                <input type="datetime-local" class="form-input mt-1 block w-full" id="departure_datetime" name="departure_datetime" value="<?php echo e(\Carbon\Carbon::parse($flight->departure_datetime)->format('Y-m-d\TH:i')); ?>" required>
            </div>
            <div class="mb-4">
                <label for="available_seats" class="block text-sm font-medium text-gray-700">Доступные места</label>
                <input type="number" class="form-input mt-1 block w-full" id="available_seats" name="available_seats" value="<?php echo e($flight->available_seats); ?>" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Обновить</button>
        </form>
    </div>
    <script>
        document.getElementById('car_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            document.getElementById('available_seats').value = selectedOption.getAttribute('data-seats');
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
<?php /**PATH D:\diplom\proj\diplom\resources\views/admin/flights/edit.blade.php ENDPATH**/ ?>