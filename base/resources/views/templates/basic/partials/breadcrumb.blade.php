@php
    $content = getContent('breadcrumb.content', true);
@endphp
<!-- ======== Breadcumb Start Here ======== -->
<section class="breadcumb bg-img bg-overlay" style="background-image: url({{ getImage(getFilePath('breadcrumb') . '/' . @$content->data_values->background_image) }})">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcumb__wrapper">
                    <h2 class="breadcumb__title">{{ __($pageTitle) }}</h2>
                    <ul class="breadcumb__list">
                        <li class="breadcumb__item"><a href="{{route('home')}}" class="breadcumb__link"> <i class="fas fa-home"></i> @lang('Home')</a> </li>
                        <li class="breadcumb__item">/</li>
                        <li class="breadcumb__item"> <span class="breadcumb__item-text">{{ __($pageTitle) }}</span> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======== Breadcumb End Here ======== -->