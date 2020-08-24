@extends('main.layouts.app',['nav_tab' => 'register'])

@section('content')

<section class="bg-gray-100 lg:p-20">
    <form action="{{ route('register') }}" method="post"> @csrf
        <div class="container bg-white border mx-auto px-4 py-10 max-w-lg rounded shadow">
            <div class="border-gray-400 focus-within:border-teal-500 py-2 mb-5">
                <h1 class="font-bold text-teal-800 text-lg text-center">Register new account</h1>
            </div>
            <div class="block flex border-b-2 border-gray-400 focus-within:border-teal-500 py-2 mb-5">
                <input type="text" class="appearance-none bg-transparent flex-1 w-full border-none inline-block text-gray-700 py-1 px-2 leading-tight focus:outline-none" name="firstname" value="{{ old('firstname') }}" placeholder="Firstname" autocomplete="off" autofocus>
                <input type="text" class="appearance-none bg-transparent flex-1 w-full border-none inline-block text-gray-700 py-1 px-2 ml-1 leading-tight focus:outline-none" name="lastname" value="{{ old('lastname') }}" placeholder="Lastname" autocomplete="off">
                @error('firstname')
                <span class="text-red-700 px-2 text-sm font-medium">{{ $message }}</span>
                @enderror
                @error('lastname')
                <span class="text-red-700 px-2 text-sm font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="block border-b-2 border-gray-400 focus-within:border-teal-500 py-2 mb-5">
                <input type="email" class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none" name="email" value="{{ old('email') }}" placeholder="E-mail Address">
                @error('email')
                <span class="text-red-700 px-2 text-sm font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="block border-b-2 border-gray-400 focus-within:border-teal-500 py-2 mb-5">
                <input type="password" class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none inline-block" name="password" value="{{ old('password') }}" placeholder="Password">
                @error('password')
                <span class="text-red-700 px-2 text-sm font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="block border-b-2 border-gray-400 focus-within:border-teal-500 py-2">
                <input type="password" class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none" name="password_confirmation" placeholder="Confirm Password">
            </div>
            <div class="text-right pt-4 pb-4 mt-4">
                <button type="submit" class="w-full focus:shadow-outline focus:outline-none bg-teal-700 hover:bg-teal-700 border-teal-700 hover:border-teal-700 text-sm border-4 text-white py-2 px-3 rounded font-medium">
                    Register
                </button>
            </div>
        </div>
    </form>
</section>

@endsection
