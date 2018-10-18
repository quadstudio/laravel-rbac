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
                <a href="{{ route('admin.roles.index') }}">@lang('rbac::role.roles')</a>
            </li>
            <li class="breadcrumb-item active">{{ $role->title }}</li>
        </ol>
        <h1 class="header-title mb-4">{{ $role->title }}</h1>
        <hr/>

        @include('rbac::admin.alert')

        <div class=" border p-3 mb-2">
            <a href="{{ route('admin.roles.edit', $role) }}"
               class="d-block d-sm-inline btn mr-0 mr-sm-1 mb-1 mb-sm-0 btn-ferroli">
                <i class="fa fa-pencil"></i>
                <span>@lang('site::messages.edit') @lang('rbac::role.role')</span>
            </a>
            <a href="{{ route('admin.roles.users', $role) }}"
               class="d-block d-sm-inline btn mr-0 mr-sm-1 mb-1 mb-sm-0 btn-ferroli">
                <i class="fa fa-@lang('site::user.icon')"></i>
                <span>@lang('site::user.users') <span class="badge badge-light">{{$role->users()->count()}}</span></span>
            </a>
            <a href="{{ route('admin.roles.index') }}" class="d-block d-sm-inline btn btn-secondary">
                <i class="fa fa-reply"></i>
                <span>@lang('site::messages.back')</span>
            </a>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <dl class="row">

                    <dt class="col-sm-4 text-left text-sm-right">@lang('rbac::role.title')</dt>
                    <dd class="col-sm-8">{{ $role->title }}</dd>

                    <dt class="col-sm-4 text-left text-sm-right">@lang('rbac::role.name')</dt>
                    <dd class="col-sm-8">{{ $role->name }}</dd>
                    <dt class="col-sm-4 text-left text-sm-right">@lang('rbac::role.display')</dt>
                    <dd class="col-sm-8">@bool(['bool' => $role->display])@endbool</dd>

                    <dt class="col-sm-4 text-left text-sm-right">@lang('rbac::role.description')</dt>
                    <dd class="col-sm-8">{{ $role->description }}</dd>

                    <dt class="col-sm-4 text-left text-sm-right">@lang('rbac::permission.permissions')</dt>
                    <dd class="col-sm-8">
                        <div class="list-group">
                            @foreach($role->permissions as $permission)
                                <a href="{{route('admin.permissions.show', $permission)}}" class="p-1 list-group-item list-group-item-action">
                                    {{$permission->title}}
                                </a>
                            @endforeach
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
@endsection