<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        @if (Auth::check() && Auth::user()->user_type == 2)
            <div class="bg-white shadow-md rounded-lg p-8">
                <h2 class="text-2xl font-bold mb-4">Панель администратора</h2>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.flights.index') }}" class="btn btn-primary">Рейсы</a>
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-primary">Машины</a>
                    <a href="{{ route('admin.drivers.index') }}" class="btn btn-primary">Водители</a>
                    <a href="{{ route('admin.routes.index') }}" class="btn btn-primary">Маршруты</a>
                </div>
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg p-8 mt-4">
                <h2 class="text-2xl font-bold mb-4">У вас нет доступа к этой странице.</h2>
            </div>
        @endif
    </div>
</x-app-layout>
