<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') | ParikshaChakra</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root{
            --pc-ink:#0b2c5f;
            --pc-amber:#f6a11a;
            --pc-surface:#f4f6f9;
        }
        body{
            font-family: 'Outfit', system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background: var(--pc-surface);
        }
        .pc-topbar{
            background: linear-gradient(135deg, #071a39, #0b2c5f 55%, #071a39);
        }
        .pc-brand{
            font-weight: 800;
            letter-spacing: .4px;
        }
        .pc-card{
            border: 1px solid rgba(11,44,95,0.12);
            border-radius: 16px;
        }
        .pc-badge{
            background: rgba(246,161,26,0.18);
            color: #5a3a00;
            border: 1px solid rgba(246,161,26,0.35);
        }
        .nav-pills .nav-link{
            border-radius: 12px;
            padding: 10px 12px;
            border: 1px solid rgba(255,255,255,0.12);
        }
        .nav-pills .nav-link:hover{
            background: rgba(255,255,255,0.10);
        }
        .nav-pills .nav-link.active{
            background: rgba(246,161,26,0.18);
            border-color: rgba(246,161,26,0.35);
            color: #fff;
        }
        a{ color: var(--pc-ink); }
        .nav-link{ font-weight: 600; }
    </style>
</head>
<body>
    @auth
        @php
            $u = auth()->user();
            $isAdmin = $u->role === 'admin';
        @endphp
    @endauth

    <div class="d-lg-none pc-topbar text-white">
        <div class="container py-2 d-flex align-items-center justify-content-between">
            <button class="btn btn-sm btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#pcSidebar">
                Menu
            </button>
            <div class="fw-bold">PARIKSHA CHAKRA</div>
            <span class="badge pc-badge">Login: {{ auth()->user()->login_id ?? auth()->user()->email }}</span>
        </div>
    </div>

    <div class="d-flex">
        <aside class="offcanvas-lg offcanvas-start pc-topbar text-white" tabindex="-1" id="pcSidebar" style="width: 280px;">
            <div class="offcanvas-header d-lg-none">
                <h5 class="offcanvas-title">Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column p-3" style="min-height: 100vh;">
                <a href="{{ url('/') }}" class="text-decoration-none text-white d-flex align-items-center gap-2 mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:42px; width:42px; object-fit:contain; border-radius:10px; background:rgba(255,255,255,0.12); padding:6px; border:1px solid rgba(255,255,255,0.18);">
                    <div>
                        <div class="pc-brand">PARIKSHA CHAKRA</div>
                        <div class="small" style="opacity:.85;">Dashboard</div>
                    </div>
                </a>

                <div class="mb-3 p-2 rounded" style="background: rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.14);">
                    <div class="small" style="opacity:.85;">Welcome</div>
                    <div class="fw-bold">{{ auth()->user()->name }}</div>
                    <div class="small" style="opacity:.85;">{{ auth()->user()->role === 'admin' ? 'Administrator' : 'Student' }}</div>
                </div>

                <nav class="nav nav-pills flex-column gap-1">
                    @if (auth()->user()->role === 'admin')
                        @php
                            $feesActive = request()->routeIs('admin.fees.index')
                                || request()->routeIs('admin.fees.edit')
                                || request()->routeIs('admin.fees.account.update')
                                || request()->routeIs('admin.fees.payment.store')
                                || request()->routeIs('admin.fees.receipt');
                        @endphp
                        <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <a class="nav-link text-white {{ request()->routeIs('admin.batches.*') ? 'active' : '' }}" href="{{ route('admin.batches.index') }}">Batches</a>
                        <a class="nav-link text-white {{ request()->routeIs('admin.students.*') ? 'active' : '' }}" href="{{ route('admin.students.index') }}">Students</a>
                        <a class="nav-link text-white {{ $feesActive ? 'active' : '' }}" href="{{ route('admin.fees.index') }}">Fees</a>
                        <a class="nav-link text-white {{ request()->routeIs('admin.fees.report') ? 'active' : '' }}" href="{{ route('admin.fees.report') }}">Fees Report</a>
                        <a class="nav-link text-white {{ request()->routeIs('admin.notices.*') ? 'active' : '' }}" href="{{ route('admin.notices.index') }}">Notices</a>
                        <a class="nav-link text-white {{ request()->routeIs('admin.live-classes.*') ? 'active' : '' }}" href="{{ route('admin.live-classes.index') }}">Live Classes</a>
                        <a class="nav-link text-white {{ request()->routeIs('admin.results.*') ? 'active' : '' }}" href="{{ route('admin.results.index') }}">Results</a>
                        <a class="nav-link text-white {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">Contacts</a>
                    @else
                        <a class="nav-link text-white {{ request()->routeIs('student.dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}">Dashboard</a>
                        <a class="nav-link text-white {{ request()->routeIs('student.profile.*') ? 'active' : '' }}" href="{{ route('student.profile.edit') }}">My Profile</a>
                    @endif
                </nav>

                <div class="mt-auto pt-3">
                    <div class="small mb-2" style="opacity:.85;">Login: {{ auth()->user()->login_id ?? auth()->user()->email }}</div>
                    <form method="post" action="{{ route('logout') }}" class="mb-0">
                        @csrf
                        <button class="btn btn-warning w-100 fw-bold" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-grow-1">
            <main class="container py-4">
                @if (session('status'))
                    <div class="alert alert-info" role="alert">{{ session('status') }}</div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
