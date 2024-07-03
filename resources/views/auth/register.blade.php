@extends('layouts.app')

@section('content')
    <div class="px-5 py-10">
        <div class="mx-auto text-center text-neutral title-font text-3xl font-medium">
            <h2>Sign up</h2>
        </div>
    
        <div class="flex justify-center">
                        {{-- エラーメッセージ --}}
            <form method="POST" action="{{ route('register') }}" class="w-1/2">
                @csrf
    
                <div class="form-control my-4">
                    <label for="name" class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" name="name" class="input input-bordered w-full">
                </div>
    
                <div class="form-control my-4">
                    <label for="email" class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" class="input input-bordered w-full">
                </div>
    
                <div class="form-control my-4">
                    <label for="password" class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" class="input input-bordered w-full">
                </div>
    
                <div class="form-control my-4">
                    <label for="password_confirmation" class="label">
                        <span class="label-text">Confirmation</span>
                    </label>
                    <input type="password" name="password_confirmation" class="input input-bordered w-full">
                </div>
    
                <button type="submit" class="btn btn-neutral btn-block normal-case">Sign up</button>
                
                {{-- ログインページへのリンク --}}
                <p class="mt-2">Are you a user? <a class="link link-hover text-info" href="{{ route('login') }}">Login now!</a></p>
                
                <p class="mt-8">
                    <a class="link link-hover text-neutral" href="/">トップに戻る</a>
                </p>
            </form>
        </div>
    </div>
@endsection
