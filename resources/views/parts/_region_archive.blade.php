<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th>Region</th>
            </tr>
        </thead>

        <tbody>
    	    @foreach($param as $k => $v)
    	    	<tr>
                    <td><b>{{ link_to_route('region.show', $v->name, [ $v->id ] ) }}</b></td>
    	    	</tr>
    	    @endforeach
        </tbody>
    </table> 
</div>
