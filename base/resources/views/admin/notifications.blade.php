@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4   mb-5">
        @forelse($notifications as $notification)
        <div class="col-lg-12 ">
            <a class="notify__item @if($notification->is_read == Status::NO) unread--notification @endif" href="{{ route('admin.notification.read',$notification->id) }}">
            <div class="dashboard--card">
                <span class="banner-effect-1"></span>
                <div class="dashboard--card__icon">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <div class="dashboard--card__content notification-box">
                    <div class="notification-text">
                        <h5 class="dashboard--card__title">{{ __($notification->title) }}</h5>
                        <h4 class="dashboard--card__amount">{{ $notification->created_at->diffForHumans() }}</h4>
                    </div>
                    <button class="btn btn--global btn--outline-global mt-1"><i class="fa-regular fa-clock"></i></button>
                </div>
            </div>
        </a>
        </div>
        @empty
        <div class="col-lg-12">
            <div class="dashboard--card">
                <span class="banner-effect-1"></span>
                <div class="dashboard--card__icon">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <div class="dashboard--card__content notification-box">
                    <div class="notification-text">
                        <h5 class="dashboard--card__title">{{ __($emptyMessage) }}</h5>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
        <div class="mt-3">
            {{ paginateLinks($notifications) }}
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <div class="text-lg-end text-md-end text-start mt-md-0 mt-4">
        <a href="{{ route('admin.notifications.readAll') }}" class="btn btn-sm btn--global btn--outline-global">@lang('Mark as Read')</a>
    </div>
@endpush

@push('style')
    <style>

        .dashboard--card {
            box-shadow: -1px 0px 16px -10px #a99de7;
            padding: 28px;
            border: 1px solid hsl(var(--nav));
            transition: all 0.4s ease-in-out;
            text-align: start;
            position: relative;
            z-index: 1;
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            border-radius: 12px;
        }

        .dashboard--card .banner-effect-1 {
            content: "";
            position: absolute;
            top: 42px;
            right: -4px;
            width: 80px;
            height: 80px;
            background-color: hsl(var(--main)/0.3);
            z-index: -1;
            transform: translate(-50%, -50%);
            filter: blur(55px);
        }

       .dashboard--card:hover {
            box-shadow: 0px 2px 16px rgba(1, 6, 20, 0.1);
            transform: translateY(-1px);
            transition: all 0.4s ease-in-out;
        }

        .dashboard--card__link {
            position: absolute;
            right: 20px;
        }

        .dashboard--card__link a {
            color: hsl(var(--white));
        }

        .dashboard--card__link a:hover {
            color: hsl(var(--main));
        }

       .dashboard--card__thumb {
            width: 40px;
            height: 40px;
        }

        .dashboard--card__thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .dashboard--card__icon {
            font-size: 20px;
            width: 40px;
            height: 40px;
            color: hsl(var(--white));
            background-color: hsl(var(--main));
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
        }

        .dashboard--card__title {
            margin-bottom: 10px;
            font-size: 17px;
        }

        .dashboard--card__content {
            width: calc(100% - 60px);
            padding-left: 15px;
        }

        .dashboard--card .notification-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: calc(100% - 60px);
            padding-left: 15px;
        }

       .dashboard--card__amount {
            margin-bottom: 5px;
            margin-bottom: 0;
            font-size: 14px;
        }


    </style>
@endpush
