<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <!-- Information Block -->
        <div class="bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-bold mb-4">Приветсвуем на веб-сервисе онлайн бронирования на маршрутные перевозки!</h2>
            <p>Найдите лучшие для вас билеты с нашим сервисом, начните исследование сайта прямо сейчас и отправляейтесь в путь!</p>
        </div>
        @if (!Auth::check() || Auth::user()->user_type != 3)
        @else
        <!-- Popular Tickets Block -->
        <div class="bg-gray shadow-md rounded-lg p-8 mt-4">
            <h2 class="text-2xl font-bold mb-4">Популярные маршруты</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($popularRoutes as $route)
                <div class="bg-white shadow-md rounded-lg p-8">
                    <p>
                        <a href="{{ route('ticket_search.link', ['start_city' => $route->start_city, 'end_city' => $route->end_city, 'departure_date' => now()->format('Y-m-d')]) }}">
                            {{ $route->start_city }} - {{ $route->end_city }}: от {{ $route->price }} BYN
                        </a>
                    </p>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        
        
@if (!Auth::check())
<div class="bg-white shadow-md rounded-lg p-8 mt-4">
    <h2 class="text-0.5xl font-bold mb-4">Что бы видеть рекомендации для вас пожалуйста войдите в 
   
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('систему') }}
                    </x-nav-link>.
    </h2>
</div>
@else
        <div class="bg-white shadow-md rounded-lg p-8 mt-4">
            <h2 class="text-2xl font-bold mb-4">Рекомендовано именно вам!</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($recommendedRoutes as $route)
                <div class="bg-white shadow-md rounded-lg p-8">
                    <p>
                        <a href="{{ route('ticket_search.link', ['start_city' => $route->start_city, 'end_city' => $route->end_city, 'departure_date' => now()->format('Y-m-d')]) }}">
                            {{ $route->start_city }} - {{ $route->end_city }}: от {{ $route->price }} BYN
                        </a>
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endguest
</x-app-layout>
