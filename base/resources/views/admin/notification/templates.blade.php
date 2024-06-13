@extends('admin.layouts.app')
@section('panel')
<div class="row gy-4   mb-5">
	<div class="col-lg-12">
        <div class="card-two p-0">
            <div class="table-wrap table-responsive">
                <table class="table table--responsive--md table-hover">
                    <thead>
                    <tr>
                        <th>@lang('Name')</th>
                        <th>@lang('Subject')</th>
                        <th>@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($templates as $template)
                        <tr>
                            <td data-label="@lang('Name')">{{ __($template->name) }}</td>
                            <td data-label="@lang('Subject')">{{ __($template->subj) }}</td>
                            <td data-label="@lang('Action')">
                                <a href="{{ route('admin.setting.notification.template.edit', $template->id) }}"
                                    class="btn btn--sm btn-outline-base ms-1 editGatewayBtn">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" colspan="3">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
