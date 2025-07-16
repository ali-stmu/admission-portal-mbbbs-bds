<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
            <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="...">
            <span class="ms-3 font-weight-bold">Admission Portal MBBS-BDS</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">


            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'user-profile' ? 'active' : '' }}"
                    href="{{ route('user-profile') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-circle text-dark"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Profile</span>
                </a>
            </li>

            @if (auth()->user()->role === 'admin')
                <li class="nav-item pb-2">
                    <a class="nav-link {{ Route::currentRouteName() == 'user-management' ? 'active' : '' }}"
                        href="{{ route('user-management') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-people text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">User Management</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'students.index' ? 'active' : '' }}"
                        href="{{ route('students.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-mortarboard text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Student Management</span>
                    </a>
                </li>
            @endif


            @if (auth()->user()->role === 'student')
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'admission.form' ? 'active' : '' }}"
                        href="{{ route('admission.form') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-file-earmark-text text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">New Admission</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'billing' ? 'active' : '' }}"
                        href="{{ route('billing') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-credit-card text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Billing</span>
                    </a>
                </li>
            @endif




            <!-- Rest of your sidebar items -->
        </ul>
    </div>
</aside>
