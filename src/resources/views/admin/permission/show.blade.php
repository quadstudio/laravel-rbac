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
            <li class="breadcrumb-item active">{{ $permission->title }}</li>
        </ol>
        <h1 class="header-title mb-4">{{ $permission->title }}</h1>

        @include('rbac::admin.alert')

        <div class=" border p-3 mb-2">
            <a href="{{ route('admin.permissions.edit', $permission) }}"
               class="d-block d-sm-inline btn mr-0 mr-sm-1 mb-1 mb-sm-0 btn-ferroli">
                <i class="fa fa-pencil"></i>
                <span>@lang('site::messages.edit') @lang('rbac::permission.permission')</span>
            </a>
            <a href="{{ route('admin.permissions.users', $permission) }}"
               class="d-block d-sm-inline btn mr-0 mr-sm-1 mb-1 mb-sm-0 btn-ferroli">
                <i class="fa fa-@lang('site::user.icon')"></i>
                <span>@lang('site::user.users') <span class="badge badge-light">{{$permission->users()->count()}}</span></span>
            </a>
            <a href="{{ route('admin.permissions.index') }}" class="d-block d-sm-inline btn btn-secondary">
                <i class="fa fa-reply"></i>
                <span>@lang('site::messages.back')</span>
            </a>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <dl class="row">

                    <dt class="col-sm-4 text-left text-sm-right">@lang('rbac::permission.title')</dt>
                    <dd class="col-sm-8">{{ $permission->title }}</dd>

                    <dt class="col-sm-4 text-left text-sm-right">@lang('rbac::permission.name')</dt>
                    <dd class="col-sm-8">{{ $permission->name }}</dd>

                    <dt class="col-sm-4 text-left text-sm-right">@lang('rbac::permission.description')</dt>
                    <dd class="col-sm-8">{{ $permission->description }}</dd>

                    <dt class="col-sm-4 text-left text-sm-right">@lang('rbac::role.roles')</dt>
                    <dd class="col-sm-8">
                        <div class="list-group">
                            @foreach($permission->roles as $role)
                                <a href="{{route('admin.roles.show', $role)}}" class="p-1 list-group-item list-group-item-action">
                                    {{$role->title}}
                                </a>
                            @endforeach
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
@endsection