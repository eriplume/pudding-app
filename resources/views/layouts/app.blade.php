<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Microposts</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite('resources/css/app.css')
    </head>

    <body>

        {{-- ナビゲーションバー --}}
        @include('layouts.navigation')
        
        <div class="container mx-auto">
            
            @if(session('message'))
                <div role="alert" class="alert" id="FlashMessage">
                     <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        class="stroke-info h-6 w-6 shrink-0">
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                     </svg>
                     <span>{{ session('message') }}</span>
                </div>
            @endif
            
            @include('components.error_messages')

            @yield('content')
        </div>

    </body>
</html>