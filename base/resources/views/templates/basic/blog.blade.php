
@extends($activeTemplate.'layouts.frontend')
@section('content')
<!-- ============= Blog Details Start Here ============= -->
<section class="blog-detials py-120 section-grey-bg">
    <div class="container"> 
        <div class="row gy-4 justify-content-center"> 
            <div class="col-lg-8">
                <div class="row gy-4">
                    @forelse($blogs as $item)
                    <div class="col-lg-6 col-md-6">
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
                
                <div class="row {{ $blogs->hasPages() ? 'my-5' : '' }}">
                    <div class="col-lg-12">
                        @if ($blogs->hasPages())
                            <div class="text-end">
                                <div class="d-flex justify-content-end">
                                    {{ $blogs->links() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- ============ Blog Details Sidebar Start ======= -->
                <div class="blog-sidebar-wrapper">
                    <div class="blog-sidebar">
                        <h5 class="blog-sidebar__title">@lang('Latest Topics')</h5>
                        @forelse($latests as $item)
                        <div class="latest-blog">
                            <div class="latest-blog__thumb">
                                <a href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id]) }}"> 
                                    <img src="{{ getImage(getFilePath('blog') . '/' . @$item->data_values->image) }} " alt="@lang('image')">
                                </a>
                            </div>
                            <div class="latest-blog__content">
                                <h6 class="latest-blog__title">
                                    <a href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id]) }}">
                                        @if(strlen(__($item->data_values->title)) >50)
                                        {{substr( __($item->data_values->title), 0,50).'...' }}
                                        @else
                                        {{__($item->data_values->title)}}
                                        @endif
                                    </a>
                                </h6>
                                <span class="latest-blog__date"> {{$item->created_at->format('d')}} {{$item->created_at->format('M')}} {{$item->created_at->format('Y')}}</span>
                            </div>
                        </div>
                        @empty

                        @endforelse
                    </div>
                </div>
                <!-- ============ Blog Details Sidebar End ======= -->
            </div>
        </div>
    </div>
</section>

    @if(@$sections->secs != null)
    @foreach(json_decode($sections->secs) as $sec)
        @include($activeTemplate.'sections.'.$sec)
    @endforeach
    @endif
@endsection