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
            @if(Auth::user()->is_admin == 1)
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
            <li class="nav-item dropdown {{ Request::route()->getName() == 'university.index' ? 'active' :  (
                            Request::route()->getName() == 'university.edit' ? 'active' : (
                                Request::route()->getName() == 'university.recycle' ? 'active' : (
                                Request::route()->getName() == 'faculty.index' ? 'active' : (
                                 Request::route()->getName() == 'faculty.edit' ? 'active' : (
                                     Request::route()->getName() == 'faculty.recycle' ? 'active' : (
                                     Request::route()->getName() == 'major.index' ? 'active' : (
                                         Request::route()->getName() == 'major.recycle' ? 'active' : (
                                         Request::route()->getName() == 'major.edit' ? 'active' : '')))))))) }}">
                <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-database"></i>
                    <span>{{ __('Master') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'university.index' ? 'active' :  (
                            Request::route()->getName() == 'university.edit' ? 'active' : (
                                Request::route()->getName() == 'university.recycle' ? 'active' : '')) }}">
                        <a class="nav-link" href="{{ route('university.index') }}">{{ __('Universitas') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'faculty.index' ? 'active' :  (
                            Request::route()->getName() == 'faculty.edit' ? 'active' : (
                                Request::route()->getName() == 'faculty.recycle' ? 'active' : '')) }}">
                        <a class="nav-link" href="{{ route('faculty.index') }}">{{ __('Fakultas') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'major.index' ? 'active' :  (
                            Request::route()->getName() == 'major.edit' ? 'active' : (
                                Request::route()->getName() == 'major.recycle' ? 'active' : '')) }}">
                        <a class="nav-link" href="{{ route('major.index') }}">{{ __('Jurusan') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::route()->getName() == 'data.faculty.index' ? 'active' : (
                                                Request::route()->getName() == 'data.faculty.edit' ? 'active' : (
                                                    Request::route()->getName() == 'data.faculty.create' ? 'active' : (
                                                            Request::route()->getName() == 'data.major.index' ? 'active' : (
                                                                Request::route()->getName() == 'data.major.edit' ? 'active' : (
                                                                    Request::route()->getName() == 'data.major.create' ? 'active' : ''))))) }}">
                <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-building-columns"></i>
                    <span>{{ __('Universitas') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'data.faculty.index' ? 'active' : (
                                                Request::route()->getName() == 'data.faculty.edit' ? 'active' : (
                                                    Request::route()->getName() == 'data.faculty.create' ? 'active' : ''
                                                )) }}">
                        <a class="nav-link" href="{{ route('data.faculty.index') }}">{{ __('Fakultas') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'data.major.index' ? 'active' : (
                                                Request::route()->getName() == 'data.major.edit' ? 'active' : (
                                                    Request::route()->getName() == 'data.major.create' ? 'active' : ''
                                                )) }}">
                        <a class="nav-link" href="{{ route('data.major.index') }}">{{ __('Jurusan') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::route()->getName() == 'dashboard.criteria' ? 'active' : (
                        Request::route()->getName() == 'dashboard.alternative' ? 'active' : (
                                Request::route()->getName() == 'dashboard.weighting' ? 'active' : '')) }}">
                <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-database"></i>
                    <span>{{ __('AHP') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'dashboard.criteria' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.criteria') }}">{{ __('Kriteria') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'dashboard.alternative' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.alternative') }}">{{ __('Alternatif') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'dashboard.weighting' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.weighting') }}">{{ __('Pembobotan') }}</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('dashboard.feedback') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-comment-dots"></i> Feedback
            </a>
        </div>
        @else
            <li class="nav-item dropdown {{ Request::route()->getName() == 'data.faculty.index' ? 'active' : (
                                                Request::route()->getName() == 'data.faculty.edit' ? 'active' : (
                                                    Request::route()->getName() == 'data.faculty.create' ? 'active' : (
                                                            Request::route()->getName() == 'data.major.index' ? 'active' : (
                                                                Request::route()->getName() == 'data.major.edit' ? 'active' : (
                                                                    Request::route()->getName() == 'data.major.create' ? 'active' : ''))))) }}">
                <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-building-columns"></i>
                    <span>{{ __('Universitas') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'data.faculty.index' ? 'active' : (
                                                Request::route()->getName() == 'data.faculty.edit' ? 'active' : (
                                                    Request::route()->getName() == 'data.faculty.create' ? 'active' : ''
                                                )) }}">
                        <a class="nav-link" href="{{ route('data.faculty.index') }}">{{ __('Fakultas') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'data.major.index' ? 'active' : (
                                                Request::route()->getName() == 'data.major.edit' ? 'active' : (
                                                    Request::route()->getName() == 'data.major.create' ? 'active' : ''
                                                )) }}">
                        <a class="nav-link" href="{{ route('data.major.index') }}">{{ __('Jurusan') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::route()->getName() == 'dashboard.criteria' ? 'active' : (
                        Request::route()->getName() == 'dashboard.alternative' ? 'active' : (
                                Request::route()->getName() == 'dashboard.weighting' ? 'active' : '')) }}">
                <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-database"></i>
                    <span>{{ __('AHP') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::route()->getName() == 'dashboard.criteria' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.criteria') }}">{{ __('Kriteria') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'dashboard.alternative' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.alternative') }}">{{ __('Alternatif') }}</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'dashboard.weighting' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.weighting') }}">{{ __('Pembobotan') }}</a>
                    </li>
                </ul>
            </li>
            </ul>
        @endif
    </aside>
</div>
