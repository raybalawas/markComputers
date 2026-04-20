<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Auth</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1e3a8a, #2563eb, #60a5fa);
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            z-index: 0;
        }

        body::before {
            width: 240px;
            height: 240px;
            top: -60px;
            left: -60px;
        }

        body::after {
            width: 280px;
            height: 280px;
            bottom: -80px;
            right: -80px;
        }

        .auth-container {
            width: 100%;
            max-width: 430px;
            background: #fff;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 2;
            animation: fadeUp 0.5s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand-title {
            text-align: center;
            margin-bottom: 10px;
            font-size: 28px;
            font-weight: 700;
            color: #1e3a8a;
        }

        .brand-subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .auth-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 22px;
            color: #111827;
            font-weight: 700;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .alert-danger ul {
            padding-left: 18px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
        }

        .form-control {
            width: 100%;
            height: 48px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 0 14px;
            font-size: 15px;
            transition: 0.3s;
            outline: none;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .btn-primary {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 10px;
            background: #2563eb;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 8px;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #475569;
        }

        .auth-footer a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        /* Tablet */
        @media (max-width: 768px) {
            .auth-container {
                max-width: 90%;
                padding: 28px;
            }

            .brand-title {
                font-size: 24px;
            }

            .auth-title {
                font-size: 22px;
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            body {
                padding: 15px;
                align-items: flex-start;
                padding-top: 40px;
            }

            .auth-container {
                max-width: 100%;
                padding: 22px;
                border-radius: 14px;
            }

            .brand-title {
                font-size: 22px;
            }

            .brand-subtitle {
                font-size: 13px;
                margin-bottom: 22px;
            }

            .auth-title {
                font-size: 20px;
                margin-bottom: 18px;
            }

            .form-control,
            .btn-primary {
                height: 45px;
                font-size: 14px;
            }

            .form-group label {
                font-size: 13px;
            }

            body::before {
                width: 160px;
                height: 160px;
            }

            body::after {
                width: 180px;
                height: 180px;
            }
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <div class="brand-title">Mark Computer Center</div>
        <div class="brand-subtitle">Super Admin Panel Access</div>

        @yield('content')
    </div>

</body>
</html>