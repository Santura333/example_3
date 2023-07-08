{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}


@extends('frontend.frontend_master')


{{-- section la 1 khoi de luu tru du lieu => khong hien thi => dung @yield() de hien thi section do --}}
@section('frontend_content')

<div class="body-content">
    <div class="container">
        <div class="row front-dashboard-wrap">
            @include('frontend.profile.user-sidebar')
            <div class="col-md-9">
                Welcome To {{ env('APP_NAME') }} <strong>{{ Auth::user()->name }}</strong>
                @yield('userdashboard_content')
            </div>

        </div>
    </div>
</div>
@endsection