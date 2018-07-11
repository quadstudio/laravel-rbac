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
        <h1 class="header-title m-t-0 m-b-20"><i class="fa fa-@lang('rbac::role.icon')"></i> @lang('rbac::role.roles')</h1>
        <hr/>

        <div class="row">
            <div class="col-12 mb-2">
                <a class="btn btn-success" href="{{ route('admin.roles.create') }}" role="button">
                    <i class="fa fa-magic"></i>
                    <span>@lang('rbac::messages.create') @lang('rbac::role.role')</span>
                </a>
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                    <i class="fa fa-bars"></i>
                    <span>@lang('rbac::messages.open') @lang('rbac::permission.list')</span>
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
                <div id="rbac-roles-accordion" role="tablist">
                    @each('rbac::admin.role.row', $items, 'role')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                {{$items->render()}}
            </div>
        </div>
    </div>
@endsection