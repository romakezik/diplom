<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="bg-white shadow-md rounded-lg p-8">
            @if (!auth()->hasUser())
                <h2 class="text-2xl font-bold">Ваши билеты будут отображаться здесь как только вы войдете в систему!</h2>
                <hr><br>
                <h2 class="text-xl  ">Пожалуйста помните что отменить билет можно не позже часа до поездки!</h2>
            @else
            <h2 class="text-2xl font-bold">Ваши билеты!</h2>
            <hr><br>
            <h2 class="text-xl  ">Пожалуйста помните что отменить билет можно не позже часа до поездки!</h2>
            @endif
        </div>
    </div>
@if (!auth()->hasUser())
    

 
    @else    
        @foreach($tickets as $ticket)
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-2">
                <div class="bg-white shadow-md rounded-lg px-8 py-3">
                    <div class="mb-4">
                        <h3 class="text-xl font-bold">Маршрут: {{ $ticket->flight->route->start_city }} - {{ $ticket->flight->route->end_city }}</h3>
                        <hr><br>
                        <p>Время отправления: {{ $ticket->flight->departure_datetime }}</p>
                        <p>Машина: {{ $ticket->flight->car->name }}, {{ $ticket->flight->car->license_plate }}, {{ $ticket->flight->car->color }}</p>
                        <p>Водидетль: {{ $ticket->flight->driver->name }}, {{ $ticket->flight->driver->phone_number }}</p>
                        <p>Остановка отправления: {{ $ticket->entrance_stop->stop_name }} в {{ \Carbon\Carbon::parse($ticket->flight->departure_datetime)->addMinutes($ticket->entrance_stop->additional_time_from_departure)->format('H:i') }}</p>
                        <p>Остановка прибытия: {{ $ticket->exit_stop->stop_name }} в {{ \Carbon\Carbon::parse($ticket->flight->departure_datetime)->addMinutes($ticket->exit_stop->additional_time_from_departure)->format('H:i') }}</p>
                        <p>Статус: {{ $ticket->status }}</p>
                        <p>Цена билета: {{ $ticket->price }}</p>
                        
                        <form action="{{ route('user.cancelTicket', $ticket->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Подтвердите отмену брони !')">Отменить бронь</button>
                        </form>
                    </div>
                </div>                
            </div>
        @endforeach
            
@endif
    
</x-app-layout>
