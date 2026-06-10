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

    <h2 class="auth-page-title">Create Super Admin Account</h2>
    <p class="auth-subtitle">Register to access the admin dashboard</p>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('superadmin.register.submit') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter full name"
                required>
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter email"
                required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password"
                required>
        </div>

        <button type="submit" class="btn-primary">Create Account</button>
    </form>

    <div class="auth-footer">
        Already have an account?
        <a href="{{ route('superadmin.login') }}">Login</a>
    </div>
@endsection
