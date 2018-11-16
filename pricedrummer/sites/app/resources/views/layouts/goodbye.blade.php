<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="token" content="{{ csrf_token() }}">
    <title>Thank you for visiting our site</title>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <style>
        .container {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            margin: 0 auto;
        }

        .message_container {
            width: 80%;
            margin: 150px auto;
            text-align: center;
            box-shadow: 0 0 4px #DDD;
            padding: 20px;
        }

        .message_container p.link {
            font-size: 18px;
        }

        .message_container #merchant_logo {
            margin-top: 0;
            margin-left: -20px;
        }

        .message_container #site_logo {
            width: 200px;
        }

        img#merchant_logo {
            margin-left: 30px;
        }

        .message_container #preloader {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    @yield('content')

    @yield('script')
</body>
</html>

