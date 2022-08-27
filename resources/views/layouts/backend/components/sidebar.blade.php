<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">{{ __('pages.title') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}">{{ __('pages.brand') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">{{ __('Menu Utama') }}</li>
            <li class="{{ Request::route()->getName() == 'dashboard' ? 'active' : (
                Request::route()->getName() == 'dashboard.log' ? 'active' : '') }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i><span>{{ __('pages.dashboard') }}</span>
                </a>
            </li>
            <li class="menu-header">{{ __('Data') }}</li>
            <li class="nav-item dropdown {{ Request::route()->getName() == 'users.index' ? 'active' : (
                Request::route()->getName() == 'users.create' ? 'active' : (
                        Request::route()->getName() == 'users.edit' ? 'active' : (
                            Request::route()->getName() == 'users.show' ? 'active' : ''))) }}">
                <a href="{{ route('users.index') }}" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-users"></i>
                    <span>{{ __('Pengguna') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'users.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users.index') }}">{{ __('Daftar') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'users.create' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users.create') }}">{{ __('Tambah') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::route()->getName() == 'activity' ? 'active' : (
                Request::route()->getName() == 'activity.list.index' ? 'active' : (
                        Request::route()->getName() == 'activity.type.index' ? 'active' : '')) }}">
                <a href="{{ route('activity') }}" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-clock-rotate-left"></i>
                    <span>{{ __('Aktivitas') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'activity' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('activity') }}">{{ __('Semua') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'activity.list.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('activity.list.index') }}">{{ __('Daftar') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'activity.type.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('activity.type.index') }}">{{ __('Tipe') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::route()->getName() == 'university.index' ? 'active' : (
                        Request::route()->getName() == 'university.edit' ? 'active' : (
                                Request::route()->getName() == 'faculty.index' ? 'active' : (
                        Request::route()->getName() == 'faculty.edit' ? 'active' : (
                                Request::route()->getName() == 'major.index' ? 'active' : (
                        Request::route()->getName() == 'major.edit' ? 'active' : (
                            Request::route()->getName() == 'university.all' ? 'active' : '')))))) }}">
                <a href="{{ route('university.index') }}" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-building-columns"></i>
                    <span>{{ __('Universitas') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'university.all' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('university.all') }}">{{ __('Semua') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'university.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('university.index') }}">{{ __('Daftar') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'faculty.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('faculty.index') }}">{{ __('Fakultas') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'major.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('major.index') }}">{{ __('Jurusan') }}</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::route()->getName() == 'dashboard.criteria' ? 'active' : (
                Request::route()->getName() == 'dashboard.criteria' ? 'active' : '') }}">
                <a href="{{ route('dashboard.criteria') }}" class="nav-link">
                    <i class="fas fa-database"></i><span>{{ __('Kriteria') }}</span>
                </a>
            </li>
            <li class="{{ Request::route()->getName() == 'dashboard.alternative' ? 'active' : (
                Request::route()->getName() == 'dashboard.alternative' ? 'active' : '') }}">
                <a href="{{ route('dashboard.alternative') }}" class="nav-link">
                    <i class="fas fa-database"></i><span>{{ __('Alternatif') }}</span>
                </a>
            </li>
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('dashboard.feedback') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-comment-dots"></i> Feedback
            </a>
        </div>
    </aside>
</div>
