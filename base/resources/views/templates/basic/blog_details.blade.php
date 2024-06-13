@extends($activeTemplate.'layouts.frontend')
@section('content')
<!-- ============= Blog Details Start Here ============= -->
<section class="blog-detials py-120">
    <div class="container">
        <div class="row gy-5 justify-content-center"> 
            <div class="col-lg-8">
                <div class="blog-details">
                    <div class="blog-item">
                        <div class="blog-item__thumb mb-3">
							<img src="{{ getImage(getFilePath('blog') . '/' . @$blog->data_values->image) }} " alt="@lang('image')">
                        </div>
                        <div class="blog-item__content ps-0">
                            <ul class="text-list inline">
                                <li class="text-list__item"> <span class="text-list__item-icon">
									<i class="fas fa-calendar-alt"></i></span> 
									{{$blog->created_at->format('d')}} {{$blog->created_at->format('M')}} {{$blog->created_at->format('Y')}}
								</li>
                            </ul>
                        </div>
                    </div>
                   <div class="blog-details__content">
                        <h3 class="title-two">{{__($blog->data_values->title)}}</h3>
                        <p class="blog-details__desc">
						@php echo $blog->data_values->description_editor @endphp
						</p>
                        <div class="blog-details__share mt-4 d-flex align-items-center flex-wrap mb-4">
                            <h5 class="social-share__title mb-0 me-sm-3 me-1 d-inline-block">@lang('Share This')</h5>
                            <ul class="social-list blog-details">
                                <li class="social-list__item">
                                    <a href="https://www.facebook.com/share.php?u={{ Request::url() }}&title={{ slug($blog->title) }}"
                                        class="social-list__link facebook"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="social-list__item">
                                    <a href="https://twitter.com/intent/tweet?status={{ slug($blog->title) }}+{{ Request::url() }}"
                                        class="social-list__link twitter"> <i class="fa-brands fa-x-twitter"></i></a>
                                </li>
                                <li class="social-list__item">
                                    <a href="https://www.pinterest.com/pin/create/button/?url={{ Request::url() }}&description={{ slug(@$blog->title) }}"
                                        class="social-list__link pinterest"> <i
                                            class="fab fa-pinterest-p"></i></a>
                                </li>
                                <li class="social-list__item">
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ Request::url() }}&title={{ slug($blog->title) }}&source=propertee"
                                        class="social-list__link linkedin"> <i
                                            class="fab fa-linkedin-in"></i></a>
                                </li>
                            </ul>
                        </div>
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
<!-- ============= Blog Details End Here ============= -->
@endsection
@push('fbComment')
	@php echo loadPlugin('fb-comment') @endphp
@endpush