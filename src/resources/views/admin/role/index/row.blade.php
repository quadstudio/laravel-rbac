<tr>
    <td><a href="{{ route('admin.roles.show', $role) }}">{{ $role->title }}</a></td>
    <td class="d-none d-sm-table-cell">{{ $role->name }}</td>
    <td>
        <div class="list-group">
            @foreach($role->permissions as $permission)
                <a href="{{route('admin.permissions.show', $permission)}}"
                   class="list-group-item list-group-item-action p-1">
                    {{$permission->title}}
                </a>
            @endforeach
        </div>
    </td>
</tr>