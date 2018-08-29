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
        <h1 class="header-title m-t-0 m-b-20">@lang('rbac::messages.edit') @lang('rbac::role.role')</h1>
        <hr/>

        @include('rbac::admin.alert')

        <div class="row mb-5">
            <div class="col-md-12">

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
                            <small id="nameHelp" class="form-text text-info">
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
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="description">@lang('rbac::role.description')</label>
                            <input type="text" name="description" id="description"
                                   class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                   placeholder="@lang('rbac::role.placeholder.description')"
                                   value="{{ old('description', $role->description) }}">
                            @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <hr/>

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


                    <div class="form-row">
                        <div class="col text-right">
                            <button name="_stay" value="1" type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i>
                                <span>@lang('rbac::messages.save_stay')</span>
                            </button>
                            <button name="_stay" value="0" type="submit" class="btn btn-primary">
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