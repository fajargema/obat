<!--**********************************
            Nav header start
***********************************-->
<div class="nav-header">
    <a href="{{ route('admin-page.index')}}" class="brand-logo">
        <img class="logo-abbr" src="{{ asset('admin/images/logo.png') }}" alt="Logo Apotik">
        <img class="logo-compact" src="{{ asset('admin/images/logo-text.png') }}" alt="Logo Apotik">
        <img class="brand-title" src="{{ asset('admin/images/logo-text.png') }}" alt="Logo Apotik">

    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<!--**********************************
            Nav header end
***********************************-->


<!--**********************************
            Header start
***********************************-->
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        Dashboard
                    </div>
                </div>

                <ul class="navbar-nav header-right">

                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <div class="header-info">
                                <span>{{ Auth::user()->name }}</span>
                                <small>{{ Auth::user()->nip }}</small>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" width="20" alt="" />

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">

                            <a href="{{ route('logout') }}" class="dropdown-item ai-icon" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="ml-2">Logout </span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!--**********************************
            Header end ti-comment-alt
***********************************-->
