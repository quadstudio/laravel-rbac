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
            <li class="breadcrumb-item">
                <a href="{{ route('admin.roles.show', ['id' => $role->id]) }}">{{ $role->title }}</a>
            </li>
            <li class="breadcrumb-item active">@lang('rbac::messages.edit')</li>
        </ol>
        <h1 class="header-title mb-4">@lang('rbac::messages.edit') @lang('rbac::role.role')</h1>

        @include('rbac::admin.alert')

        <div class="card mb-4">
            <div class="card-body">

                <form method="POST" action="{{ route('admin.roles.update', $role) }}">

                    @csrf
                    @method('PUT')
                    {{--{{ method_field('PUT') }}--}}

                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="name">@lang('rbac::role.name')</label>
                            <input type="text" name="name" id="name" required readonly
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   placeholder="@lang('rbac::role.placeholder.name')"
                                   value="{{ old('name', $role->name) }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <small id="nameHelp" class="form-text text-danger">
                                @lang('rbac::role.help.name')
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="title">@lang('rbac::role.title')</label>
                            <input type="text" name="title" id="title"
                                   class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                   placeholder="@lang('rbac::role.placeholder.title')"
                                   value="{{ old('title', $role->title) }}" required>
                            @if ($errors->has('title'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row required">
                        <div class="col mb-3">
                            <label class="control-label d-block"
                                   for="display">@lang('rbac::role.display')</label>
                            <div class="custom-control custom-radio  custom-control-inline">
                                <input class="custom-control-input
                                                    {{$errors->has('display') ? ' is-invalid' : ''}}"
                                       type="radio"
                                       name="display"
                                       required
                                       @if(old('display', $role->display) == 1) checked @endif
                                       id="display_1"
                                       value="1">
                                <label class="custom-control-label"
                                       for="display_1">@lang('rbac::messages.yes')</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input
                                                    {{$errors->has('display') ? ' is-invalid' : ''}}"
                                       type="radio"
                                       name="display"
                                       required
                                       @if(old('display', $role->display) == 0) checked @endif
                                       id="display_0"
                                       value="0">
                                <label class="custom-control-label"
                                       for="display_0">@lang('rbac::messages.no')</label>
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-3">@lang('rbac::permission.permissions')</h4>

                    <div class="form-row">
                        <div class="col mb-3">
                            @foreach($permissions->all() as $permission)
                                <div class="custom-control custom-checkbox">
                                    <input name="permissions[]" value="{{ $permission->id }}" type="checkbox"
                                           @if($role->permissions->contains('id', $permission->id))
                                           checked
                                           @endif
                                           class="custom-control-input" id="permission-{{ $permission->id }}">
                                    <label class="custom-control-label"
                                           for="permission-{{ $permission->id }}">{{ $permission->title }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr/>

                    <div class="form-row">
                        <div class="col text-right">
                            <button name="_stay" value="1" type="submit" class="btn btn-ferroli">
                                <i class="fa fa-check"></i>
                                <span>@lang('rbac::messages.save_stay')</span>
                            </button>
                            <button name="_stay" value="0" type="submit" class="btn btn-ferroli">
                                <i class="fa fa-check"></i>
                                <span>@lang('rbac::messages.save')</span>
                            </button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                <i class="fa fa-close"></i>
                                <span>@lang('rbac::messages.cancel')</span>
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection