<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="profile-container">
                        @if (Auth::user()->foto_profile && file_exists(public_path('foto_profile/' . Auth::user()->foto_profile)))
                            <img src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }}" alt="Profile Photo"
                                class="user-icon rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                        @else
                            <img src="{{ asset('foto_profile/gambarprofil.jpg') }}" alt="Default Profile"
                                class="user-icon rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                        @endif
                    </div>
                    <span class="profile-username">
                        <span class="op-7">Hi,</span>
                        <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="profile-container">
                                    @if (Auth::user()->foto_profile && file_exists(public_path('foto_profile/' . Auth::user()->foto_profile)))
                                        <img src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }}"
                                            alt="Profile Photo" class="user-icon rounded-circle"
                                            style="width: 32px; height: 32px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('foto_profile/gambarprofil.jpg') }}" alt="Default Profile"
                                            class="user-icon rounded-circle"
                                            style="width: 32px; height: 32px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="u-text">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <p class="text-muted">{{ Auth::user()->email }}</p>

                                </div>
                            </div>
                        </li>
                        <li>

                            <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
