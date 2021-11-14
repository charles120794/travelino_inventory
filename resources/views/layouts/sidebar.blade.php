<aside class="main-sidebar">
    <section class="sidebar">
        {{-- <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Storage::url(Auth()->User()->profile_path) }}" class="img-circle" alt="User Image" style="height: 45px;">
            </div>
            <div class="pull-left info">
                <p>{{ Auth()->User()->firstname }}</p>
                <a href="{{ route('accounts.route',['path' => 'users-profile']) }}"><i class="fa fa-circle text-success"></i> 
                    {{ Str::ucfirst(Auth()->User()->users_type) }} 
                </a>
            </div>
        </div> --}}
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" id="search_autocomplete" name="search_sidenav" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> --}}
        <ul class="sidebar-menu" data-widget="tree" id="sidebar_menu_list">
            @include('layouts.subsidebar', ['class' => $usersMenus])
        </ul>
    </section>
</aside>
