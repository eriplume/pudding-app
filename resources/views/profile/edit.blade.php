@extends('layouts.app')

@section('content')
    <div class="prose mx-auto text-center">
        <h2>Update Profile</h2>
        @include('components.error_messages')
        @include('components.success_message')
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('profile.update') }}" class="w-1/2">
            @csrf
            @method('patch')

            <div class="form-control my-4">
                <label for="email" class="label">
                    <span class="label-text">Name</span>
                </label>
                <input type="text" id="name" name="name" class="input input-bordered w-full" value="{{ old('name', $user->name) }}" required>
            </div>
            
            <div class="form-control my-4">
                <label for="email" class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" id="email" name="email" class="input input-bordered w-full" value="{{ old('email', $user->email) }}" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block normal-case">Update</button>
        </form>
    </div>
@endsection
