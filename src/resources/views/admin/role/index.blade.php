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
            <li class="breadcrumb-item active">@lang('rbac::role.roles')</li>
        </ol>
        <h1 class="header-title mb-4"><i class="fa fa-@lang('rbac::role.icon')"></i> @lang('rbac::role.roles')</h1>

        <div class=" border p-3 mb-2">
            <a href="{{ route('admin.roles.create') }}"
               class="d-block d-sm-inline btn mr-0 mr-sm-1 mb-1 mb-sm-0 btn-ferroli">
                <i class="fa fa-magic"></i>
                <span>@lang('site::messages.create') @lang('rbac::role.role')</span>
            </a>
            <a href="{{ route('admin.permissions.index') }}"
               class="d-block d-sm-inline btn mr-0 mr-sm-1 mb-1 mb-sm-0 btn-secondary">
                <i class="fa fa-@lang('rbac::permission.icon')"></i>
                <span>@lang('rbac::permission.permissions')</span>
            </a>
            <a href="{{ route('admin') }}" class="d-block d-sm-inline btn btn-secondary">
                <i class="fa fa-reply"></i>
                <span>@lang('site::messages.back_admin')</span>
            </a>
        </div>

        <div class="card mt-2 mb-4">
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>@lang('rbac::role.title')</th>
                        <th class="d-none d-sm-table-cell">@lang('rbac::role.name')</th>
                        <th>@lang('rbac::permission.permissions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @each('rbac::admin.role.index.row', $roles, 'role')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection