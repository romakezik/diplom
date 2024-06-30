<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <h1 class="text-2xl font-bold mb-4">Рейсы</h1>
        <a href="{{ route('admin.flights.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Создать рейс</a>
        
        <!-- Search Form -->
        <form action="{{ route('admin.flights.index') }}" method="GET" class="mt-4 bg-gray-200 p-4 rounded">

            <div class="flex space-x-4">
                <div>
                    <label for="start_city" class="block text-sm font-medium text-gray-700">Город отправления</label>
                    <select name="start_city" id="start_city" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Выберите город отправления</option>
                        @foreach ($start_cities as $city)
                        <option value="{{ $city->start_city }}">{{ $city->start_city }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="end_city" class="block text-sm font-medium text-gray-700">Город прибытия</label>
                    <select name="end_city" id="end_city" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Выберите город прибытия</option>
                        @foreach ($end_cities as $city)
                        <option value="{{ $city->end_city }}">{{ $city->end_city }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="departure_date" class="block text-sm font-medium text-gray-700">Дата отправления</label>
                    <input type="date" name="departure_date" id="departure_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                    <div class="self-end">
                     <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Поиск</button>
                    </div>
                </div>
             </form>
             <div class="bg-white shadow-md rounded-lg p-8 mt-4">
        <!-- Flights Table -->
        <table class="min-w-full divide-y divide-gray-200 mt-4">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Город отправления</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Город прибытия</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата отправления</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($flights as $flight)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $flight->route->start_city }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $flight->route->end_city }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $flight->departure_datetime }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <a href="{{ route('admin.flights.edit', $flight->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">Редактировать</a>
                        <form action="{{ route('admin.flights.destroy', $flight->id) }}" method="POST" class="inline-block">
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
