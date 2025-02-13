<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Reservation</title>
    </head>
    <body style="background-image: url({{asset('pictures/home_background.jpg')}});
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                font-family: Arial, Helvetica, sans-serif" class="bg-dark">
                <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
                    <div class="container-fluid">
                        <a class="navbar-brand text-uppercase">رزرو اقامتگاه</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        @auth
                        <div>
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="btn-sm btn btn-danger btn-link text-decoration-none text-white" type="submit">Logout</button>
                            </form>
                        </div>
                        @else
                        <div>
                            <a href="{{ route('login') }}" class="btn-sm btn btn-primary btn-link text-decoration-none text-white" type="button">Login</a>
                        </div>
                        @endauth
                    </div>
                </nav>
    @yield('content')
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script></html>

