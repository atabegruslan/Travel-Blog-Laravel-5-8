<table class="table">
    <thead>
        <tr>
            <th>Name: </th>
            <th>{{ $item->name }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Email: </strong></td>
            <td>{{ $item->email }}</td>
        </tr>
        <tr>
            <td><strong>Created: </strong></td>
            <td>{{ $item->created_at }}</td>
        </tr>
        <tr>
            <td><strong>SignUp Type: </strong></td>
            <td>{{ $item->type }}</td>
        </tr>
        <tr>
            <td><strong>Roles: </strong></td>
            <td>
                @foreach($selectedRoles as $selectedRole)
                    <p>{{ $selectedRole->name }}</p>
                @endforeach
            </td>
        </tr>
    </tbody>
</table>