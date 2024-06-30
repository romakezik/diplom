<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Мои рейсы</h1>

        <form method="GET" action="{{ route('driver.flights') }}" class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">Дата:</label>
            <input type="date" name="date" value="{{ request('date') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            <button type="submit" class="mt-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Поиск</button>
        </form>

        @foreach($flights as $flight)
            <div class="bg-white shadow rounded-lg p-6 mb-4">
                <h2 class="text-xl font-bold mb-2">{{ $flight->route->start_city }} - {{ $flight->route->end_city }}</h2>
                <p class="mb-2">Отправление: {{ \Carbon\Carbon::parse($flight->departure_datetime)->format('d.m.Y H:i') }}</p>
                <a href="{{ route('driver.flight.users', $flight) }}" class="text-blue-500 hover:underline">Просмотр пользователей</a>
            </div>
        @endforeach
    </div>
</x-app-layout>
