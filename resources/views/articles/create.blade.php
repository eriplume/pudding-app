@extends('layouts.app')

@section('content')
    <div class="prose mx-auto text-center">
        <h2>New</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data" class="w-1/2">
            @csrf

            <div class="form-control my-4">
                <label for="title" class="label">
                    <div class='flex'>
                        <span class="label-text">Title</span>
                        <span class="label-text text-red-300 ml-1">※</span>
                    </div>
                </label>
                <input type="text" name="title" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="type_id" class="label">
                    <div class='flex'>
                        <span class="label-text">Type</span>
                        <span class="label-text text-red-300 ml-1">※</span>
                    </div>
                </label>
                <select name="type_id" class="select select-bordered w-full">
                  @foreach(config('pudding_types') as $type_id => $name)
                    <option value="{{ $type_id }}" {{ old('type_id') === $type_id ? "selected" : ""}}>{{ $name }}</option>
                  @endforeach
                </select>
            </div>
            
            <div class="form-control my-4">
                <label for="shop" class="label">
                    <div class='flex'>
                        <span class="label-text">Shop name</span>
                        <span class="label-text text-red-300 ml-1">※</span>
                    </div>
                </label>
                <input type="text" name="shop" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="pref_id" class="label">
                    <div class='flex'>
                        <span class="label-text">Prefecture</span>
                        <span class="label-text text-red-300 ml-1">※</span>
                    </div>
                </label>
                <select name="pref_id" class="select select-bordered w-full">
                  @foreach(config('pref') as $pref_id => $name)
                    <option value="{{ $pref_id }}" {{ old('pref_id') === $pref_id ? "selected" : ""}}>{{ $name }}</option>
                  @endforeach
                </select>
            </div>
            
            <div class="form-control my-4">
                <label for="address" class="label">
                    <span class="label-text">Address</span>
                </label>
                <input type="text" name="address" class="input input-bordered w-full" placeholder="市町村以降の住所">
            </div>
            
            <div class="form-control my-4">
                <label for="content" class="label">
                    <span class="label-text">Comment</span>
                </label>
                <textarea class="textarea textarea-bordered" name="content"></textarea>
            </div>
            
            <div class="form-control my-4">
                <label for="image" class="label">
                    <div class='flex'>
                        <span class="label-text">Photo</span>
                        <span class="label-text text-red-300 ml-1">※</span>
                    </div>
                </label>
                <input type="file" id="image" name="image" class="input input-bordered w-full">
            </div>

            <button type="submit" class="btn btn-primary btn-block normal-case">投稿する</button>
        </form>
    </div>
@endsection