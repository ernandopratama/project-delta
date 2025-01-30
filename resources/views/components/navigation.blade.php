<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="#">
            <span class="align-middle">APOKTEK</span>
        </a>

        <ul class="sidebar-nav">
            {{-- active --}}
            <li class="sidebar-item {{ request()->routeIs('web.dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('web.dashboard') }}">
                    <i class="fa fa-home"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>
            @if(auth()->user()->role->name == 'dokter')
                <li class="sidebar-item {{ request()->routeIs('web.dokter-checkup') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('web.dokter-checkup') }}">
                        <i class="fa fa-home"></i>
                        <span class="align-middle">Pemeriksaan Pasien</span>
                    </a>
                </li>
            @endif
            @if(auth()->user()->role->name == 'apoteker')
                <li class="sidebar-item {{ request()->routeIs('web.apoteker') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('web.apoteker') }}">
                        <i class="fa fa-pills"></i>
                        <span class="align-middle">Apoteker</span>
                    </a>
                </li>
            @endif
            @if(auth()->user()->role->name == 'admin')
                <li class="sidebar-item {{ request()->routeIs('web.role') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('web.role') }}">
                        <i class="fa fa-user"></i>
                        <span class="align-middle">Role</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('web.user') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('web.user') }}">
                        <i class="fa fa-users"></i>
                        <span class="align-middle">User</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
