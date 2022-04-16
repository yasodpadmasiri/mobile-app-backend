@extends('../layout/main')

@section('head')
    @yield('subhead')
@endsection

@section('content')
    @include('../layout/components/mobile-menu')
    <div class="flex">
        <nav class="side-nav">
            <a href="{{url('/')}}" class="intro-x flex items-center pl-5 pt-4">
                <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                <span class="hidden xl:block text-white text-lg ml-3">
                    Blog
                </span>
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                    <a href="{{url('/dashboard/side-menu/light')}}" class="side-menu <?php if(Request::segment(1) == 'dashboard') { echo 'side-menu--active'; } ?>">
                        <div class="side-menu__icon">
                            <i data-feather="home"></i>
                        </div>
                        <div class="side-menu__title">
                            Dashboard
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('/category/side-menu/light')}}" class="side-menu <?php if(Request::segment(1) == 'category') { echo 'side-menu--active'; } ?>">
                        <div class="side-menu__icon">
                            <i data-feather="layers"></i>
                        </div>
                        <div class="side-menu__title">
                            Category
                        </div>
                    </a>
                </li>

                <li>
                    <a href="{{url('/author/side-menu/light')}}" class="side-menu <?php if(Request::segment(1) == 'author') { echo 'side-menu--active'; } ?>">
                        <div class="side-menu__icon">
                            <i data-feather="edit"></i>
                        </div>
                        <div class="side-menu__title">
                            Authors
                        </div>
                    </a>
                </li>

                <li>
                    <a href="{{url('/blog/side-menu/light')}}" class="side-menu <?php if(Request::segment(1) == 'blog' || Request::segment(1) == 'add-blog') { echo 'side-menu--active'; } ?>">
                        <div class="side-menu__icon">
                            <i data-feather="monitor"></i>
                        </div>
                        <div class="side-menu__title">
                            Blog
                        </div>
                    </a>
                </li>
                 <li>
                    <a href="{{url('/users/side-menu/light')}}" class="side-menu <?php if(Request::segment(1) == 'users') { echo 'side-menu--active'; } ?>">
                        <div class="side-menu__icon">
                            <i data-feather="users" class="report-box__icon"></i>
                        </div>
                        <div class="side-menu__title">
                            Users
                        </div>
                    </a>
                </li>

                <li>
                    <a href="{{url('/setting/side-menu/light')}}" class="side-menu <?php if(Request::segment(1) == 'setting') { echo 'side-menu--active'; } ?>">
                        <div class="side-menu__icon">
                            <i data-feather="settings"></i>
                        </div>
                        <div class="side-menu__title">
                            Setting
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('/profile/side-menu/light')}}" class="side-menu <?php if(Request::segment(1) == 'profile') { echo 'side-menu--active'; } ?>">
                        <div class="side-menu__icon">
                            <i data-feather="user"></i>
                        </div>
                        <div class="side-menu__title">
                            Profile
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="content">
            @include('../layout/components/top-bar')
            @yield('subcontent')
        </div>
    </div>
@endsection