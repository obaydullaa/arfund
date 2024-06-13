<!-- template top -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->siteName($pageTitle ?? '404 | page not found') }}</title>
    <link rel="shortcut icon" href="{{ siteFavicon() }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ siteLogo() }}">
    <link rel="stylesheet" href="{{ asset('assets/general/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/errors/css/main.css') }}">

</head>

<body>


    <!-- login section -->
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
                <div class="col-lg-10 h-100">
                    <div class="error-card">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="content-wrap">
                                    <h6 class="title">404</h6>
                                    <p class="subtitle">@lang('Something went')</p>
                                    <p class="subtitle-bold">@lang('WRONG')</p>

                                    <a href="{{ route('home') }}" class="back-btn">@lang('Back to home')</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="thumb-wrap">
                                    <img src="{{ asset('assets/errors/images/error-img.png') }}"
                                        alt="@lang('image')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <script src="{{ asset('assets/general/js/jquery-3.7.1.min.js') }}"></script>

    <script src="{{ asset('assets/general/js/bootstrap.bundle.min.js') }}"></script>


</body>

</html>
