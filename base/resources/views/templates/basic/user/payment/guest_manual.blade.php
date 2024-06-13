@extends($activeTemplate.'layouts.frontend')

@section('content')
<section class="py-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="dashboard-card-wrap">
                        <h5 class="title-two">{{__($pageTitle)}}</h5>
                    <div class="card-body  ">
                        <form action="{{ route('deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="mt-2 mb-2">@lang('You have requested') <b class="text-success">{{ showAmount($data['amount'])  }} {{__($general->cur_text)}}</b> , @lang('Please pay')
                                        <b class="text-success">{{showAmount($data['final_amount']) .' '.$data['method_currency'] }} </b> @lang('for successful payment')
                                    </p>
                                    <h4 class="mb-3">@lang('Please follow the instruction below')</h4>
                                    <p class="my-3">@php echo  $data->gateway->description @endphp</p>
                                </div>

                                    <x-ar-form identifier="id" identifierValue="{{ $gateway->form_id }}" />

                                <div class="col-md-12">
                                    <div class="form-group text-end">
                                        <button type="submit" class="btn btn--base">
                                            @lang('Pay Now')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection