@php
    $languages = App\Models\Language::all();
    $user = auth()->user();
@endphp
<div class="row ">
    <div class="col-lg-12">
        <div class="dashboard-header-wrap d-flex justify-content-between">
            <div class="header-left d-flex align-items-center">
                <h4 class="title-three mb-0">{{__($pageTitle)}}</h4>
               <button> <i class="fas fa-bars dashboard-show-hide"></i></button>
            </div>
            <div class="header-right">
                <div class="item">
                    <a class="btn btn--base" href="{{ route('user.logout') }}">
                        <i class="fa-solid fa-right-from-bracket"></i> @lang('Logout')
                    </a>
                </div>
                <div class="item">
                    <a class="btn btn--base" href="{{ route('home') }}">
                        <i class="fa-solid fa-house"></i>
                    </a>
                </div>
            </div>
        </div>
    </div> 
</div>

<!-- ====== Responsive breadcrumb start ====== -->
<div class="row ">
    <div class="col-lg-12">
        <div class="dashboard-header-wrap breadcrumb">
            <div class="d-flex justify-content-between">
                <div class="header-left d-flex align-items-center">
                    <h4 class="title-three mb-0">{{__($pageTitle)}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ====== Responsive breadcrumb end ====== -->