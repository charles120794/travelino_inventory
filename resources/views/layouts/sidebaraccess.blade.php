@foreach($class as $key => $value)

<li class="{{ $value->menu_active }} @if($value->usersAccess['menu_type'] == '1') treeview @endif">

	<a href="/{{ $value->menu_module }}/{{ $value->menu_path }}">
	
		<i class="{{ $value->menu_icon }}"></i> <span>{{ $value->menu_name }}</span>

		@if($value->usersAccess['menu_type'] == '1')

		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>

		@endif

	</a>

	@if($value->usersAccess['menu_type'] == '1')

		<ul class="treeview-menu">
			@include('layouts.sidebaraccess', ['class' => $value->menu_sub])
		</ul>

	@endif

</li>

@endforeach