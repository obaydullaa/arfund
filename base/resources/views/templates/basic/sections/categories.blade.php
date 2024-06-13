@php
    $categories = getContent('categories.content', true);
    $categoriesCampaigns = App\Models\Category::active()->inRandomOrder()->get();
@endphp

<!--============ Category Start =============-->
<section class="category-area section-bg py-120 fix">
    <img class="category-bg animate-x-axis" src="{{asset($activeTemplateTrue . 'images/category/category-bg.png')}}" alt="@lang('image')">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-9">
                <div class="section-heading text-center">
                    <h3 class="subtitle-big">{{__($categories->data_values->big_heading)}}</h3>
                    <span class="subtitle">{{__($categories->data_values->subheading)}}</span>
                     <h2 class="title-one">{{__($categories->data_values->heading)}}</h2>
                     <p class="desc">{{__($categories->data_values->description)}}</p>
                 </div>
            </div>
        </div>
        <div class="row category-slider-active justify-content-center">
            @forelse ($categoriesCampaigns as $category)
            <div class="col-lg-2 col-md-6">
                <div class="category-box text-center">
                    <a class="link" href="{{route("category.campaigns", $category->id)}}"></a>
                    <span class="category-box__count">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="category-box__thumb">
                        <img src="{{ getImage(getFilePath('category') . '/' . $category->image, getFileSize('category')) }}" alt="@lang('image')">
                    </div>
                    <div class="category-box__content">
                        <h4 class="title-two">{{ __($category->name) }}</h4>
                    </div>
                </div>    
            </div>
            @empty
            <h4 class="text-center">{{__($emptyMessage)}}</h4>
            @endforelse
        </div>
    </div>
</section>
<!--============ Category End ============-->