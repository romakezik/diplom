<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="bg-white shadow-md rounded-lg p-8">
            <form method="POST" action="{{ route('ticket_search') }}" class="grid grid-cols-6 gap-4 items-end">
                @csrf
                <div class="mb-4 col-span-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="start_city">Город отправления</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="start_city" name="start_city">
                        <option value="">Выберите город</option>
                        @foreach($start_cities as $city)
                        <option value="{{ $city->start_city }}" {{ old('start_city') == $city->start_city ? 'selected' : '' }}>
                            {{ $city->start_city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4 col-span-0 text-center">
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-0 px-0.5 rounded focus:outline-none focus:shadow-outline mb-2" onclick="swapCities()"><-></button>
                </div>
                <div class="mb-4 col-span-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="end_city">Город прибытия</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="end_city" name="end_city">
                        <option value="">Выберите город</option>
                        @foreach($end_cities as $city)
                        <option value="{{ $city->end_city }}" {{ old('end_city') == $city->end_city ? 'selected' : '' }}>
                            {{ $city->end_city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4 col-span-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="departure_date">Дата отправления</label>
                    <input type="date" id="departure_date" name="departure_date" value="{{ request('departure_date', date('Y-m-d')) }}"> </div>
                <div class="mb-4 col-span-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="passengers">Количество пассажиров</label>
                    <input type="number" id="passengers" name="passengers" value="{{ request('passengers', 1) }}">
                </div>
                <div class="col-span-1 flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-4">Поиск</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="bg-white shadow-md rounded-lg p-8">
@if(isset($flights) && !$flights->isEmpty())
<div class="mt-8">
    <h2 class="text-2xl font-bold mb-4">Результаты поиска:</h2>
    <table class="table-auto w-full mb-6">
        <thead>
            <tr>                
                <th class="px-4 py-2">Маршрут</th>                
                <th class="px-4 py-2">Время отправления</th>
                <th class="px-4 py-2">Доступно билетов</th>
            </tr>
        </thead>
        <tbody>
            @foreach($flights as $flight)
                <tr>
                    <td class="border px-4 py-2">{{ $flight->route->start_city }}-{{ $flight->route->end_city }}</td>
                    <td class="border px-4 py-2">{{ $flight->departure_datetime }}</td>
                    <td class="border px-4 py-2">{{ $flight->available_seats }}</td>
                    <td class="border px-4 py-2"><a href="{{ route('flight_details', ['id' => $flight->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Подробнее</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@elseif (isset($flights) && $flights->isEmpty())
<h1>Похоже что билетов по выбранным критериям нет.</h1>
@else 
<h1>Пожалуйста заполните форму и нажмите на кнопку поиска, найденные билеты отобразятся здесь!</h1>
@endif
        </div>
    </div>
    <script>
           function updateEndCityOptions() {
        const startCitySelect = document.getElementById('start_city');
        const endCitySelect = document.getElementById('end_city');
        const selectedStartCity = startCitySelect.value;

        // get all the options in the end city dropdown
        const endCityOptions = Array.from(endCitySelect.options);

        // remove all options from the end city select
        endCitySelect.innerHTML = '';

        // add back only the options where value is not equal to the selected start city
        for (let option of endCityOptions) {
            if (option.value !== selectedStartCity) {
                endCitySelect.appendChild(option);
            }
        }
    }

    // call the function to update the end city options whenever the start city selection changes
    document.getElementById('start_city').addEventListener('change', updateEndCityOptions);
    
        function swapCities() {
            const startCitySelect = document.getElementById('start_city');
            const endCitySelect = document.getElementById('end_city');
            const temp = startCitySelect.value;
            startCitySelect.value = endCitySelect.value;
            endCitySelect.value = temp;
        }
    </script>
</x-app-layout>
