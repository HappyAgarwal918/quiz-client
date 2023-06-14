<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_access')
                <li class="nav-item">
                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('users') || request()->is('users/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user nav-icon">

                        </i>
                        {{ trans('cruds.user.title') }}
                    </a>
                </li>
            @endcan
            @can('question_access')
                <li class="nav-item">
                    <a href="{{ route("admin.questions.index") }}" class="nav-link {{ request()->is('questions') || request()->is('questions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-question nav-icon">

                        </i>
                        {{ trans('cruds.question.title') }}
                    </a>
                </li>
            @endcan
            @can('option_access')
                <li class="nav-item">
                    <a href="{{ route("admin.options.index") }}" class="nav-link {{ request()->is('options') || request()->is('options/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-check nav-icon">

                        </i>
                        {{ trans('cruds.option.title') }}
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>