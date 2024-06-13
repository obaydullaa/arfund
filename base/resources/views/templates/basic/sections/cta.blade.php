@php
    $cta = getContent('cta.content', true);
    $element = getContent('cta.element', false);
    $page = App\Models\Page::where('slug', 'about')->first();
@endphp
<!-- ========== Cta Start Here ========== -->
<section class="cta-area position-relative py-120 bg-img bg-overlay" style="background-image: url({{ getImage(getFilePath('cta') . '/' . @$cta->data_values->background_image) }})">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-9">
                <div class="cta-wrapper text-center white">
                    <div class="section-heading mb-4 text-center">
                        <h3 class="subtitle-big">{{__($cta->data_values->big_heading)}}</h3>
                        <span class="subtitle">{{__($cta->data_values->subheading)}}</span>
                         <h2 class="title-one">{{__($cta->data_values->heading)}}</h2>
                    </div>
                    @forelse ($element as $item)
                        @php
                            $linkType = $item->data_values->link;
                            $url = $linkType == 'systemlink' ? url('/')  .  @$item->data_values->button_url : @$item->data_values->button_url;
                        @endphp
                        <a href="{{$url}}" class="btn btn--base {{$loop->index % 2 != 0 ? 'outline text-white' : ''}} mb-2">
                            {{__(@$item->data_values->button_text)}} <i class="fas fa-angle-double-right"></i>
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========== Cta End Here ========== -->