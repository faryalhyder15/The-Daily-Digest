<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ink Drop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: linear-gradient(135deg, #f8f9ff 0%, #fff0f6 50%, #f0f4ff 100%); color: #2d2d4e; font-family: 'Poppins', sans-serif; min-height: 100vh; }

        /* Navbar */
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%); padding: 15px 0; box-shadow: 0 4px 20px rgba(102,126,234,0.4); }
        .navbar-brand { font-family: 'Playfair Display', serif; font-size: 1.8rem; color: white !important; font-weight: 700; text-shadow: 0 2px 4px rgba(0,0,0,0.2); }
        .nav-link { color: rgba(255,255,255,0.9) !important; font-weight: 500; transition: all 0.3s; }
        .nav-link:hover { color: white !important; transform: translateY(-2px); }
        .btn-nav { background: white; color: #764ba2; border: none; border-radius: 25px; padding: 8px 22px; font-weight: 600; transition: all 0.3s; }
        .btn-nav:hover { background: #f8f0ff; transform: translateY(-2px); box-shadow: 0 4px 15px rgba(255,255,255,0.3); }
        .btn-nav-outline { background: transparent; color: white; border: 2px solid white; border-radius: 25px; padding: 8px 22px; font-weight: 600; transition: all 0.3s; }
        .btn-nav-outline:hover { background: white; color: #764ba2; }

        /* Hero */
        .hero { background: linear-gradient(135deg, #667eea 0%, #764ba2 40%, #f093fb 100%); padding: 100px 0; text-align: center; position: relative; overflow: hidden; }
        .hero::before { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%); }
        .hero h1 { font-family: 'Playfair Display', serif; font-size: 3.5rem; color: white; margin-bottom: 15px; text-shadow: 0 2px 10px rgba(0,0,0,0.2); }
        .hero p { color: rgba(255,255,255,0.9); font-size: 1.2rem; font-weight: 300; }
        .hero-btn { background: white; color: #764ba2; border: none; border-radius: 30px; padding: 14px 40px; font-size: 1.1rem; font-weight: 600; transition: all 0.3s; box-shadow: 0 8px 25px rgba(0,0,0,0.2); }
        .hero-btn:hover { transform: translateY(-3px); box-shadow: 0 12px 35px rgba(0,0,0,0.3); color: #764ba2; }

        /* Cards */
        .card { background: white; border: none; border-radius: 20px; box-shadow: 0 8px 30px rgba(102,126,234,0.1); transition: all 0.3s; overflow: hidden; }
        .card:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(102,126,234,0.2); }
        .card-title { font-family: 'Playfair Display', serif; font-size: 1.2rem; color: #2d2d4e; }
        .card-title a { color: #2d2d4e; text-decoration: none; transition: color 0.3s; }
        .card-title a:hover { color: #764ba2; }
        .card-text { color: #888; font-size: 0.92rem; line-height: 1.7; }
        .card-footer { background: linear-gradient(135deg, #f8f9ff, #fff0f6) !important; border-top: 1px solid #f0e6ff !important; }

        /* Post image */
        .post-image { width: 100%; height: 200px; object-fit: cover; }
        .post-placeholder { background: linear-gradient(135deg, #667eea, #f093fb); height: 200px; display: flex; align-items: center; justify-content: center; }

        /* Badge */
        .badge-category { background: linear-gradient(135deg, #667eea, #764ba2); color: white; padding: 5px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }

        /* Buttons */
        .btn-primary-custom { background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; border-radius: 25px; padding: 8px 22px; font-weight: 500; transition: all 0.3s; }
        .btn-primary-custom:hover { background: linear-gradient(135deg, #764ba2, #f093fb); color: white; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(102,126,234,0.4); }
        .btn-outline-custom { border: 2px solid #764ba2; color: #764ba2; border-radius: 25px; padding: 8px 22px; background: transparent; font-weight: 500; transition: all 0.3s; }
        .btn-outline-custom:hover { background: linear-gradient(135deg, #667eea, #764ba2); color: white; border-color: transparent; }
        .btn-pink { background: linear-gradient(135deg, #f093fb, #f5576c); color: white; border: none; border-radius: 25px; padding: 8px 22px; font-weight: 500; transition: all 0.3s; }
        .btn-pink:hover { opacity: 0.9; color: white; transform: translateY(-2px); }

        /* Post body */
        .post-body { font-size: 1.1rem; line-height: 1.9; color: #444; }
        .post-meta { color: #aaa; font-size: 0.9rem; }

        /* Comments */
        .comment-box { background: linear-gradient(135deg, #f8f9ff, #fff0f6); border-left: 4px solid #764ba2; border-radius: 12px; padding: 18px 20px; margin-bottom: 15px; }
        .comment-author { background: linear-gradient(135deg, #667eea, #f093fb); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; }

        /* Forms */
        .form-control { border: 2px solid #e8e0f5; border-radius: 12px; padding: 12px 16px; background: white; color: #2d2d4e; transition: all 0.3s; }
        .form-control:focus { border-color: #764ba2; box-shadow: 0 0 0 4px rgba(118,75,162,0.1); color: #2d2d4e; background: white; }
        .form-label { color: #764ba2; font-weight: 600; margin-bottom: 6px; }

        /* Alerts */
        .alert-success { background: linear-gradient(135deg, #d4f5e9, #b8f0d8); border: none; border-radius: 12px; color: #1a7a4a; }
        .alert-danger { background: linear-gradient(135deg, #fde8e8, #ffd0d0); border: none; border-radius: 12px; color: #c0392b; }

        /* Section title */
        .section-title { font-family: 'Playfair Display', serif; background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 2rem; }

        /* Auth card */
        .auth-card { background: white; border-radius: 24px; padding: 45px; box-shadow: 0 20px 60px rgba(102,126,234,0.15); max-width: 480px; margin: 60px auto; }
        .auth-title { font-family: 'Playfair Display', serif; background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 2rem; margin-bottom: 10px; }

        /* Footer */
        .footer { background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%); padding: 40px 0 25px; margin-top: auto; }

        /* Social icon buttons */
        .social-icon {
            background: rgba(255,255,255,0.2);
            color: white;
            width: 42px; height: 42px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 1rem;
        }
        .social-icon:hover { background: rgba(255,255,255,0.4); color: white; transform: translateY(-3px); }

        /* Decorative dots */
        .dot-decoration { width: 10px; height: 10px; border-radius: 50%; display: inline-block; }

        /* fw-600 */
        .fw-600 { font-weight: 600; }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/"> The Daily Digest</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item"><a class="nav-link" href="/"> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/about"> About</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="/profile"> Profile</a></li>
                    <li class="nav-item ms-2">
                        <form action="/logout" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-nav-outline">
                                {{ auth()->user()->name }} <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/login"> Login</a></li>
                    <li class="nav-item"><a class="btn btn-nav ms-2" href="/register"> Sign up</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="flex-grow-1">@yield('content')</main>

{{-- Footer --}}
<footer class="footer">
    <div class="container">
        <div class="row align-items-center text-center text-md-start">

            {{-- Brand --}}
            <div class="col-md-6 mb-4">
                <h4 style="font-family: 'Playfair Display', serif; color: white; font-size: 1.8rem;">
                    <i class="fas fa-feather-alt"></i> The Daily Digest
                </h4>
                <p style="color: rgba(255,255,255,0.8); font-size: 0.92rem; line-height: 1.7; max-width: 320px;">
                    A beautiful place for thoughts, stories and ideas. Share your journey with the world.
                </p>
            </div>

            {{-- Social Links --}}
            <div class="col-md-6 mb-4 text-md-end text-center">
                <p style="color: rgba(255,255,255,0.7); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 600; margin-bottom: 14px;">Follow Us</p>
                <div class="d-flex justify-content-md-end justify-content-center gap-2">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-github"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <hr style="border-color: rgba(255,255,255,0.2); margin: 10px 0 18px;">
        <p class="text-center mb-0" style="color: rgba(255,255,255,0.8); font-size: 0.88rem;">
            © {{ date('Y') }} The Daily Digest. All rights reserved.
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- Scroll to Top --}}
<button id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" style="display:none; position:fixed; bottom:30px; right:30px; background: linear-gradient(135deg, #667eea, #764ba2); color:white; border:none; width:50px; height:50px; border-radius:50%; font-size:1.2rem; cursor:pointer; box-shadow: 0 8px 25px rgba(102,126,234,0.4); z-index:999; transition: all 0.3s;">
    <i class="fas fa-arrow-up"></i>
</button>
<script>
    window.onscroll = function() {
        const btn = document.getElementById('scrollTop');
        btn.style.display = (document.documentElement.scrollTop > 300) ? 'block' : 'none';
    };
</script>
</body>
</html>