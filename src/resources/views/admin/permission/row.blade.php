<tr>
    <td>{{ $permission->id }}</td>
    <td><a href="{{ route('admin.permissions.show', ['id' => $permission->id]) }}">{{ $permission->title }}</a></td>
    <td class="d-none d-sm-table-cell">{{ $permission->name }}</td>
    <td class="d-none d-md-table-cell text-muted">{{ $permission->description }}</td>
    <td>{{ $permission->roles->implode('title', ', ') }}</td>
</tr>