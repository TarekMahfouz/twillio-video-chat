<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Video Chat</title>

        <link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        @stack('styles')
    </head>
    <body>
        <div class="container-fluid">

            <div class="row mb-3">
                <nav class="navbar navbar-light bg-light justify-content-between col-md-12">
                    <a class="navbar-brand">Video Conference</a>
                    <div class="col-md-2">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <a href="{{ route('twillio.create.room') }}">Create Room</a>
                            &nbsp;|&nbsp;
                            <a href="{{ route('twillio.logout') }}">Logout</a>
                        @endif
                    </div>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-12 mr-1 ml-1">
                    @yield('content')
                </div>
            </div>
        </div>


        @stack('scripts')
    </body>
</html>
