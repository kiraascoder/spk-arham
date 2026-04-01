<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Bibit Kangkung' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7f5;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 0 auto;
        }

        .navbar {
            background: #2f855a;
            color: white;
            padding: 16px 0;
        }

        .navbar-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 18px;
            align-items: center;
        }

        .nav-links a {
            color: white;
            font-size: 14px;
        }

        .nav-links a:hover {
            opacity: .85;
        }

        .hero {
            padding: 70px 0;
        }

        .hero-box {
            background: white;
            border-radius: 14px;
            padding: 40px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        .hero h1 {
            font-size: 34px;
            margin-bottom: 14px;
            color: #1f2937;
        }

        .hero p {
            font-size: 16px;
            line-height: 1.7;
            color: #555;
            margin-bottom: 24px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: .2s;
        }

        .btn-primary {
            background: #2f855a;
            color: white;
        }

        .btn-primary:hover {
            background: #276749;
        }

        .btn-outline {
            border: 1px solid #2f855a;
            color: #2f855a;
            background: transparent;
        }

        .btn-outline:hover {
            background: #2f855a;
            color: white;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            max-width: 420px;
            margin: 50px auto;
        }

        .card h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #1f2937;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
        }

        .form-control:focus {
            border-color: #2f855a;
        }

        .text-center {
            text-align: center;
        }

        .mt-2 { margin-top: 8px; }
        .mt-3 { margin-top: 16px; }
        .mt-4 { margin-top: 24px; }

        .footer {
            text-align: center;
            padding: 24px 0;
            color: #666;
            font-size: 14px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .feature-item {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.05);
        }

        .feature-item h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #2f855a;
        }

        .feature-item p {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .navbar-wrapper {
                flex-direction: column;
                gap: 12px;
            }

            .hero h1 {
                font-size: 28px;
            }

            .hero-box {
                padding: 24px;
            }
        }
    </style>
</head>
<body>

    @include('partials.navbar')

    <main class="container">
        @yield('content')
    </main>

    <div class="footer">
        &copy; {{ date('Y') }} Sistem Pemilihan Bibit Unggul Kangkung
    </div>

</body>
</html>
