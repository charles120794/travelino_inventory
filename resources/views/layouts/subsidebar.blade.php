<li class="header">SYSTEM MODULE</li>

<li>
    <a @if(config('owned')) href="{{ $activeModule->module_prefix }}/{{ $activeModule->module_route }}" @else href="{{ config('module.redirect_to.login') }}" @endif style="text-overflow: ellipsis; overflow: hidden;"> 
        <i class="{{ $activeModule->module_icon }}"></i> <span> {{ strtoupper($activeModule->module_name) }} </span>
    </a>
</li>

<li class="header"> MAIN NAVIGATION </li>

@include('layouts.sidebaraccess')

<li class="header"> LABELS </li>

<li><a href="/settings/home"><i class="fa fa-cog text-yellow"></i> 
    <span>Settings</span></a>
</li>

<li><a href="/accounts/home"><i class="fa fa-user text-red"></i> 
    <span>Account</span></a>
</li>

<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> 
    <span>Information</span></a>
</li>