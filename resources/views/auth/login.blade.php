@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="auth-card">

        {{-- Role Selector --}}
        <div class="d-flex mb-4 gap-2" style="background:#f5f0ff; border-radius:16px; padding:6px;">
            <button type="button" id="btn-user" onclick="selectRole('user')"
                style="flex:1; border:none; border-radius:12px; padding:10px; font-weight:600; font-size:0.95rem; cursor:pointer; transition:all 0.3s; background: linear-gradient(135deg,#667eea,#764ba2); color:white; box-shadow: 0 4px 12px rgba(102,126,234,0.3);">
                <i class="fas fa-user me-1"></i> User
            </button>
            <button type="button" id="btn-admin" onclick="selectRole('admin')"
                style="flex:1; border:none; border-radius:12px; padding:10px; font-weight:600; font-size:0.95rem; cursor:pointer; transition:all 0.3s; background:transparent; color:#764ba2;">
                <i class="fas fa-shield-alt me-1"></i> Admin
            </button>
        </div>

        {{-- Title changes based on role --}}
        <h2 class="auth-title text-center" id="login-title"><i class="fas fa-sign-in-alt"></i> Welcome Back</h2>
        <p class="text-center text-muted mb-4" id="login-subtitle">Sign in to continue your journey</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="role" id="role-input" value="user">

            <div class="mb-4">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="your@email.com" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label text-muted" for="remember">Remember Me</label>
                </div>
                <a href="{{ route('password.request') }}" style="color: #764ba2; font-weight: 600; font-size: 0.9rem;">
                    <i class="fas fa-key"></i> Forgot Password?
                </a>
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 py-3" style="font-size:1.1rem; border-radius:14px;">
                <i class="fas fa-sign-in-alt me-1"></i> <span id="login-btn-text">Login as User</span>
            </button>
        </form>

        <hr style="border-color: #e8e0f5; margin: 25px 0;">

        <p class="text-center text-muted mb-0">
            Don't have an account?
            <a href="/register" style="color: #764ba2; font-weight: 600;">Sign Up</a>
        </p>
    </div>
</div>

<script>
function selectRole(role) {
    const btnUser  = document.getElementById('btn-user');
    const btnAdmin = document.getElementById('btn-admin');
    const title    = document.getElementById('login-title');
    const subtitle = document.getElementById('login-subtitle');
    const btnText  = document.getElementById('login-btn-text');
    const input    = document.getElementById('role-input');

    const activeStyle  = 'background: linear-gradient(135deg,#667eea,#764ba2); color:white; box-shadow: 0 4px 12px rgba(102,126,234,0.3);';
    const inactiveStyle = 'background:transparent; color:#764ba2; box-shadow:none;';

    if (role === 'user') {
        btnUser.style.cssText  += activeStyle;
        btnAdmin.style.cssText += inactiveStyle;
        title.innerHTML    = '<i class="fas fa-sign-in-alt"></i> Welcome Back';
        subtitle.textContent = 'Sign in to continue your journey';
        btnText.textContent  = 'Login as User';
        input.value = 'user';
    } else {
        btnAdmin.style.cssText += activeStyle;
        btnUser.style.cssText  += inactiveStyle;
        title.innerHTML    = '<i class="fas fa-shield-alt"></i> Admin Access';
        subtitle.textContent = 'Sign in to manage your blog';
        btnText.textContent  = 'Login as Admin';
        input.value = 'admin';
    }
}
</script>
@endsection