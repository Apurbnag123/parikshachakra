<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Auth') | ParikshaChakra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <style>
        :root{
            --pc-ink:#0b2c5f;
            --pc-amber:#f6a11a;
            --pc-sky:#9fd2ff;
            --pc-card:rgba(255,255,255,0.88);
            --pc-glass:rgba(255,255,255,0.16);
        }

        body{
            min-height: 100vh;
            background:
                radial-gradient(1200px 600px at 10% 10%, rgba(159,210,255,0.65), rgba(159,210,255,0) 55%),
                radial-gradient(1000px 700px at 95% 20%, rgba(246,161,26,0.45), rgba(246,161,26,0) 60%),
                linear-gradient(135deg, #071a39, #0b2c5f 55%, #071a39);
            color:#0c1220;
        }

        .pc-shell{
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px 12px;
        }

        .pc-frame{
            width: 100%;
            max-width: 980px;
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: 0 24px 80px rgba(0,0,0,0.45);
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .pc-brand{
            position: relative;
            padding: 28px 26px;
            color: white;
            background:
                radial-gradient(600px 420px at 30% 20%, rgba(246,161,26,0.45), rgba(246,161,26,0) 65%),
                radial-gradient(700px 520px at 70% 70%, rgba(159,210,255,0.35), rgba(159,210,255,0) 60%),
                rgba(255,255,255,0.06);
        }

        .pc-brand::after{
            content:"";
            position:absolute;
            inset:0;
            background:
                linear-gradient(90deg, rgba(255,255,255,0.10), rgba(255,255,255,0.02));
            pointer-events:none;
        }

        .pc-logo{
            width: 88px;
            height: 88px;
            border-radius: 18px;
            background: rgba(0,0,0,0.28);
            padding: 10px;
            border: 1px solid rgba(255,255,255,0.22);
            box-shadow: 0 14px 40px rgba(0,0,0,0.35);
            object-fit: contain;
        }

        .pc-title{
            font-weight: 800;
            letter-spacing: 0.2px;
            margin: 18px 0 6px;
        }

        .pc-subtitle{
            opacity: 0.92;
            margin: 0;
        }

        .pc-pills{
            display:flex;
            flex-wrap:wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .pc-pill{
            font-size: 13px;
            padding: 8px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.22);
        }

        .pc-card{
            background: var(--pc-card);
            padding: 28px 26px;
        }

        .pc-card h2{
            color: var(--pc-ink);
            font-weight: 800;
            margin: 0 0 6px;
        }

        .pc-card .text-muted{
            color: rgba(12,18,32,0.65) !important;
        }

        .pc-form .form-control{
            border-radius: 14px;
            padding: 12px 14px;
            border: 1px solid rgba(11,44,95,0.18);
        }

        .pc-form .form-control:focus{
            border-color: rgba(246,161,26,0.55);
            box-shadow: 0 0 0 0.25rem rgba(246,161,26,0.18);
        }

        .pc-primary{
            background: linear-gradient(135deg, var(--pc-amber), #ffcc6a);
            border: 0;
            color: #1c1c1c;
            font-weight: 800;
            border-radius: 14px;
            padding: 12px 14px;
            box-shadow: 0 12px 30px rgba(246,161,26,0.22);
        }

        .pc-link{
            color: var(--pc-ink);
            font-weight: 700;
            text-decoration: none;
        }
        .pc-link:hover{
            text-decoration: underline;
        }

        .pc-fadeup{
            animation: pcFadeUp 420ms ease-out both;
        }
        @keyframes pcFadeUp{
            from{ opacity: 0; transform: translateY(10px); }
            to{ opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 991.98px){
            .pc-brand{
                padding: 22px 18px;
            }
            .pc-card{
                padding: 22px 18px;
            }
        }
    </style>
</head>
<body>
    <div class="pc-shell">
        <div class="pc-frame pc-fadeup">
            <div class="row g-0">
                <div class="col-lg-5 pc-brand">
                    <div class="position-relative" style="z-index:1;">
                        <a href="{{ url('/') }}" class="d-inline-flex align-items-center gap-3 text-decoration-none text-white">
                            <img class="pc-logo" src="{{ asset('images/logo.png') }}" alt="ParikshaChakra Logo">
                            <div>
                                <div class="fw-bold" style="letter-spacing:.5px;">PARIKSHA CHAKRA</div>
                                <div style="opacity:.9;">Competition Classes</div>
                            </div>
                        </a>

                        <h1 class="pc-title h3">Learn boldly. Live to inspire.</h1>
                        <p class="pc-subtitle">Secure access to your dashboard, notes, and updates.</p>

                        <div class="pc-pills">
                            <div class="pc-pill"><i class="fa fa-shield me-1"></i> Secure</div>
                            <div class="pc-pill"><i class="fa fa-bolt me-1"></i> Fast</div>
                            <div class="pc-pill"><i class="fa fa-graduation-cap me-1"></i> Premium</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 pc-card">
                    @if (session('status'))
                        <div class="alert alert-info mb-3" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @yield('content')

                    <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-between align-items-center">
                        <a class="pc-link" href="{{ url('/') }}"><i class="fa fa-long-arrow-left me-1"></i>Back to Home</a>
                        <div class="small text-muted">© {{ date('Y') }} ParikshaChakra</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

