@extends('main.layouts.app',['nav_tab' => 'home'])

@section('content')

<section class="bg-teal-100 h-screen -mb-2">
    <div class="container flex h-64 pt-20 items-center mx-auto">
        <h1 class="text-teal-700 flex-1 font-bold text-center text-2xl sm:text-3xl md:text-3xl lg:text-5xl">ONLINE SOFTWARE FOR BUSINESS</h1>
    </div>
</section>

<section class="bg-teal-100 pb-20">
    <div class="container mx-auto p-4 mt-2 text-teal-700">
        <div class="flex border-b border-teal-700 mb-5 py-6 text-center">
            <h1 class="text-teal-700 flex-1 font-bold text-center text-2xl sm:text-2xl md:text-2xl lg:text-3xl">TOP MODULES</h1>
        </div>
        <div class="flex -mx-2 md:flex-row lg:flex-row flex-wrap">
            @foreach(module_for_sale() as $key => $module)
            <div class="w-full md:flex-1 mx-2 mt-2 bg-gray-100 border rounded border-teal-100 shadow-lg">
                <div class="flex p-4">
                    <p class="flex-1 text-teal-800 font-bold text-center"> {{ $module->module_description }} </p>
                </div>
                <div class="flex">
                    <img src="{{ Storage::url('uploads/images/2020/07/05EYNvOBO7HZZYi8CItaFerXr.jpg') }}">
                </div>
                <div class="flex p-4">
                    <p class="flex-1 text-left text-green-800"><i class="fa fa-users"></i> 234 </p>
                    <p class="flex-1 text-right font-medium text-teal-800 text-lg mr-1">P{{ number_format($module->module_total_amount,2) }}/mo</p>
                </div>
                <div class="flex p-1">
                    <a href="/module/details/{{ encrypt($module->module_id) }}" class="w-full text-center text-xs bg-teal-700 hover:bg-teal-700 text-gray-100 font-bold py-2 px-4 border border-blue-700">
                        MORE DETAILS
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

    

