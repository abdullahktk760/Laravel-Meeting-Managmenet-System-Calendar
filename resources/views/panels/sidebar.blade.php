@php
    $configData = Helper::applClasses();
@endphp
<div class="main-menu menu-fixed {{ $configData['theme'] === 'dark' || $configData['theme'] === 'semi-dark' ? 'menu-dark' : 'menu-light' }} menu-accordion menu-shadow"
    data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="brand-logo">
                    </span>
                    <h2 class="brand-text">Meeting</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
                        data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ url('/dashboard') }}">
                    <i data-feather="feather feather-home"></i>
                    <span class="menu-title text-truncate">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('meeting') || Str::startsWith(request()->path(), 'meeting/')) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ url('/meeting') }}">
                    <i data-feather="shield"></i>
                    <span class="menu-title text-truncate">{{ __('Meetings') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
