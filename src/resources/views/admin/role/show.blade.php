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
        <h1 class="header-title m-t-0 m-b-20">{{ $role->title }}</h1>
        <hr/>

        @include('rbac::admin.alert')

        <div class="row">
            <div class="col mb-2">
                <a href="{{ route('admin.roles.edit', ['id' => $role->id]) }}" class="btn btn-primary">
                    <i class="fa fa-pencil"></i>
                    <span>@lang('rbac::messages.edit')</span>
                </a>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                    <i class="fa fa-reply"></i>
                    <span>@lang('rbac::messages.back')</span>
                </a>
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                    <i class="fa fa-bars"></i>
                    <span>@lang('rbac::messages.open') @lang('rbac::permission.list')</span>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col">

                <table class="table table-sm table-bordered">
                    <tbody>
                    <tr>
                        <td class="text-right"><b>@lang('rbac::role.title')</b></td>
                        <td>{{ $role->title }}</td>
                    </tr>
                    <tr>
                        <td class="text-right"><b>@lang('rbac::role.name')</b></td>
                        <td>{{ $role->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-right"><b>@lang('rbac::role.description')</b></td>
                        <td>{{ $role->description }}</td>
                    </tr>
                    <tr>
                        <td class="text-right align-middle"><b>@lang('rbac::permission.permissions')</b></td>
                        <td>
                            <table class="table table-sm">
                                <tbody>
                                @foreach($role->permissions as $permission)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.permissions.show', $permission) }}">{{ $permission->title }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right align-middle"><b>@lang('rbac::user.users')</b></td>
                        <td>
                            <table class="table table-hover table-bordered table-sm">
                                <tbody>
                                @foreach ($role->users()->pluck('name') as $user)
                                    <tr>
                                        <td>{{ $user }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection