<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <h1 class="text-2xl font-bold mb-4">Редактировать машину</h1>
        <form method="POST" action="{{ route('admin.cars.update', $car) }}" class="bg-white shadow-md rounded-lg p-8">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Название</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" value="{{ $car->name }}" required>
            </div>
            <div class="mb-4">
                <label for="color" class="block text-gray-700 text-sm font-bold mb-2">Цвет</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="color" name="color" value="{{ $car->color }}" required>
            </div>
            <div class="mb-4">
                <label for="license_plate" class="block text-gray-700 text-sm font-bold mb-2">Номерной знак</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="license_plate" name="license_plate" value="{{ $car->license_plate }}" required>
            </div>
            <div class="mb-4">
                <label for="number_of_passenger_seats" class="block text-gray-700 text-sm font-bold mb-2">Количество пассажирских мест</label>
                <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="number_of_passenger_seats" name="number_of_passenger_seats" value="{{ $car->number_of_passenger_seats }}" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Обновить машину</button>
        </form>
    </div>
</x-app-layout>
