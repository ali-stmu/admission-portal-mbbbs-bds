<nav
    class="navbar navbar-expand-lg  blur blur-rounded top-0  z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
    <div class="container-fluid">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ route('dashboard') }}">
            Admission Portal MBBS-BDS
        </a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mx-auto">
                @if (auth()->user())
                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex align-items-center me-2 active" aria-current="page"
                            href="{{ route('dashboard') }}">
                            <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark me-2" href="{{ route('profile') }}">
                            <i class="fa fa-user opacity-6 text-dark me-1"></i>
                            Profile
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link text-dark me-2 text-dark"
                        href=" {{ auth()->user() ? route('static-sign-up') : route('sign-up') }}">
                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                        Sign Up
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark me-2" href="{{ auth()->user() ? route('sign-in') : route('login') }}">
                        <i class="fas fa-key opacity-6 text-dark me-1"></i>
                        Sign In
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>
