<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Belajar Vue</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>

        <div class="container" id="app" style="border:1px solid;">
            <div class="row">
                <div class="col-lg-12">
                    <blog></blog>
                </div>
                <!-- <div class="col-lg-6">
                    <paginate></paginate>
                </div> -->
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
