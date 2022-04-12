<div class="col-12 col-lg-3 col-xl-2 vh-100 sidebar">
    <div class="d-flex justify-content-between align-items-center mt-3 nav-brand">
        <div class="d-flex align-items-center">
            <img src="{{ asset(\App\Base::$logo) }}" class="w-75" alt="">
        </div>
        <button class="hide-sidebar-btn btn btn-light d-block d-lg-none">
            <i class="feather-x text-primary" style="font-size: 2em;"></i>
        </button>
    </div>
    <div class="nav-menu">
        <ul>

            <x-menu-spacer></x-menu-spacer>

            <a href="{{ route('index') }}" class="">
                <button class="btn btn-outline-primary w-100">
                    <i class="feather-corner-up-left"></i>
                    Go To News Feed
                </button>
            </a>

            @if(Auth::user()->role == 0)
                <x-menu-spacer></x-menu-spacer>
                <x-menu-title title="User Manager"></x-menu-title>
                <x-menu-item name="Users" class="feather-users" link="{{ route('user-manager.index') }}"></x-menu-item>
                <x-menu-spacer></x-menu-spacer>
            @endif

            <x-menu-title title="Article Manager"></x-menu-title>
            @if(Auth::user()->role == 0)
            <x-menu-item name="Manage Category" class="feather-layers" link="{{ route('category.index') }}" ></x-menu-item>
            @endif
            <x-menu-item name="Article List" class="feather-list" link="{{ route('article.index') }}" ></x-menu-item>
            <x-menu-item name="Create Article" class="feather-plus-circle" link="{{ route('article.create') }}" ></x-menu-item>

            <x-menu-spacer></x-menu-spacer>

            <x-menu-title title="User Profile"></x-menu-title>
            <x-menu-item name="Your Profile" class="feather-user" link="{{ route('profile') }}"></x-menu-item>
            <x-menu-item name="Change Password" class="feather-refresh-cw" link="{{ route('profile.edit.password') }}"></x-menu-item>
            <x-menu-item name="Update Name & Email" class="feather-message-square" link="{{ route('profile.edit.name.email') }}"></x-menu-item>
            <x-menu-item name="Update photo" class="feather-image" link="{{ route('profile.edit.photo') }}"></x-menu-item>
            <x-menu-spacer></x-menu-spacer>



            <x-menu-spacer></x-menu-spacer>
            <li class="menu-item">
                <a class="btn btn-outline-primary btn-block" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    logout
                </a>
            </li>

        </ul>
    </div>
</div>
