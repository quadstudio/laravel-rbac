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
        <h1 class="header-title m-t-0 m-b-20"><i class="fa fa-@lang('rbac::permission.icon')"></i> @lang('rbac::permission.permissions')</h1>
        <hr/>

        @include('rbac::admin.alert')



        <div class="row">
            <div class="col-12 mb-2">
                <a class="btn btn-success" href="{{ route('admin.permissions.create') }}" role="button">
                    <i class="fa fa-magic"></i>
                    <span>@lang('rbac::messages.create') @lang('rbac::permission.permission')</span>
                </a>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                    <i class="fa fa-bars"></i>
                    <span>@lang('rbac::messages.open') @lang('rbac::role.list')</span>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                {{$items->render()}}
            </div>
        </div>

        @include('repo::filter')

        <div class="row">
            <div class="col-12">
                <table class="table table-hover table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">@lang('rbac::permission.title')</th>
                        <th scope="col" class="d-none d-sm-table-cell">@lang('rbac::permission.name')</th>
                        <th scope="col" class="d-none d-md-table-cell">@lang('rbac::permission.description')</th>
                        <th scope="col">@lang('rbac::role.roles')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @each('rbac::admin.permission.row', $items, 'permission')
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                {{$items->render()}}
            </div>
        </div>
    </div>
@endsection