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
            <li class="breadcrumb-item active">@lang('rbac::messages.create')</li>
        </ol>
        <h1 class="header-title mb-4">@lang('rbac::messages.create') @lang('rbac::role.role')</h1>
        <hr/>

        @include('rbac::admin.alert')

        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ route('admin.roles.store') }}">

                    @csrf

                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="name">@lang('rbac::role.name')</label>
                            <input type="text" name="name" id="name" required
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   placeholder="@lang('rbac::role.placeholder.name')"
                                   value="{{ old('name') }}">
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
                                   value="{{ old('title') }}" required>
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
                                       @if(old('display', 1) == 1) checked @endif
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
                                       @if(old('display', 1) == 0) checked @endif
                                       id="display_0"
                                       value="0">
                                <label class="custom-control-label"
                                       for="display_0">@lang('rbac::messages.no')</label>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <h4 class=" mt-3" id="sc_info">@lang('rbac::permission.permissions')</h4>

                    <div class="form-row">
                        <div class="col mb-3">
                            @foreach($permissions->all() as $permission)
                                <div class="custom-control custom-checkbox">
                                    <input name="permissions[]" value="{{ $permission->id }}" type="checkbox"
                                           class="custom-control-input" id="permission-{{ $permission->id }}">
                                    <label class="custom-control-label"
                                           for="permission-{{ $permission->id }}">{{ $permission->title }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col text-right">
                            <button name="_create" value="1" type="submit" class="btn btn-ferroli mb-1">
                                <i class="fa fa-check"></i>
                                <span>@lang('rbac::messages.save_create')</span>
                            </button>
                            <button name="_create" value="0" type="submit" class="btn btn-ferroli mb-1">
                                <i class="fa fa-check"></i>
                                <span>@lang('rbac::messages.save')</span>
                            </button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary mb-1">
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