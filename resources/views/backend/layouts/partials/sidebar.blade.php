<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('dashboard') }}">
                <img src="{{ asset('backend/images/brand/logo-white.png') }}" class="header-brand-img desktop-logo"
                     alt="logo">
                <img src="{{ asset('backend/images/brand/logo-1.png') }}" class="header-brand-img toggle-logo"
                     alt="logo">
                <img src="{{ asset('backend/images/brand/logo-2.png') }}" class="header-brand-img light-logo"
                     alt="logo">
                <img src="{{ asset('backend/images/brand/logo-3.png') }}" class="header-brand-img light-logo1"
                     alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                     viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/>
                </svg>
            </div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
               

                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('dashboard') }}">
                        <i class="side-menu__icon fe fe-home"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
              

              

                
              
                

                @can('view_users')
                    <li class="slide">
                        <a class="side-menu__item has-link {{ Request::is('users') ? 'active' : '' }}"
                           data-bs-toggle="slide" href="{{ route('users.index') }}">
                            <i class="side-menu__icon fe fe-users"></i>
                            <span class="side-menu__label">Users</span>
                        </a>
                    </li>
                @endcan


            </ul>
        </div>
    </div>
</div>
