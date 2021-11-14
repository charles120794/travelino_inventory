@foreach($class as $key => $value)

	<li class="{{ $value['window_active'] }} @if($value['window_type'] == '1') treeview @endif">

		<a href="/{{ $value['window_module'] }}/{{ $value['window_path'] }}">
		
			<i class="{{ $value['window_icon'] }}"></i> <span>{{ $value['window_name'] }}</span>

			@if($value['window_type'] == '1')

			<span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
			</span>

			@endif

		</a>

		@if($value['window_type'] == '1')

			<ul class="treeview-menu">
				@include('layouts.sidebaraccess', [ 'class' => $value['window_sub_class'] ])
			</ul>

		@endif

	</li>

@endforeach