@extends('main.layouts.app')

@section('content')

<section class="bg-gray-100">
    <form action="{{ url('login') }}" method="post"> @csrf
        <div class="container bg-gray-100 mx-auto p-4 max-w-md rounded mt-2">
            <div class="border-gray-400 focus-within:border-teal-500 py-2 mb-5">
                <h1 class="font-bold text-teal-700 text-center">Login to start Session</h1>
            </div>
            <div class="block border-b-2 border-gray-400 focus-within:border-teal-500 py-2 mb-5">
                <input type="text" class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none" name="email" value="{{ old('email') }}" placeholder="E-mail address">
                @error('email')
                <span class="glyphicon glyphicon-envelope form-control-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="block border-b-2 border-gray-400 focus-within:border-teal-500 py-2">
                <input type="password" class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none" name="password" value="{{ old('password') }}" placeholder="Password">
                @error('password')
                <span class="glyphicon glyphicon-envelope form-control-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="text-right pt-4 pb-4 mt-4">
                <button type="submit" class="w-full focus:shadow-outline focus:outline-none bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
                    Login
                </button>
            </div>
        </div>
    </form>
</section>

@endsection