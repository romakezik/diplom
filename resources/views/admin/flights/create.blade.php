<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form action="{{ route('admin.flights.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-8">
            @csrf
            <div class="mb-4">
                <label for="route_id" class="block text-gray-700 text-sm font-bold mb-2">Маршрут</label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="route_id" name="route_id" required>
                    @foreach ($routes as $route)
                    <option value="{{ $route->id }}">{{ $route->start_city }} - {{ $route->end_city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="car_id" class="block text-gray-700 text-sm font-bold mb-2">Автомобиль</label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="car_id" name="car_id" required>
                    @foreach ($cars as $car)
                    <option value="{{ $car->id }}" data-seats="{{ $car->number_of_passenger_seats }}">{{ $car->name }} - {{ $car->license_plate }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="driver_id" class="block text-gray-700 text-sm font-bold mb-2">Водитель</label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="driver_id" name="driver_id" required>
                    @foreach ($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="departure_datetime" class="block text-gray-700 text-sm font-bold mb-2">Дата и время отправления</label>
                <input type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="departure_datetime" name="departure_datetime" required>
            </div>
            <div class="mb-4">
                <label for="available_seats" class="block text-gray-700 text-sm font-bold mb-2">Доступные места</label>
                <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="available_seats" name="available_seats" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Создать</button>
        </form>
    </div>
    <script>
        document.getElementById('car_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            document.getElementById('available_seats').value = selectedOption.getAttribute('data-seats');
        });
    </script>
</x-app-layout>
