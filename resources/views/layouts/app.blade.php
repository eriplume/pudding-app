<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Microposts</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite('resources/css/app.css')
    </head>

    <body class="bg-amber-50 h-full min-h-screen">
        {{-- ナビゲーションバー --}}
        @include('layouts.navigation')
        
        <div class="container mx-auto">
            @if(session('message'))
                <div role="alert" class="alert alert-success mt-6" id="FlashMessage">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('message') }}</span>
                </div>
            @endif
        
            <div class="mt-6">        
                @include('components.error_messages')
            </div>

            @yield('content')
        </div>
    </body>
</html>