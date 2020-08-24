@extends('main.layouts.app', ['nav_tab' => ''])

@section('content')

<section class="bg-teal-100">
	<div class="container mx-auto rounded mt-2 bg-white lg:p-20">
		<div class="flex -mx-2 mb-10 md:flex-row lg:flex-row flex-wrap">
			<div class="w-full md:flex-1 mx-2 mt-2 p-2 border border-teal-200">
				<img src="{{ Storage::url('uploads/images/2020/07/copZuCz39eBXqDK9OWjM5fmW2.jpg') }}" class="max-h-full">
			</div>
			<div class="w-full md:flex-1 mx-2 mt-2 p-4 border border-teal-200">
				<div class="block mb-4 border-b border-teal-700 pb-2">
					<span class="font-bold text-2xl text-red-700">{{ $moduleInfo->module_description }}</span>
				</div>
				<div class="block mb-4">
					<p class="text-teal-600">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
				</div>
				<div class="block mb-4">
					<span class="font-medium text-2xl text-red-600">&#8369;{{ number_format($moduleInfo->module_total_amount,2) }}/mo</span>
				</div>
				<div class="flex items-center border-t border-teal-700 pt-2">
					<div class="flex-1 text-left">
						<span class="text-sm font-medium text-sm mr-2 text-red-600"><i class="fa fa-users"></i> 2,456 </span>
						<span class="text-sm font-medium text-sm mr-2 text-red-600"><i class="fa fa-heart"></i> 2,456 </span>
					</div>
					<div class="flex-1 text-right">
						<button class="bg-teal-700 text-white hover:bg-gray-100 hover:text-teal-700 border border-teal-700 font-medium pt-1 pb-2 px-4 rounded">
						  	Install Now <i class="fa fa-angle-double-right"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div id="tabs">
			<ul class="flex -mx-2 mt-10 md:flex-row lg:flex-row flex-wrap">
				<li class="flex-1 text-center p-2 mt-2 ml-2 tabs border-r-2 border-l-2 border-t-2 border-teal-700 rounded-t-md">
					<a class="text-teal-700 hover:text-teal-900 font-medium outline-none pt-1 pb-2" href="#documentation" data-toggle="tab">Documentation</a>
				</li>
				<li class="flex-1 text-center p-2 mt-2 ml-2 tabs">
					<a class="text-teal-700 hover:text-teal-900 font-medium outline-none pt-1 pb-2" href="#installation" data-toggle="tab">Installation</a>
				</li>
				<li class="flex-1 text-center p-2 mt-2 ml-2 tabs">
					<a class="text-teal-700 hover:text-teal-900 font-medium outline-none pt-1 pb-2" href="#changelog" data-toggle="tab">Change Logs</a>
				</li>
				<li class="flex-1 text-center p-2 mt-2 ml-2 tabs">
					<a class="text-teal-700 hover:text-teal-900 font-medium outline-none pt-1 pb-2" href="#reviews" data-toggle="tab">Reviews</a>
				</li>
			</ul>
			<div class="p-4 leading-relaxed" id="documentation">
				<p class="leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<ul class="list-disc ml-2">
					<li>Lorem ipsum dolor sit amet,</li>
					<li>voluptate velit esse cillum dolore</li>
					<li>deserunt mollit anim id est laborum.</li>
				</ul>
			</div>
			<div class="p-4" id="installation" >
				B
			</div>
			<div class="p-4" id="changelog" >
				C
			</div>
			<div class="p-4" id="reviews" >
				D
			</div>
		</div>
	</div>
</section>

@push('scripts')
<script type="text/javascript">
    $(function() {
        $("#tabs").tabs({ active: documentation });
        $("#tabs [data-toggle='tab']").click(function () {
            $("[data-toggle='tab']").parent('li').removeClass("border-r-2 border-l-2 border-t-2 border-teal-700 rounded-t-md");
            $(this).parent('li').addClass("border-r-2 border-l-2 border-t-2 border-teal-700 rounded-t-md");
        });
    });
</script>
@endpush

@endsection