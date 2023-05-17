<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-regular fa-face-laugh-wink"></i>

        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home page</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <x-admin.sidebar.admin-sidebar-posts-links>

    </x-admin.sidebar.admin-sidebar-posts-links>

    @if(auth()->user()->userHasRole('Admin'))

        <x-admin.sidebar.admin-sidebar-users-links></x-admin.sidebar.admin-sidebar-users-links>
        <x-admin.sidebar.authorization-links></x-admin.sidebar.authorization-links>
        <x-admin.sidebar.categories-links></x-admin.sidebar.categories-links>
    @endif

    <x-admin.sidebar.comments-links></x-admin.sidebar.comments-links>
    <!-- Divider -->
    <hr class="sidebar-divider">

</ul>
<!-- End of Sidebar -->
