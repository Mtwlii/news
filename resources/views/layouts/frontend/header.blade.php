<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="tb-contact">
                    <p><i class="fas fa-envelope"></i>{{ $getSetting->email }}</p>
                    <p><i class="fas fa-phone-alt"></i>{{ $getSetting->phone }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tb-menu">

                    @guest
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                        <a href="{{ route('frontend.index') }}">Home</a>
                    @endguest

                    @auth
                        <a href="javascript:void(0)"
                            onclick="if(confirm('Are you sure you want to logout?'))
                        {document.getElementById('logout-form').submit();}">Log
                            Out</a>
                    @endauth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Bar Start -->

<!-- Brand Start -->
<div class="brand">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4">
                <div class="b-logo">
                    <a href="index.html">
                        <img src="{{ asset('assets/frontend') }}{{ $getSetting->logo }}" alt="Logo" />
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="b-ads">

                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <form action="{{ route('frontend.search') }}" method="post">
                    @csrf
                    <div class="b-search">
                        <input name="search" type="text" placeholder="Search" />
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Brand End -->

<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="{{ route('frontend.index') }}" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">categories</a>
                        <div class="dropdown-menu">
                            @foreach ($categories as $category)
                                <a href="{{ route('frontend.category.posts', $category->slug) }}"
                                    title="{{ $category->name }}"
                                    class="dropdown-item">{{ strtoupper($category->name) }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('frontend.contactus.index') }}" class="nav-item nav-link">Contact Us</a>
                    @auth

                        <a href="{{ route('frontend.dashboard.profile.index') }}" class="nav-item nav-link">Dashboard</a>
                    @endauth
                </div>
                <div class="social ml-auto">
                    <a href="{{ $getSetting->twitter }}" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href=" {{ $getSetting->facebook }}" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $getSetting->linkedin }}" title="Linkedin"><i class="fab fa-linkedin-in"></i></a>
                    <a href="{{ $getSetting->instagram }}" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $getSetting->youtube }}" title="Youtube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->
