<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form action="{{ route('admin.routes.update', $route) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="start_city" class="block text-sm font-medium text-gray-700">Начальный город</label>
                <input type="text" id="start_city" name="start_city" value="{{ $route->start_city }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="end_city" class="block text-sm font-medium text-gray-700">Конечный город</label>
                <input type="text" id="end_city" name="end_city" value="{{ $route->end_city }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Цена</label>
                <input type="number" id="price" name="price" value="{{ $route->price }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            @foreach ($route->stops as $index => $stop)
            <div class="mb-4">
                <label for="stops" class="block text-sm font-medium text-gray-700">Остановка {{ $index + 1 }}</label>
                <input type="text" id="stops" name="stops[{{ $index }}][stop_name]" value="{{ $stop->stop_name }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <input type="number" id="stops_order" name="stops[{{ $index }}][stop_order_number]" value="{{ $stop->stop_order_number }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <input type="number" id="stops_time" name="stops[{{ $index }}][additional_time_from_departure]" value="{{ $stop->additional_time_from_departure }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            @endforeach
            <button type="submit" class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Обновить</button>
        </form>
    </div>
</x-app-layout>
