@php
    $content = getContent('blog.content', true);
    $elements = getContent('blog.element', false, 3);
@endphp

<!-- ========== Blog Start Here ========== -->
<section class="blog section-bg py-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-9">
                <div class="section-heading text-center">
                    <h3 class="subtitle-big">{{__($content->data_values->big_heading)}}</h3>
                    <span class="subtitle">{{__($content->data_values->subheading)}}</span>
                    <h2 class="title-one">{{__($content->data_values->heading)}}</h2>
                    <p class="desc">{{__($content->data_values->description)}}</p>
                 </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @forelse($elements as $item)
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <div class="blog-item__thumb">
                        <a href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id]) }}" class="blog-item__thumb-link">
                            <img src="{{ getImage(getFilePath('blog') . '/' . @$item->data_values->image) }} " alt="@lang('image')">
                        </a>
                    </div>
                    <div class="blog-item__content">
                        <ul class="text-list inline">
                            <li class="text-list__item"> <span class="text-list__item-icon"><i class="fas fa-user"></i></span> @lang('Admin')</li>
                            <li class="text-list__item"> <span class="text-list__item-icon"><i class="fas fa-calendar-alt"></i></span>
                                {{$item->created_at->format('d')}} {{$item->created_at->format('M')}} {{$item->created_at->format('Y')}}
                            </li>
                        </ul>
                        <h4 class="title-two">
                            <a href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id]) }}" class="title-two-link">
                                @if(strlen(__($item->data_values->title)) >50)
                                {{substr( __($item->data_values->title), 0,50).'...' }}
                                @else
                                {{__($item->data_values->title)}}
                                @endif
                            </a>
                        </h4>
                        <p class="mb-2">
                            @if(strlen(__($item->data_values->description_editor)) > 100)
                                @php echo strip_tags(substr($item->data_values->description_editor, 0 , 100)) .'...'; @endphp
                            @else
                                @php echo  strip_tags($item->data_values->description_editor); @endphp
                            @endif
                        </p>
            
                        <a href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id]) }}" class="btn--simple">
                            @lang('Read More')<span class="btn--simple__icon"><i class="fas fa-arrow-right"></i></span> 
                        </a>
                    </div>
                </div>
            </div>
            @empty

            @endforelse
        </div>
    </div>
</section>
<!-- ========== Blog End Here ========== -->