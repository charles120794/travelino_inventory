<ul class="nav nav-tabs nav-justified">
	<li class="text-center @if(active_action() == 'users-company') active @endif">
		<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-company', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-home fa-fw"></i> Users Company </a>
	</li>
	<li class="text-center @if(active_action() == 'users-module') active @endif">
		<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-module', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-dropbox fa-fw"></i> Users Module </a>
	</li>
	<li class="text-center @if(active_action() == 'users-window') active @endif">
		<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-window', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-windows fa-fw"></i> Users Window </a>
	</li>
	<li class="text-center @if(active_action() == 'users-method') active @endif">
		<a href="{{ route('accounts.route',['path' => $path, 'action' => 'users-method', 'id' => encrypt($thisUserAccount->users_id)]) }}"><i class="fa fa-cogs fa-fw"></i> Users Method/Role </a>
	</li>
</ul>