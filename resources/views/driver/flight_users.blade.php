<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Рейс: {{ $flight->route->start_city }} - {{ $flight->route->end_city }} - {{\Carbon\Carbon::parse($flight->departure_datetime)}}</h1>

        @foreach($stops as $stop)
            <div class="bg-white shadow rounded-lg p-6 mb-4">
                <h2 class="text-xl font-bold mb-2">Остановка: {{ $stop->stop_name }}</h2>
                <p class="mb-2">Время прибытия: {{ \Carbon\Carbon::parse($flight->departure_datetime)->addMinutes($stop->additional_time_from_departure)->format('H:i') }}</p>


                <h3 class="text-lg font-semibold mb-2">Билеты на вход:</h3>
                @foreach($stop->entrance_tickets as $ticket)
                    @if($ticket->flight_id == $flight->id)
                        <p class="mb-1">Пользователь: {{ $ticket->user->email }} - {{ $ticket->user->phone_number }} - Статус: {{ $ticket->status }} Цена: {{ $ticket->price }} 
                            <a href="{{ route('driver.ticket.confirm', $ticket) }}" class="text-blue-500 hover:underline confirm-action">Подтвердить оплату</a>
                            <a href="{{ route('driver.ticket.noShow', $ticket) }}" class="text-red-500 hover:underline confirm-action ml-4">Подтвердить неявку</a>
                        </p>
                    @endif
                @endforeach

                <h3 class="text-lg font-semibold mb-2 mt-4">Билеты на выход:</h3>
                @foreach($stop->exit_tickets as $ticket)
                    @if($ticket->flight_id == $flight->id)
                        <p class="mb-1">Пользователь: {{ $ticket->user->email }} - {{ $ticket->user->phone_number }} - Статус: {{ $ticket->status }} Цена: {{ $ticket->price }}</p>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

    <script>
        document.querySelectorAll('.confirm-action').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                if (confirm('Вы уверены?')) {
                    window.location.href = event.target.href;
                }
            });
        });
    </script>
</x-app-layout>
