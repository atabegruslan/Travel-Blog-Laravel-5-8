<table class="table">
    <thead>
        <tr>
            <th>Place: </th>
            <th>{{ $item->place }}</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td><strong>By: </strong></td>
            <td>{{ $item->user->name }}</td>
        </tr>
        <tr>
            <td><strong>Modified: </strong></td>
            <td>{{ $item->updated_at }}</td>
        </tr>
        <tr>
            <td><strong>Review: </strong></td>
            <td>{{ $item->comments }}</td>
        </tr>

        <tr>
            <td><strong>Region: </strong></td>
            <td>
                @foreach($item->regions as $region)
                    <p>{{ $region->name }}</p>
                @endforeach
            </td>
        </tr>
    </tbody>
</table>
