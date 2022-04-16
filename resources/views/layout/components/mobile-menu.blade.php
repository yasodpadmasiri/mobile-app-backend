<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler">
            <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="{{url('/dashboard/side-menu/light')}}" class="menu <?php if(Request::segment(1) == 'dashboard') { echo 'menu--active'; } ?>">
                <div class="menu__icon">
                    <i data-feather="home"></i>
                </div>
                <div class="menu__title">
                    Dashboard
                </div>
            </a>
        </li>
        <li>
            <a href="{{url('/category/side-menu/light')}}" class="menu <?php if(Request::segment(1) == 'category') { echo 'menu--active'; } ?>">
                <div class="menu__icon">
                    <i data-feather="layers"></i>
                </div>
                <div class="menu__title">
                    Category
                </div>
            </a>
        </li>

        <li>
            <a href="{{url('/author/side-menu/light')}}" class="menu <?php if(Request::segment(1) == 'author') { echo 'menu--active'; } ?>">
                <div class="menu__icon">
                    <i data-feather="edit"></i>
                </div>
                <div class="menu__title">
                    Authors
                </div>
            </a>
        </li>

        <li>
            <a href="{{url('/blog/side-menu/light')}}" class="menu <?php if(Request::segment(1) == 'blog' || Request::segment(1) == 'add-blog') { echo 'menu--active'; } ?>">
                <div class="menu__icon">
                    <i data-feather="monitor"></i>
                </div>
                <div class="menu__title">
                    Blog
                </div>
            </a>
        </li>
         <li>
            <a href="{{url('/users/side-menu/light')}}" class="menu <?php if(Request::segment(1) == 'users') { echo 'menu--active'; } ?>">
                <div class="menu__icon">
                    <i data-feather="users" class="report-box__icon"></i>
                </div>
                <div class="menu__title">
                    Users
                </div>
            </a>
        </li>

        <li>
            <a href="{{url('/setting/side-menu/light')}}" class="menu <?php if(Request::segment(1) == 'setting') { echo 'menu--active'; } ?>">
                <div class="menu__icon">
                    <i data-feather="settings"></i>
                </div>
                <div class="menu__title">
                    Setting
                </div>
            </a>
        </li>
        <li>
            <a href="{{url('/profile/side-menu/light')}}" class="menu <?php if(Request::segment(1) == 'profile') { echo 'menu--active'; } ?>">
                <div class="menu__icon">
                    <i data-feather="user"></i>
                </div>
                <div class="menu__title">
                    Profile
                </div>
            </a>
        </li>        
    </ul>
</div>