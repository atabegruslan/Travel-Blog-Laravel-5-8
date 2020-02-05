<div class="row">
        
    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">

        <table class="table">
            <thead>
                <tr>
                    <th>Name: </th>
                    <th>{{ $param->name }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Email: </strong></td>
                    <td>{{ $param->email }}</td>
                </tr>
                <tr>
                    <td><strong>Created: </strong></td>
                    <td>{{ $param->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>SignUp Type: </strong></td>
                    <td>{{ $param->type }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
