@forelse($campaigns as $item)
<div class="col-lg-4 col-md-6">
    <div class="campaign-box">
        <a class="link" href="{{ route('campaign.details', ['slug' => slug($item->title), 'id' => $item->id]) }}"></a>
        <div class="campaign-box__thumb">
            <img src="{{ getImage(getFilePath('campaignImg') . '/' . $item->image) }}" alt="@lang('Image')">
        </div>
        <div class="campaign-box__bottom">
            <img class="campaign-shape-bg " src="{{asset($activeTemplateTrue . 'images/campaign/campaign-shape-bg-1.png')}}" alt="@lang('image')">
            <div class="campaign-box__skill-bar">
                @php 
                    $donation = fetchDonationCount($item->id);
                    $collectPercent = showAmount(($donation * 100 / $item->goal), 2);
                    $displayPercent = $collectPercent > 100 ? 100 : $collectPercent;
                @endphp
                <div class="progressbar" data-perc="{{ $displayPercent }}%">
                    <div class="bar" style="width: {{ $displayPercent }}%;"></div>
                    <span class="label" style="left: {{ $displayPercent }}%;">{{ $collectPercent > 100 ? 100 : $collectPercent }}%</span>
                </div>
                <ul class="progress-tag">
                    <li class="raised">@lang('Raised'): <span>{{ $general->cur_sym }} {{ showAmount(fetchDonationCount($item->id)) }}</span></li>
                    <li class="raised">@lang('Goal'): <span>{{ $general->cur_sym }} {{ showAmount(@$item->goal,2) }}</span></li>
                </ul> 
            </div>
            <div class="campaign-box__tag-wrap">
                <div class="tag"><i class="fa-solid fa-tags"></i> {{ $item->category->name }}</div>
                <div class="date"><i class="fa-solid fa-calendar-days"></i>
                    {{ ceil(now()->diffInDays(Carbon\Carbon::parse($item->date))) }} @lang('Days left') 
                    <br><small class="date-small">{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</small>
                </div>
            </div>
            
            <div class="campaign-box__content">
                <h4 class="title-two"> {{ __(StrLimit($item->title, 45)) }}</h4>
                <p> {{strLimit(strip_tags($item->description), 95) }}</p>
            </div>
        </div>
    </div>    
</div>
@empty
<h4 class="text-center">{{__($emptyMessage)}}</h4>
@endforelse