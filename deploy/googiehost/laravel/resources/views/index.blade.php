<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parikshachakra_Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>


    <style>
        :root{
            --pc-ink:#0b2c5f;
            --pc-ink-2:#071a39;
            --pc-amber:#f6a11a;
            --pc-surface:#f4f6f9;
            --pc-card:#ffffff;
        }

        html, body{
            scroll-behavior: smooth;
        }

        body{
            padding: 0px;
            font-family: 'Outfit', system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-color: var(--pc-surface);
        }
        #back{
            max-width: 100px;
            height: 100px;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            position: relative;
        }

        .banner{
            height: 100vh;
            background: url('images/coaching.jpg') no-repeat center center/cover;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Dark overlay for better look */
        .overlay{
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(7,26,57,0.72), rgba(11,44,95,0.62) 55%, rgba(0,0,0,0.55));
        }

        /* Glass Effect Box */
        .glass-box{
            position: relative;
            z-index: 2;
            padding: 80px 100px;
            text-align: center;
            color: #fff;
            top: 100px;
            max-width: 860px;
            margin: 0 18px;


            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;

            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }

        .glass-box h1{
            font-size: 40px;
            margin-bottom: 15px;
            font-weight: 800;
            letter-spacing: 0.2px;
        }

        .glass-box p{
            font-size: 18px;
            margin-bottom: 20px;
            opacity: 0.92;
        }

        .btns a, .btns button{
            padding: 10px 20px;
            border: none;
            margin: 5px;
            cursor: pointer;
            border-radius: 20px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease, border-color 160ms ease, color 160ms ease;
        }

        /* Buttons */
        .btn1{
            background: linear-gradient(135deg, var(--pc-amber), #ffcc6a);
            color: #1c1c1c;
            box-shadow: 0 14px 40px rgba(246,161,26,0.24);
        }

        .btn2{
            background: transparent;
            border: 1px solid rgba(255,255,255,0.75);
            color: #fff;
        }
        .btns a:hover, .btns button:hover{
            transform: translateY(-2px);
        }
        .btn2:hover{
            background: rgba(255,255,255,0.14);
        }

        /* Content */
        .content {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Glass Navbar */
        .custom-navbar {
            background: rgba(7,26,57, 0.34);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .pc-brand-logo{
            height: 74px;
            width: 74px;
            /*margin-top: -10px;*/
            /*padding-bottom: 6px;*/
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.35));
        }

        /* Hover effect */
        .nav-link:hover {
            color: #ffc107 !important;
        }
        .nav-link{
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        .pc-section-title{
            font-weight: 800;
            letter-spacing: 0.2px;
            color: var(--pc-ink);
        }
        .pc-section-subtitle{
            color: rgba(7,26,57,0.75);
        }

        .feature-box{
            display:flex;
            align-items:center;
            gap:15px;

        }

        .icon-circle{
            width:60px;
            height:60px;
            background:#0b2c5f;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:50%;
            font-size:24px;
            margin-left: 30px;
        }

        .divider{
            height:60px;
            width:1px;
            background:#ccc;
            margin-left: 30px;
        }

        .about-list li{
            margin-bottom:10px;
            list-style:none;
            font-size:17px;
        }

        .about-list li::before{
            content:"\2714";
            color:#0b2c5f;
            margin-right:10px;
        }
#i{
    font-size: 20px;
    color: darkgreen;
    text-align: center;
    padding-top: 20px;
    font-weight: bold;
    background: rgba(255,255,255,0.92);
    border: 1px solid rgba(11,44,95,0.12);
    border-radius: 18px;
    box-shadow: 0 14px 40px rgba(0,0,0,0.08);

}

        .coaching{
            background: linear-gradient(180deg, #f7f8fb, #ededec);
        }

        .teacher{
            background: linear-gradient(180deg, #f7f8fb, #ededec);
        }
        /* Slider Container */
        .swiper{
            width: 90%;
            padding: 50px 0;
        }

        /* Card Design */
        .card{
            background: white;
            border-radius: 20px;
            overflow: hidden;
            text-align: center;
            border: 1px solid rgba(11,44,95,0.10);
            box-shadow: 0 18px 55px rgba(0,0,0,0.10);
            transition: transform 160ms ease, box-shadow 160ms ease;
        }
        .card:hover{
            transform: translateY(-4px);
            box-shadow: 0 26px 70px rgba(0,0,0,0.14);
        }

        /* Top Blue Section */
        .card-top{
            background: radial-gradient(520px 220px at 30% 30%, rgba(246,161,26,0.50), rgba(246,161,26,0) 58%),
                        linear-gradient(135deg, #071a39, #0b2c5f);
            height: 170px;
            position: relative;
        }

        /* Profile Image */
        .card img{
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 4px solid white;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 60px;
        }

        /* Content */
        .card-body{
            padding: 70px 20px 20px;
        }

        .card h3{
            margin: 30px 0 5px;
        }

        .card p{
            color: darkslategray;
        }

        /* Social Icons */
        .social i{
            margin: 10px;
            font-size: 18px;
            color: #0a0aa8;
            cursor: pointer;
            transition: transform 160ms ease, color 160ms ease;
        }
        .social i:hover{
            transform: translateY(-2px);
            color: var(--pc-amber);
        }

        /* Button */
        .bt{
            background: linear-gradient(135deg, var(--pc-ink), #0e3c82);
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:8px;
            margin-top:10px;
            font-weight: 700;
            box-shadow: 0 12px 30px rgba(11,44,95,0.22);
        }

        /* Arrows */
        .swiper-button-next,
        .swiper-button-prev{
            color:#0a0aa8;
        }
        /* Avoid global <li> styling; scope nav/footer instead */
        .navbar-nav li{
            font-size: 16px;
            margin-top: 0;
            margin-left: 0;
            font-family: inherit;
        }
        .footer li{
            font-size: 17px;
            color: white;
            text-decoration: none;
            font-family: inherit;
            margin-top: 10px;
            margin-left: 20px;
        }

        /* Premium footer (single unified block, no columny look) */
        .pc-footer{
            background:
                radial-gradient(900px 420px at 18% 10%, rgba(246,161,26,0.26), rgba(246,161,26,0) 60%),
                radial-gradient(900px 520px at 92% 30%, rgba(159,210,255,0.20), rgba(159,210,255,0) 62%),
                linear-gradient(135deg, var(--pc-ink-2), var(--pc-ink));
        }
        .pc-footer-card{
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.16);
            border-radius: 20px;
            padding: 22px 18px;
            box-shadow: 0 22px 70px rgba(0,0,0,0.28);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .pc-footer-topline{
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }
        .pc-footer-logo{
            width: 120px;
            height: 120px;
            object-fit: contain;
            border-radius: 20px;
            background: rgba(0,0,0,0.22);
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: 0 18px 55px rgba(0,0,0,0.30);
            padding: 10px;
        }
        .pc-footer-links-inline{
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-end;
        }
        .pc-footer-links-inline a{
            color: rgba(255,255,255,0.92);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.16);
            background: rgba(255,255,255,0.06);
            transition: transform 160ms ease, background 160ms ease, border-color 160ms ease;
            font-weight: 600;
            letter-spacing: 0.2px;
        }
        .pc-footer-links-inline a:hover{
            transform: translateY(-1px);
            background: rgba(255,255,255,0.10);
            border-color: rgba(255,255,255,0.22);
        }
        .pc-footer-mid{
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid rgba(255,255,255,0.14);
        }
        .pc-footer-contact p{
            margin: 0 0 10px;
            color: rgba(255,255,255,0.92);
            font-size: 16px;
        }
        .pc-footer-social{
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: flex-end;
        }
        .pc-social-btn{
            width: 46px;
            height: 46px;
            border-radius: 16px;
            background: rgba(255,255,255,0.92);
            border: 1px solid rgba(255,255,255,0.55);
            display: grid;
            place-items: center;
            box-shadow: 0 14px 35px rgba(0,0,0,0.22);
            transition: transform 160ms ease;
        }
        .pc-social-btn:hover{
            transform: translateY(-2px);
        }
        .pc-footer #o{
            margin-top: 0;
            margin-left: 0;
            color: var(--pc-ink);
        }
        .pc-footer-copy{
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid rgba(255,255,255,0.14);
            color: rgba(255,255,255,0.86);
            text-align: center;
            font-size: 14px;
        }

        /* Gallery preview */
        .pc-gallery{
            background:
                radial-gradient(900px 420px at 12% 10%, rgba(246,161,26,0.14), rgba(246,161,26,0) 60%),
                radial-gradient(900px 520px at 92% 30%, rgba(159,210,255,0.20), rgba(159,210,255,0) 62%),
                linear-gradient(180deg, #f7f8fb, #ffffff);
        }
        .pc-gallery-grid{
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 14px;
            grid-auto-flow: dense;
        }
        .pc-gallery-tile{
            grid-column: span 4;
            grid-row: span 1;
            border-radius: 18px;
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(11,44,95,0.10);
            box-shadow: 0 18px 55px rgba(0,0,0,0.10);
            min-height: var(--h, 190px);
            background: #0c1220;
            transform: translateZ(0);
            transition: transform 220ms ease, box-shadow 220ms ease;
        }
        .pc-gallery-tile.span-6{ grid-column: span 6; }
        .pc-gallery-tile.span-3{ grid-column: span 3; }
        .pc-gallery-tile.row-2{ grid-row: span 2; }

        .pc-gallery-tile img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.03);
            transition: transform 260ms ease;
            filter: saturate(1.05) contrast(1.03);
        }
        .pc-gallery-tile::before{
            content:"";
            position:absolute;
            inset:0;
            background:
                radial-gradient(900px 260px at 12% 12%, rgba(246,161,26,0.22), rgba(246,161,26,0) 60%),
                radial-gradient(900px 280px at 92% 18%, rgba(159,210,255,0.16), rgba(159,210,255,0) 62%);
            opacity: 0.85;
            pointer-events:none;
            z-index: 0;
            transition: opacity 260ms ease;
        }
        .pc-gallery-tile::after{
            content:"";
            position:absolute;
            inset:0;
            background: linear-gradient(180deg, rgba(0,0,0,0.06), rgba(0,0,0,0.62));
            opacity: 0.85;
            transition: opacity 260ms ease;
            pointer-events:none;
            z-index: 0;
        }
        .pc-gallery-tile:hover{
            transform: translateY(-6px);
            box-shadow: 0 26px 75px rgba(0,0,0,0.14);
        }
        .pc-gallery-tile:hover img{
            transform: scale(1.12);
        }
        .pc-gallery-tile:hover::before{
            opacity: 1;
        }
        .pc-gallery-tile:hover::after{
            opacity: 1;
        }
        .pc-gallery-meta{
            position: absolute;
            inset: auto 14px 14px 14px;
            color: rgba(255,255,255,0.92);
            display:flex;
            align-items:end;
            justify-content: space-between;
            gap: 10px;
            z-index: 1;
        }
        .pc-gallery-meta .t{
            font-weight: 800;
            margin: 0;
            letter-spacing: 0.2px;
        }
        .pc-gallery-meta .tag{
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.18);
            white-space: nowrap;
        }

        /* Contact */
        .pc-contact{
            background:
                radial-gradient(900px 420px at 12% 10%, rgba(159,210,255,0.20), rgba(159,210,255,0) 60%),
                radial-gradient(900px 520px at 92% 30%, rgba(246,161,26,0.14), rgba(246,161,26,0) 62%),
                linear-gradient(180deg, #ffffff, #f7f8fb);
        }
        .pc-contact-card{
            background: rgba(255,255,255,0.92);
            border: 1px solid rgba(11,44,95,0.10);
            border-radius: 20px;
            box-shadow: 0 22px 70px rgba(0,0,0,0.10);
            overflow: hidden;
        }
        .pc-contact-card .head{
            background: linear-gradient(135deg, #071a39, #0b2c5f);
            color: rgba(255,255,255,0.92);
            padding: 16px 18px;
        }
        .pc-contact-card .body{
            padding: 18px;
        }
        .pc-contact-sticker{
            position: relative;
            background:
                radial-gradient(700px 380px at 18% 20%, rgba(246,161,26,0.22), rgba(246,161,26,0) 60%),
                radial-gradient(800px 420px at 90% 30%, rgba(159,210,255,0.20), rgba(159,210,255,0) 62%),
                linear-gradient(135deg, rgba(7,26,57,0.10), rgba(11,44,95,0.06));
            display: grid;
            place-items: center;
        }
        .pc-contact-sticker::after{
            content:"";
            position:absolute;
            inset: 18px;
            border-radius: 18px;
            border: 1px dashed rgba(11,44,95,0.18);
            pointer-events:none;
        }
        .pc-sticker-inner{
            padding: 26px 18px;
            text-align: center;
            transform: rotate(-1.2deg);
        }
        .pc-sticker-mark{
            width: 110px;
            height: 110px;
            border-radius: 34px;
            margin: 0 auto 14px;
            display:grid;
            place-items:center;
            background: linear-gradient(135deg, var(--pc-ink), #0e3c82);
            box-shadow: 0 22px 70px rgba(11,44,95,0.22);
            color: rgba(255,255,255,0.92);
            font-size: 52px;
            position: relative;
        }
        .pc-sticker-mark::before{
            content:"";
            position:absolute;
            inset:-10px;
            border-radius: 40px;
            background: radial-gradient(120px 120px at 30% 20%, rgba(246,161,26,0.55), rgba(246,161,26,0) 60%);
            opacity: 0.9;
            pointer-events:none;
        }
        .pc-sticker-logo{
            width: 90px;
            height: 90px;
            object-fit: contain;
            border-radius: 22px;
            background: rgba(0,0,0,0.06);
            border: 1px solid rgba(11,44,95,0.10);
            padding: 10px;
            margin: 10px auto 10px;
        }
        .pc-sticker-title{
            margin: 0 0 6px;
            font-weight: 900;
            color: var(--pc-ink);
            letter-spacing: 0.2px;
        }
        .pc-sticker-sub{
            margin: 0;
            color: rgba(7,26,57,0.75);
        }
        .pc-contact-item{
            display:flex;
            gap: 12px;
            align-items:flex-start;
            padding: 12px 0;
            border-bottom: 1px solid rgba(11,44,95,0.08);
        }
        .pc-contact-item:last-child{
            border-bottom: 0;
            padding-bottom: 0;
        }
        .pc-contact-ico{
            width: 44px;
            height: 44px;
            border-radius: 16px;
            background: rgba(246,161,26,0.16);
            color: var(--pc-ink);
            display:grid;
            place-items:center;
            border: 1px solid rgba(246,161,26,0.22);
            flex: 0 0 auto;
        }
        .pc-contact-item .t{
            margin: 0;
            font-weight: 800;
            color: var(--pc-ink);
        }
        .pc-contact-item .v{
            margin: 0;
            color: rgba(7,26,57,0.78);
        }
        .pc-contact-form .form-control{
            border-radius: 16px;
            padding: 12px 14px;
            border: 1px solid rgba(11,44,95,0.14);
        }
        .pc-contact-form .form-control:focus{
            border-color: rgba(246,161,26,0.55);
            box-shadow: 0 0 0 0.25rem rgba(246,161,26,0.18);
        }
        .pc-send{
            background: linear-gradient(135deg, var(--pc-amber), #ffcc6a);
            border: 0;
            color: #1c1c1c;
            font-weight: 900;
            border-radius: 16px;
            padding: 12px 16px;
            box-shadow: 0 16px 45px rgba(246,161,26,0.20);
        }
        #o{
            font-size: 24px;
            color: blue;
            text-align: center;
            margin-top: 13px;
            font-weight: bold;
            margin-left: 5px;

        }

        /* Responsive overrides (desktop styles remain unchanged) */
        @media (max-width: 991.98px){
            html, body{
                overflow-x: hidden;
            }

            /* Navbar: keep usable on small screens */
            .custom-navbar .navbar-toggler{
                border-color: rgba(255,255,255,0.6);
            }
            .custom-navbar .navbar-toggler-icon{
                filter: invert(1);
            }
            .navbar-brand img{
                height: 70px !important;
                width: 70px !important;
                margin-top: 0 !important;
                padding-bottom: 0 !important;
            }
            .navbar-nav li{
                margin-left: 0 !important;
            }

            /* Hero */
            .banner{
                height: auto;
                min-height: 100vh;
                padding: 90px 0 40px;
            }
            .glass-box{
                padding: 40px 24px;
                top: 60px;
                margin: 0 12px;
            }
            .glass-box h1{
                font-size: 28px;
            }
            .glass-box p{
                font-size: 16px;
            }

            /* Coaching counters: avoid tiny columns */
            #coaching .coaching{
                height: auto !important;
                padding-bottom: 20px;
            }
            #coaching .coaching h2{
                margin-top: 0 !important;
            }
            #coaching .coaching .row{
                justify-content: center;
                row-gap: 12px;
            }
            #coaching .coaching .row > .col-2:empty{
                display: none !important;
            }
            #coaching .coaching .row > .col-2{
                flex: 0 0 50% !important;
                width: 50% !important;
            }

            /* About section: stack columns + tame absolute/large images */
            .about .col-6{
                flex: 0 0 100% !important;
                width: 100% !important;
            }
            .about .row > .col-6:first-child{
                position: relative;
            }
            .about .row > .col-6:first-child img:nth-of-type(1){
                width: min(100%, 380px) !important;
                height: auto !important;
                margin: 24px auto 0 !important;
                display: block !important;
                position: relative !important;
                margin-left: auto !important;
                margin-top: 24px !important;
            }
            .about .row > .col-6:first-child img:nth-of-type(2){
                width: min(100%, 260px) !important;
                height: auto !important;
                position: absolute !important;
                left: 50% !important;
                transform: translateX(-50%) !important;
                margin-left: 0 !important;
                margin-top: -120px !important;
            }
            .about .d-flex.align-items-center{
                flex-direction: column;
                align-items: flex-start !important;
                gap: 12px;
            }
            .icon-circle,
            .divider{
                margin-left: 0;
            }
            .divider{
                display: none;
            }

            /* Footer */
            .pc-footer-topline{
                justify-content: center;
            }
            .pc-footer-links-inline{
                justify-content: center;
            }
            .pc-footer-mid{
                justify-content: center;
            }
            .pc-footer-social{
                justify-content: center;
            }
            .pc-footer-contact p{
                text-align: center;
            }

            .pc-gallery-tile{
                grid-column: span 6;
            }
            .pc-gallery-tile.span-6{
                grid-column: span 12;
            }
            .pc-gallery-tile.span-3{
                grid-column: span 6;
            }
        }

        @media (max-width: 575.98px){
            #coaching .coaching .row > .col-2{
                flex: 0 0 100% !important;
                width: 100% !important;
            }
            .glass-box{
                padding: 28px 18px;
                top: 40px;
            }
            .glass-box h1{
                font-size: 24px;
            }
            .pc-gallery-tile{
                grid-column: span 12;
            }
            .pc-gallery-tile.row-2{
                grid-row: span 1;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid" id="home">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
        <div class="container">
            <a class="navbar-brand text-white fw-bold d-flex align-items-center gap-2" href="#home">
                <img class="pc-brand-logo" src="images/logo.png" alt="ParikshaChakra Logo">
                <span class="d-none d-sm-inline" style="letter-spacing:.6px;">PARIKSHA CHAKRA</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="menu">
                <ul class="navbar-nav gap-1">
                    <li class="nav-item"><a class="nav-link text-white" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#teacher">Teacher</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#coaching">Coaching</a></li>
                </ul>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-4">Login</a>
                <a href="{{ route('register') }}" class="btn btn-warning rounded-pill px-4 fw-bold" style="background: linear-gradient(135deg, var(--pc-amber), #ffcc6a); border: 0;">Register</a>
            </div>
        </div>
    </nav>
    <div class="row">
        <section class="banner">
            <div class="overlay"></div>
            <div class="glass-box">
                <h1>Welcome To ParikshaChakra, Competition Classes</h1>
                <p>Learn boldly. Live to inspire.</p>
                <div class="btns">
                    <a class="btn1" href="{{ route('register') }}">Register Now</a>
                    <a class="btn2" href="#coaching">Explore Courses</a>
                </div>
            </div>
        </section>
    </div>
<div class="row" id="coaching">
    <div class="coaching py-5" style="width: 100%;">
        <h2 class="pc-section-title text-center mb-4">Our Coaching</h2>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-2 py-4" id="i">
                <label>10+<br>Expert Teachers</label>
            </div>
            <div class="col-2 py-4" id="i">
                <label>100%<br>Job Assurance</label>
            </div>
            <div class="col-2 py-4" id="i">
                <label><i class="fa fa-laptop"></i><br>Live Classes</label>
            </div>
            <div class="col-2 py-4" id="i">
                <label><i class="fa fa-book"></i><br>Daily Notes</label>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

    <div class="about" id="about">
       <div class="row">
           <div class="col-6">
               <img src="images/himanshu.jpeg" style="height: 400px; width: 400px; display: flex; position: relative; border-radius: 20px; border: 10px solid black; margin-top: 100px; margin-left: 100px;">
               <img src="images/logo.png" style="height: 300px; width: 300px; display: flex; position: absolute; margin-left: 320px; margin-top: -200px; z-index: 1; background-color: black; border-radius: 20px; border: 10px solid white;">
           </div>
           <div class="col-6">
               <h2 class="pc-section-title text-center mt-5 mb-3">About Coaching</h2>
               <p class="pc-section-subtitle text-center fs-5 px-3">Parikshachakra Competition is a digital coaching platform primarily
                   focused on preparing students for government job examinations in India. It is accessible through a mobile application developed by Learning Solution Hub. and web also developed by Er_Shivansh kumar</p>
               <div class="row">
                   <div class="mt-4">

                       <!-- Icons Row -->
                       <div class="d-flex align-items-center">

                           <div class="feature-box">
                               <div class="icon-circle">
                                   <i class="fa fa-envelope"></i>
                               </div>
                               <h5 class="mb-0">parikshachakra@gmail.com</h5>
                           </div>

                           <div class="divider"></div>

                           <div class="feature-box">
                               <div class="icon-circle">
                                   <i class="fa fa-phone"></i>
                               </div>
                               <h5 class="mb-0">+91 91259 12222</h5>
                           </div>

                       </div><br>

                       <!-- List -->
                       <ul class="about-list mt-4">
                           <li style="color: black;">Delivering precision and detail in every project.</li>
                           <li style="color: black;">Your satisfaction is our top priority.</li>
                           <li style="color: black;">Ensuring lasting beauty and durability.</li>
                       </ul>
                       <a href="javascript:void(0)" class="btn btn-danger rounded-pill px-4 fw-bold mt-3" style="box-shadow: 0 12px 30px rgba(220,53,69,0.25);">Read More</a>

                   </div>
               </div>
           </div>
       </div>
        <br>
        <br>
        <br>
        <br>

{{--teachers area--}}
<div class="row">
        <div class="teacher" id="teacher">
            <h2 class="pc-section-title text-center pt-5 mb-1">Our Expert Teachers</h2>
            <p class="pc-section-subtitle text-center mb-4">Meet the mentors guiding your success.</p>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    <!-- Card 1 -->
                    <div class="swiper-slide">
                        <div class="card">
                            <div class="card-top"></div>
                            <img src="images/himanshu.jpeg">
                            <div class="card-body">
                                <h3>Mr_Himanshu Kumar Nag</h3>
                                <p>Director</p>
                                <div class="social">
                                   <i class="fa fa-facebook"></i>
                                    <i class="fa fa-whatsapp"></i>
                                    <i class="fa fa-linkedin"></i>
                                    <i class="fa fa-twitter"></i>
                                </div>
                                <button class="bt">Read More</button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="swiper-slide">
                        <div class="card">
                            <div class="card-top"></div>
                            <img src="images/vishal.jpeg">
                            <div class="card-body">
                                <h3>Mr_Vishal vishnoi</h3>
                                <p>Teacher</p>
                                <div class="social">
                                    <i class="fa fa-facebook"></i>
                                    <i class="fa fa-whatsapp"></i>
                                    <i class="fa fa-linkedin"></i>
                                    <i class="fa fa-twitter"></i>
                                </div>
                                <button class="bt">Read More</button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="swiper-slide">
                        <div class="card">
                            <div class="card-top"></div>
                            <img src="images/priyanka.jpeg">
                            <div class="card-body">
                                <h3>Mrs_Preeti mam</h3>
                                <p>Teacher</p>
                                <div class="social">
                                    <i class="fa fa-facebook"></i>
                                    <i class="fa fa-whatsapp"></i>
                                    <i class="fa fa-linkedin"></i>
                                    <i class="fa fa-twitter"></i>
                                </div>
                                <button class="bt">Read More</button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="swiper-slide">
                        <div class="card">
                            <div class="card-top"></div>
                            <img src="images/nitin.jpeg">
                            <div class="card-body">
                                <h3>Mr_Nitin Saini</h3>
                                <p>Teacher</p>
                                <div class="social">
                                    <i class="fa fa-facebook"></i>
                                    <i class="fa fa-whatsapp"></i>
                                    <i class="fa fa-linkedin"></i>
                                    <i class="fa fa-twitter"></i>
                                </div>
                                <button class="bt">Read More</button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

        </div>

{{--gallery area--}}
<div class="row pc-gallery py-5" id="gallery">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-2 mb-4">
            <div>
                <h2 class="pc-section-title mb-1">Gallery</h2>
                <p class="pc-section-subtitle mb-0">A quick look at coaching vibes, classes, and highlights.</p>
            </div>
        </div>

        <div class="pc-gallery-grid">
            <div class="pc-gallery-tile span-6 row-2" style="--h: 360px;">
                <img src="images/coaching.jpg" alt="Gallery photo 1">
                <div class="pc-gallery-meta">
                    <p class="t">Classroom</p>
                    <span class="tag"><i class="fa fa-book me-1"></i>Study</span>
                </div>
            </div>
            <div class="pc-gallery-tile span-3" style="--h: 170px;">
                <img src="images/coaching.jpg" alt="Gallery photo 2">
                <div class="pc-gallery-meta">
                    <p class="t">Notes</p>
                    <span class="tag"><i class="fa fa-pencil me-1"></i>Daily</span>
                </div>
            </div>
            <div class="pc-gallery-tile span-3" style="--h: 170px;">
                <img src="images/coaching.jpg" alt="Gallery photo 3">
                <div class="pc-gallery-meta">
                    <p class="t">Live Class</p>
                    <span class="tag"><i class="fa fa-laptop me-1"></i>Live</span>
                </div>
            </div>
            <div class="pc-gallery-tile span-3" style="--h: 210px;">
                <img src="images/coaching.jpg" alt="Gallery photo 4">
                <div class="pc-gallery-meta">
                    <p class="t">Mentors</p>
                    <span class="tag"><i class="fa fa-users me-1"></i>Team</span>
                </div>
            </div>
            <div class="pc-gallery-tile span-3" style="--h: 210px;">
                <img src="images/coaching.jpg" alt="Gallery photo 5">
                <div class="pc-gallery-meta">
                    <p class="t">Practice</p>
                    <span class="tag"><i class="fa fa-clock-o me-1"></i>Routine</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{--contact area--}}
