@extends('layouts.app')

@section('content')
    <div class="px-5 py-10">
        <div class="mx-auto text-center text-neutral title-font text-3xl font-medium">
            <h2>Edit Profile</h2>
        </div>
    
        <div class="flex justify-center">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="w-1/2">
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
                
                <div class="form-control my-4">
                    <label for="avatar" class="label">
                        <span class="label-text">Profile Image</span>
                    </label>
                    <input type="file" id="avatar" name="avatar" class="input input-bordered w-full">
                </div>
    
                <button type="submit" class="btn btn-neutral btn-block normal-case">Update</button>
                
                <p class="mt-8">
                    <a class="link link-hover text-neutral" href="/">トップに戻る</a>
                </p>
            </form>
        </div>
    </div>
@endsection
