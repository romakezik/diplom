<x-app-layout>
<div class="container py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h1 class="text-2xl font-bold mb-5">Детали рейса</h1>
            <h2 class="text-xl mb-3">Маршрут: {{ $flight->route->start_city }}-{{ $flight->route->end_city }}</h2>
            <h2 class="text-xl mb-3">Время отправления {{ $flight->departure_datetime }}</h2>
            <h2 class="text-xl mb-3">Информация о машине: {{ $flight->car->name }}, {{ $flight->car->color }}, {{ $flight->car->license_plate }}</h2>
            <h2 class="text-xl mb-3">Данные водителя: {{ $flight->driver->name }}, {{ $flight->driver->phone_number }}</h2>
            <h2 class="text-xl mb-3">Остановки:</h2>
            <table class="table-auto w-full mb-6">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Название остановки</th>
                        
                        <th class="px-4 py-2">Departure Time</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($stops as $stop)
                        <tr>
                            <td class="border px-4 py-2">{{ $stop->stop_name }}</td>
                            
                            <td class="border px-4 py-2">{{ $stop->departure_time }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if (Auth::check())
                <a href="{{ route('booking.create', $flight->id) }}" class="btn btn-primary">Перейти к бронированию</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Прежде чем бронировать билет, надо авторизоваться</a>
            @endif
        </div>
    </div>
</div>
</x-app-layout>
