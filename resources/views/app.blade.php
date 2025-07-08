<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web-installer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .main {
            background: url("https://i.ibb.co/2YjmfvQY/Installer.jpg");
            width: 100%;
            height: 100vh;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: bottom;
        }

        .opachity {
            background: #00000030;
            width: 100%;
            height: 100%;
        }

        .fs-7 {
            font-size: 0.75rem !important;
        }

        .fw-500 {
            font-weight: 500 !important;
        }

        .fw-600 {
            font-weight: 600 !important;
        }

        .w-80 {
            width: 80% !important;
        }

        .btn-install {
            width: 280px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 20px;
            background: linear-gradient(to right, #e90608 0%, #f59e39 100%);
            box-shadow: 0px 8px 16px rgba(255, 88, 0, 0.16);
            font-weight: bold;
            font-size: 14px;
            line-height: 18px;
            text-align: center;
            color: #fff !important;
            transition: all 0.5s;
        }

        .btn-install:hover {
            box-shadow: 0px 8px 40px rgb(255 88 0 / 30%);
            letter-spacing: 0.3px;
        }

        .move-right{
            position: absolute;
            right: 10px
        }
        .loader{
            position: absolute;
            z-index: 999;
            width: 100%;
            height: 100%;
            background: #d9d9d982;
            top: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <main class="main">
        <div class="opachity">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>

</html>
