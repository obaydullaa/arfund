<!-- template top -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->siteName($pageTitle ?? '419 | Session has expired') }}</title>
    <link rel="shortcut icon" href="{{ siteFavicon() }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ siteLogo() }}">
    <link rel="stylesheet" href="{{ asset('assets/general/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/errors/css/main.css') }}">

</head>

<body>

    <section class="error-page bg--img"
        style="background-image: url({{ asset('assets/errors/images/error-bg.png') }});">

        <span class="bg-element1">
            <img src="{{ asset('assets/errors/images/error-element1.png') }}">
        </span>

        <span class="bg-element2">
            <img src="{{ asset('assets/errors/images/error-element1.png') }}">
        </span>


        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-7 col-lg-9 h-100">
                    <div class="error-card2">
                        <div class="row flex-column justify-content-center align-items-center">
                            <div class="col-lg-12 d-flex justify-content-center align-items-center">
                                <div class="thumb-wrap">
                                    <img src="{{ asset('assets/errors/images/error-img1.png') }}">
                                </div>
                            </div>

                            <div class="col-lg-8 d-flex justify-content-center align-items-center">
                                <div class="content-wrap">
                                    <h6 class="title">419</h6>
                                    <p class="subtitle mb-3">@lang('Sorry, Your session has expired please refresh and try again')</p>


                                    <a href="{{ route('home') }}" class="back-btn">@lang('Back to home')</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script src="{{ asset('assets/general/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