<div class="row pc-contact py-5" id="contact">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-2 mb-4">
            <div>
                <h2 class="pc-section-title mb-1">Contact Us</h2>
                <p class="pc-section-subtitle mb-0">Tell us what you need. We will get back quickly.</p>
            </div>
        </div>

        @if (session('contact_status'))
            <div class="alert alert-success mb-4" role="alert">
                {{ session('contact_status') }}
            </div>
        @endif

        <div class="row g-4 align-items-stretch">
            <div class="col-lg-5">
                <div class="pc-contact-card pc-contact-sticker h-100">
                    <div class="pc-sticker-inner">
                        <div class="pc-sticker-mark"><i class="fa fa-comments-o"></i></div>
                        <img src="images/logo.png" class="pc-sticker-logo" alt="ParikshaChakra Logo">
                        <h3 class="pc-sticker-title">Ask Anything</h3>
                        <p class="pc-sticker-sub">Admissions, courses, fees, or guidance. Send a message.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="pc-contact-card h-100">
                    <div class="head d-flex align-items-center justify-content-between gap-2 flex-wrap">
                        <div class="fw-bold">Send a Message</div>
                        <div class="small" style="opacity:.9;">We usually reply the same day</div>
                    </div>
                    <div class="body">
                        <form class="pc-contact-form" method="post" action="{{ route('contact.submit') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" for="c_name">Full Name</label>
                                    <input class="form-control" id="c_name" name="name" type="text" placeholder="Your name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" for="c_phone">Phone</label>
                                    <input class="form-control" id="c_phone" name="phone" type="tel" placeholder="+91" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold" for="c_email">Email</label>
                                    <input class="form-control" id="c_email" name="email" type="email" placeholder="name@example.com" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold" for="c_msg">Message</label>
                                    <textarea class="form-control" id="c_msg" name="message" rows="5" placeholder="Write your message..." required></textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
                                <div class="small text-muted">By sending, you agree to be contacted.</div>
                                <button class="btn pc-send" type="submit"><i class="fa fa-paper-plane me-1"></i>Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--footer area--}}
    <div class="footer pc-footer" id="footer">
        <div class="container py-5">
            <div class="pc-footer-card">
                <div class="pc-footer-topline">
                    <img src="images/logo.png" class="pc-footer-logo" alt="ParikshaChakra Logo">
                    <div class="pc-footer-links-inline" aria-label="Footer links">
                        <a href="#home">Home</a>
                        <a href="#about">About</a>
                        <a href="#gallery">Gallery</a>
                        <a href="#contact">Contact</a>
                        <a href="#teacher">Teacher</a>
                        <a href="javascript:void(0)">Notes</a>
                    </div>
                </div>

                <div class="pc-footer-mid">
                    <div class="pc-footer-contact">
                        <p>Contact- +91 91259 12222</p>
                        <p>Email- parikshachakra@gmail.com</p>
                        <p>Address- Moh Bhavaniram NaharKothi Jalaun 285123</p>
                    </div>
                    <div class="pc-footer-social" aria-label="Social links">
                        <div class="pc-social-btn"><i class="fa fa-facebook" id="o"></i></div>
                        <div class="pc-social-btn"><i class="fa fa-whatsapp" id="o"></i></div>
                        <div class="pc-social-btn"><i class="fa fa-instagram" id="o"></i></div>
                        <div class="pc-social-btn"><i class="fa fa-twitter" id="o"></i></div>
                    </div>
                </div>

                <div class="pc-footer-copy">
                    &copy; 2026 www.parikshachakra.edu | All Rights Reserved | Made With &#10084; By Shivansh Kumar Nag
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
</div>
</div>
</body>
<script>

        document.addEventListener("DOMContentLoaded", function () {
        var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        slidesPerGroup: 1,
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 16,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 24,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },

        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</html>
