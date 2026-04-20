@extends('superadmin.layouts.auth')

@section('content')
    <style>
        .auth-page-title {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
            text-align: center;
        }

        .auth-subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 28px;
            font-size: 14px;
        }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap .form-control {
            padding-right: 45px;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #64748b;
            font-size: 14px;
            user-select: none;
        }

        .extra-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 14px 0 22px;
            font-size: 14px;
            color: #475569;
        }

        .extra-options label {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .extra-options a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-primary {
            width: 100%;
            height: 48px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .auth-footer {
            margin-top: 20px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        .auth-footer a {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }
    </style>

    {{-- <h2 class="auth-page-title">Super Admin Login</h2>
    <p class="auth-subtitle">Login to manage your admin dashboard</p> --}}

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('superadmin.login.submit') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email"
                required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="input-icon-wrap">
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password"
                    required>
                <span class="password-toggle" onclick="togglePassword()">Show</span>
            </div>
        </div>

        <div class="extra-options">
            <label>
                <input type="checkbox" name="remember">
                Remember me
            </label>

            <a href="#">Forgot Password?</a>
        </div>

        <button type="submit" class="btn-primary">Login</button>
    </form>

    <div class="auth-footer">
        Don’t have an account?
        <a href="{{ route('superadmin.register') }}">Register</a>
    </div>

    <script>
        function togglePassword() {
            let passwordField = document.getElementById('password');
            let toggleText = document.querySelector('.password-toggle');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleText.innerText = 'Hide';
            } else {
                passwordField.type = 'password';
                toggleText.innerText = 'Show';
            }
        }
    </script>
@endsection
