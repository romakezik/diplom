<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form action="{{ route('admin.flights.update', $flight->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="route_id" class="block text-sm font-medium text-gray-700">Маршрут</label>
                <select class="form-select mt-1 block w-full" id="route_id" name="route_id" required>
                    @foreach ($routes as $route)
                    <option value="{{ $route->id }}" {{ $flight->route_id == $route->id ? 'selected' : '' }}>{{ $route->start_city }} - {{ $route->end_city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="car_id" class="block text-sm font-medium text-gray-700">Автомобиль</label>
                <select class="form-select mt-1 block w-full" id="car_id" name="car_id" required>
                    @foreach ($cars as $car)
                    <option value="{{ $car->id }}" data-seats="{{ $car->number_of_passenger_seats }}" {{ $flight->car_id == $car->id ? 'selected' : '' }}>{{ $car->name }} - {{ $car->license_plate }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="driver_id" class="block text-sm font-medium text-gray-700">Водитель</label>
                <select class="form-select mt-1 block w-full" id="driver_id" name="driver_id" required>
                    @foreach ($drivers as $driver)
                    <option value="{{ $driver->id }}" {{ $flight->driver_id == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="departure_datetime" class="block text-sm font-medium text-gray-700">Дата и время отправления</label>
                <input type="datetime-local" class="form-input mt-1 block w-full" id="departure_datetime" name="departure_datetime" value="{{ \Carbon\Carbon::parse($flight->departure_datetime)->format('Y-m-d\TH:i') }}" required>
            </div>
            <div class="mb-4">
                <label for="available_seats" class="block text-sm font-medium text-gray-700">Доступные места</label>
                <input type="number" class="form-input mt-1 block w-full" id="available_seats" name="available_seats" value="{{ $flight->available_seats }}" required>
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
</x-app-layout>
