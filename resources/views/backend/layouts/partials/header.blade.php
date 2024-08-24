<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex align-items-center justify-content-between">
            <!-- Sales Bored Logo -->
            <div>
                <a href="/" class="navbar-brand">
                    <span class="logo-text">Sales Bored</span>
                </a>
            </div>

            <!-- Navigation Menu with Dropdowns -->
            <div class="flex-grow-1">
                <nav class="navbar navbar-expand-lg">
                   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <!-- First Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Vehicles
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                    <li><a class="dropdown-item" href="/vehicles/new">New</a></li>
                                    <li><a class="dropdown-item" href="/vehicles/used">Used</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Reporting
                                </a>
                            </li>
                            <!-- Second Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Management
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                    <li><a class="dropdown-item" href="/users">Accounts</a></li>
                                    <li><a class="dropdown-item" href="/SalesPeople">SalesTeam</a></li>
                                    <li><a class="dropdown-item" href="/Vehicles/">Vehicles</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <!-- Right Side of Header (Existing Content) -->
            <div class="d-none d-lg-flex align-items-center">
                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                    <span class="dark-layout"><i class="fe fe-moon"></i></span>
                    <span class="light-layout"><i class="fe fe-sun"></i></span>
                </a>
                <div class="dropdown d-flex">
                    <a class="nav-link icon full-screen-link nav-link-bg">
                        <i class="fe fe-minimize fullscreen-button"></i>
                    </a>
                </div>
                <!-- Profile -->
                <div class="dropdown d-flex profile-1">
                    <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                        <img src="{{ getImage(auth()->user()->avatar, true) }}" alt="profile-user" class="avatar profile-user brround cover-image">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <div class="drop-heading">
                            <div class="text-center">
                                <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ getFullName(auth()->user()) }}</h5>
                                <small class="text-muted">{{ ucfirst(auth()->user()->user_type) }}</small>
                            </div>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
