<div class="card">
    <div class="card-header" id="rbac-header-{{ $role->id }}">
        <h5 class="mb-0">
            <a href="{{ route('admin.roles.show', $role) }}">{{ $role->description }} ({{ $role->title }})</a>
        </h5>
    </div>

    <div id="rbac-card-{{ $role->id }}" class="collapse show" role="tabpanel"
         aria-labelledby="rbac-header-{{ $role->id }}" data-target="rbac-header-{{ $role->id }}">
        <ul class="nav nav-pills ml-3 mt-2">
            <li class="nav-item">
                <a class="nav-link">
                    @lang('rbac::permission.permissions') <span
                            class="badge badge-primary">{{ $role->permissions_count }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link">
                    @lang('rbac::user.users') <span class="badge badge-primary">{{ $role->users_count }}</span>
                </a>

            </li>
        </ul>
        <div class="card-body">

            {{--@if($role->permissions_count > 0)--}}
            <table class="table table-hover table-sm">
                <caption>@lang('rbac::permission.permissions')</caption>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@lang('rbac::permission.title')</th>
                    <th scope="col" class="d-none d-sm-table-cell">@lang('rbac::permission.name')</th>
                    <th scope="col" class="d-none d-md-table-cell">@lang('rbac::permission.description')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($role->permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td><a href="{{ route('admin.permissions.show', $permission) }}">{{ $permission->title }}</a></td>
                        <td class="d-none d-sm-table-cell">{{ $permission->name }}</td>
                        <td class="d-none d-md-table-cell text-muted">{{ $permission->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{--@endif--}}
        </div>
    </div>
</div>