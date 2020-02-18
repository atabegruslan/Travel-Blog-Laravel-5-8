<table class="table">
    <thead>
        <tr>
            <th>{{ ucfirst($feature) }}: </th>
            <th>{{ $item->name }}</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Permissions: </td>
            <td>
				@foreach($selectedPermissions as $selectedPermission)
					<p>{{ $selectedPermission->name }}</p>
				@endforeach
            </td>
        </tr>
    </tbody>
</table>
