<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <h1 class="text-2xl font-bold mb-4">Машины</h1>
        <a href="{{ route('admin.cars.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Добавить машину</a>
        <div class="bg-white shadow-md rounded-lg p-8 mt-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Цвет</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Номерной знак</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Количество пассажирских мест</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($cars as $car)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $car->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $car->color }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $car->license_plate }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $car->number_of_passenger_seats }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.cars.edit', $car) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">Редактировать</a>
                                <form method="POST" action="{{ route('admin.cars.delete', $car) }}" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
