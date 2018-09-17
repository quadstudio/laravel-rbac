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
                <a href="{{ route('admin.permissions.show', ['id' => $permission->id]) }}">{{ $permission->title }}</a>
            </li>
            <li class="breadcrumb-item active">@lang('rbac::messages.edit')</li>
        </ol>
        <h1 class="header-title mb-4">@lang('rbac::messages.edit') @lang('rbac::permission.permission')</h1>

        @include('rbac::admin.alert')

        <div class="card mb-4">
            <div class="card-body">

                <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">

                    @csrf
                    @method('PUT')
                    {{--{{ method_field('PUT') }}--}}

                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="name">@lang('rbac::permission.name')</label>
                            <input type="text" name="name" id="name" required readonly
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   placeholder="@lang('rbac::permission.placeholder.name')"
                                   value="{{ old('name', $permission->name) }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <small id="nameHelp" class="form-text text-danger">
                                @lang('rbac::permission.help.name')
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="title">@lang('rbac::permission.title')</label>
                            <input type="text" name="title" id="title"
                                   class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                   placeholder="@lang('rbac::permission.placeholder.title')"
                                   value="{{ old('title', $permission->title) }}" required>
                            @if ($errors->has('title'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="description">@lang('rbac::permission.description')</label>
                            <input type="text" name="description" id="description"
                                   class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                   placeholder="@lang('rbac::permission.placeholder.description')"
                                   value="{{ old('description', $permission->description) }}">
                            @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>



                    <h4 id="sc_info">@lang('rbac::role.roles')</h4>

                    <div class="form-row">
                        <div class="col mb-3">
                            @foreach($roles->all() as $role)
                                <div class="custom-control custom-checkbox">
                                    <input name="roles[]" value="{{ $role->id }}" type="checkbox"
                                           @if($permission->roles->contains('id', $role->id))
                                           checked
                                           @endif
                                           class="custom-control-input" id="role-{{ $role->id }}">
                                    <label class="custom-control-label"
                                           for="role-{{ $role->id }}">{{ $role->title }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr />

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
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
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