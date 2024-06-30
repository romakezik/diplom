<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form action="{{ route('admin.routes.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="start_city" class="block text-sm font-medium text-gray-700">Начальный город</label>
                <input type="text" id="start_city" name="start_city" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="end_city" class="block text-sm font-medium text-gray-700">Конечный город</label>
                <input type="text" id="end_city" name="end_city" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Цена</label>
                <input type="number" id="price" name="price" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="stops_count" class="block text-sm font-medium text-gray-700">Количество остановок</label>
                <input type="number" id="stops_count" name="stops_count" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div id="stops_container"></div>
            <button type="submit" class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Создать</button>
        </form>
    </div>
    
    <script>
    document.getElementById('stops_count').addEventListener('change', function(e) {
        const stopsContainer = document.getElementById('stops_container');
        stopsContainer.innerHTML = '';
        for (let i = 0; i < e.target.value; i++) {
            const div = document.createElement('div');
            div.className = 'form-group';
            const label = document.createElement('label');
            label.for = 'stops';
            label.textContent = 'Остановка ' + (i + 1);
            const inputName = document.createElement('input');
            inputName.type = 'text';
            inputName.className = 'form-control';
            inputName.id = 'stops';
            inputName.name = 'stops['+i+'][stop_name]';
            inputName.placeholder = 'Название остановки';
            inputName.required = true;
            const inputOrder = document.createElement('input');
            inputOrder.type = 'number';
            inputOrder.className = 'form-control';
            inputOrder.id = 'stops_order';
            inputOrder.name = 'stops['+i+'][stop_order_number]';
            inputOrder.placeholder = 'Порядковый номер остановки';
            inputOrder.required = true;
            const inputTime = document.createElement('input');
            inputTime.type = 'number';
            inputTime.className = 'form-control';
            inputTime.id = 'stops_time';
            inputTime.name = 'stops['+i+'][additional_time_from_departure]';
            inputTime.placeholder = 'Дополнительное время от отправления';
            inputTime.required = true;
            div.appendChild(label);
            div.appendChild(inputName);
            div.appendChild(inputOrder);
            div.appendChild(inputTime);
            stopsContainer.appendChild(div);
        }
    });
    </script>
</x-app-layout>
