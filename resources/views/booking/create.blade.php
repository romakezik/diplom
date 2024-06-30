<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Бронирование билета на рейс {{ $flight->id }}</h1>

        <form action="{{ route('booking.store', $flight->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="entrance_stop_id">Остановка отправления</label>
                <select name="entrance_stop_id" id="entrance_stop_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" onchange="updateExitStops()">
                    @foreach($flight->route->stops as $stop)
                        <option value="{{ $stop->id }}" data-order="{{ $stop->stop_order_number }}">{{ $stop->stop_name }} ({{ $stop->additional_time_from_departure }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="exit_stop_id">Остановка прибытия</label>
                <select name="exit_stop_id" id="exit_stop_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" onchange="updateExitStops(); updatePrice();">
                    @foreach($flight->route->stops as $stop)
                        <option value="{{ $stop->id }}" data-order="{{ $stop->stop_order_number }}">{{ $stop->stop_name }} ({{ $stop->additional_time_from_departure }})</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Цена билета</label>
                <input type="text" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="passengers">Количество пассажиров</label>
                <input type="number" name="passengers" id="passengers" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="1" max="{{ $flight->available_seats }}">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Бронировать</button>
            </div>
        </form>
    </div>
</x-app-layout>
    
    <script>
    function updateExitStops() {
        var entranceStop = document.getElementById('entrance_stop_id');
        var exitStop = document.getElementById('exit_stop_id');
        var entranceOrder = entranceStop.options[entranceStop.selectedIndex].getAttribute('data-order');
    
        for (var i = 0; i < exitStop.options.length; i++) {
            var exitOrder = exitStop.options[i].getAttribute('data-order');
            if (exitOrder <= entranceOrder) {
                exitStop.options[i].disabled = true;
            } else {
                exitStop.options[i].disabled = false;
            }
        }
    }

    
    function updatePrice() {
    var entranceStop = document.getElementById('entrance_stop_id');
    var exitStop = document.getElementById('exit_stop_id');

        if (entranceStop.value && exitStop.value) {
            fetch('/calculate-price/{{ $flight->id }}?entrance_stop_id=' + entranceStop.value + '&exit_stop_id=' + exitStop.value)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        document.getElementById('price').value = data.price;
                    }
                });
        }
    }
</script>
    