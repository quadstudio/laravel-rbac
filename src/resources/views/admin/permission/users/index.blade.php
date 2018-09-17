@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('index') }}">@lang('rbac::messages.index')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin') }}">@lang('rbac::messages.admin')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.permissions.index') }}">@lang('rbac::permission.permissions')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.permissions.show', $permission) }}">{{ $permission->title }}</a>
            </li>
            <li class="breadcrumb-item active">@lang('site::user.users')</li>
        </ol>
        <h1 class="header-title mb-4">@lang('site::user.users') @lang('rbac::permission.with') {{ $permission->title }}</h1>

        @include('rbac::admin.alert')

        <div class=" border p-3 mb-2">

            <a href="{{ route('admin.permissions.show', $permission) }}" class="d-block d-sm-inline btn btn-secondary">
                <i class="fa fa-close"></i>
                <span>@lang('site::messages.cancel')</span>
            </a>
        </div>
        @filter(['repository' => $repository, 'route_param' => $permission])@endfilter
        @pagination(['pagination' => $users])@endpagination
        {{$users->render()}}
        <div class="card mt-2 mb-4">
            <div class="card-body">
                <table class="table table-sm table-hover">
                    <thead>
                    <tr>
                        <th>@lang('site::user.name')</th>
                        <th>@lang('site::address.addresses')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <a href="{{route('admin.users.show', $user)}}">{{$user->name}}</a>
                                @include('site::admin.user.component.online')
                            </td>
                            <td>
                                @if(($addresses = $user->addresses()->where('type_id', 2)->get())->isNotEmpty())
                                    <div class="my-2 mb-md-0">
                                        @foreach($addresses as $address)
                                            <span class="d-block">
                                                {{ $address->region->name }} &bull; {{ $address->locality }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{$users->render()}}
    </div>
@endsection