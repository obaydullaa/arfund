@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="term-page-detials py-120 section-grey-bg">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-12">
                <div class="privacy-wrapper">
                    <div class="desc mb-5">
                        @php
                            echo $cookie->data_values->description
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=======-** Privacey page End **-=======-->
@endsection