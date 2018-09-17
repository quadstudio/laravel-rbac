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
            <li class="breadcrumb-item active">@lang('rbac::permission.permissions')</li>
        </ol>
        <h1 class="header-title mb-4">
            <i class="fa fa-@lang('rbac::permission.icon')"></i> @lang('rbac::permission.permissions')
        </h1>

        @include('rbac::admin.alert')
        <div class=" border p-3 mb-2">
            <a href="{{ route('admin.permissions.create') }}"
               class="d-block d-sm-inline btn mr-0 mr-sm-1 mb-1 mb-sm-0 btn-ferroli">
                <i class="fa fa-magic"></i>
                <span>@lang('site::messages.create') @lang('rbac::permission.permission')</span>
            </a>
            <a href="{{ route('admin.roles.index') }}"
               class="d-block d-sm-inline btn mr-0 mr-sm-1 mb-1 mb-sm-0 btn-secondary">
                <i class="fa fa-@lang('rbac::role.icon')"></i>
                <span>@lang('rbac::role.roles')</span>
            </a>
            <a href="{{ route('admin') }}" class="d-block d-sm-inline btn btn-secondary">
                <i class="fa fa-reply"></i>
                <span>@lang('site::messages.back_admin')</span>
            </a>
        </div>
        @filter(['repository' => $repository])@endfilter
        <div class="card mt-2 mb-4">
            <div class="card-body">
                <table class="table table-sm table-hover">
                    <thead>
                    <tr>
                        <th>@lang('rbac::permission.title')</th>
                        <th class="d-none d-sm-table-cell">@lang('rbac::permission.name')</th>
                        <th>@lang('rbac::role.roles')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @each('rbac::admin.permission.index.row', $permissions, 'permission')
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection