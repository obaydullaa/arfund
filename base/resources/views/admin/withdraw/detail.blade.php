@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4  mb-5">


        <div class="col-lg-4 col-md-4">
            <div class="card-two overflow-hidden">
                <div class="card-body">
                    <h5 class="mb-3">@lang('Withdraw Via') {{__(@$withdrawal->method->name)}}</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Date')
                            <span class="fw-bold">{{ showDateTime($withdrawal->created_at) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Trx Number')
                            <span class="fw-bold">{{ $withdrawal->trx }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="fw-bold">
                                <a href="{{ route('admin.users.detail', $withdrawal->user_id) }}">{{ @$withdrawal->user->username }}</a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Method')
                            <span class="fw-bold">{{__($withdrawal->method->name)}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Amount')
                            <span class="fw-bold">{{ showAmount($withdrawal->amount ) }} {{ __($general->cur_text) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Charge')
                            <span class="fw-bold">{{ showAmount($withdrawal->charge ) }} {{ __($general->cur_text) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('After Charge')
                            <span class="fw-bold">{{ showAmount($withdrawal->after_charge ) }} {{ __($general->cur_text) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Rate')
                            <span class="fw-bold">1 {{__($general->cur_text)}}
                                = {{ showAmount($withdrawal->rate ) }} {{__($withdrawal->currency)}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Payable')
                            <span class="fw-bold">{{ showAmount($withdrawal->final_amount) }} {{__($withdrawal->currency)}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @php echo $withdrawal->statusBadge @endphp
                        </li>

                        @if($withdrawal->admin_feedback)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Admin Response')
                           <p>{{$withdrawal->admin_feedback}}</p>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="card-two">
                <h5 class="card-title pb-2">@lang('User Withdraw Information')</h5>
                <div class="card-body">
                    @if($details != null)
                    <ul class="list-group">
                        @foreach(json_decode($details) as $val)

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{__($val->name)}}
                            <span>
                                @if($val->type == 'checkbox')
                                {{ implode(',',$val->value) }}
                                @elseif($val->type == 'file')
                                @if($val->value)
                                <a href="{{ route('admin.download.attachment',encrypt(getFilePath('verify').'/'.$val->value)) }}" class="me-3"><i class="fa fa-file"></i>  @lang('Attachment') </a>
                                @else
                                @lang('No File')
                                @endif
                                @else
                                {{__($val->value)}}
                                @endif
                            </span>
                        </li>

                        @endforeach
                    </ul>

                    @endif

                    @if($withdrawal->status == Status::PAYMENT_PENDING)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button class="btn btn--sm btn-outline--success ms-1 approveBtn" data-id="{{ $withdrawal->id }}" data-amount="{{ showAmount($withdrawal->final_amount) }} {{$withdrawal->currency}}">
                                    <i class="fas la-check"></i> @lang('Approve')
                                </button>

                                <button class="btn btn--sm btn-outline--danger ms-1 rejectBtn" data-id="{{ $withdrawal->id }}">
                                    <i class="fas fa-ban"></i> @lang('Reject')
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>



    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Approve Withdrawal Confirmation')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.withdraw.approve') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Have you sent') <span class="fw-bold withdraw-amount text-success"></span>?</p>
                        <p class="withdraw-detail"></p>
                        <textarea name="details" class="form-control pt-3" value="{{ old('details') }}" rows="3" placeholder="@lang('Provide the details. eg: transaction number')" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-lg-12 text-end">
                                <button type="submit" class="btn btn--md btn-outline-base">@lang('Submit')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject Withdrawal Confirmation')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{route('admin.withdraw.reject')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Reason of Rejection')</label>
                            <textarea name="details" class="form-control pt-3" rows="3" value="{{ old('details') }}" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-lg-12 text-end">
                                <button type="submit" class="btn btn--md btn-outline-base">@lang('Submit')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#approveModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.modal('show');
            });

            $('.rejectBtn').on('click', function() {
                var modal = $('#rejectModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });
        })(jQuery);

    </script>
@endpush
