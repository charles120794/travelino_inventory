@extends('main.layouts.loginapp',['nav_tab' => 'login'])

@section('content')

<section class="bg-gray-100 lg:p-20 h-screen">
    <form action="{{ url('login') }}" method="post"> @csrf
        <div class="container bg-white border mx-auto px-4 py-10 max-w-md rounded shadow">
            <div class="border-gray-400 focus-within:border-teal-500 py-2 mb-5">
                <h1 class="font-bold text-teal-800 text-lg text-center">Login to start your session</h1>
            </div>
            <div class="block border-b-2 border-gray-400 focus-within:border-teal-500 py-2 mb-5">
                <input type="text" class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none" name="personal_email" value="{{ old('personal_email') }}" placeholder="E-mail address">
                @error('personal_email')
                <span class="text-red-700 px-2 text-sm font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="block border-b-2 border-gray-400 focus-within:border-teal-500 py-2">
                <input type="password" class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none" name="password" value="{{ old('password') }}" placeholder="Password">
                @error('password')
                <span class="text-red-700 px-2 text-sm font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="block border-b-2 border-gray-400 focus-within:border-teal-500 py-3 px-2">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label text-teal-600" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <div class="text-right pt-4 pb-4 mt-4">
                <button type="submit" class="w-full focus:shadow-outline focus:outline-none bg-teal-700 hover:bg-teal-700 border-teal-700 hover:border-teal-700 text-sm border-4 text-white py-2 px-3 rounded font-medium">
                    Login
                </button>
            </div>
        </div>
    </form>
</section>

@endsection