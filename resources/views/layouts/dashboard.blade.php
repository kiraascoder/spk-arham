<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
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

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            background: #2f855a;
            color: white;
            padding: 24px 16px;
        }

        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 25px;
            text-align: center;
        }

        .sidebar .menu a {
            display: block;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .sidebar .menu a:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: white;
            padding: 18px 24px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content {
            padding: 24px;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
        }

        .small-text {
            font-size: 14px;
            color: #666;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 24px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        }

        .card h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #2f855a;
        }

        .card p {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }

        .table-box {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            margin-top: 24px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        table th,
        table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            font-size: 14px;
        }

        table th {
            background: #f9fafb;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #2f855a;
            color: white;
        }

        .btn-primary:hover {
            background: #276749;
        }

        .form-box {
            background: white;
            padding: 24px;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            margin-top: 24px;
            max-width: 700px;
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

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            background: #dcfce7;
            color: #166534;
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">
        @include('partials.sidebar')

        <div class="main">
            <div class="topbar">
                <div>
                    <div class="page-title">{{ $pageTitle ?? 'Dashboard' }}</div>
                    <div class="small-text">{{ $pageDesc ?? 'Halaman sistem' }}</div>
                </div>
                <div class="small-text">
                    Login sebagai: <strong>{{ auth()->user()->role ?? 'guest' }}</strong>
                </div>
            </div>

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
