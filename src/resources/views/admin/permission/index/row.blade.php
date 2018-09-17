<tr>
    <td><a href="{{ route('admin.permissions.show', $permission) }}">{{ $permission->title }}</a></td>
    <td class="d-none d-sm-table-cell">{{ $permission->name }}</td>
    <td>{{ $permission->roles->implode('title', ', ') }}</td>
</tr>