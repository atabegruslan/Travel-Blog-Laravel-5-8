{!! Form::model($item, ['url' => !is_null($item) ? "$feature/$item->id" : $feature, 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}

    {{ Form::hidden('user_id', Auth::user()->id) }}

    <div class="form-group">
        <label for="place">Place: </label>
        {{ Form::text('place', !is_null($item) ? $item->place : null, ['placeholder' => 'Place', 'class' => 'form-control', 'id' => 'place']) }}
    </div>

    <div class="form-group">
        <label for="review">Review: </label>
        {{ Form::textarea('comments', !is_null($item) ? $item->comments : null, ['placeholder' => 'Review', 'class' => 'form-control', 'id' => 'review', 'rows' => 5]) }}
    </div>

    <div class="form-group">
        <label for="region_ids">Regions: </label>
        <select name="region_ids[]" id="region_ids" class="form-control" multiple>
             @foreach($regions as $region)
                @if(in_array($region->id, $selectedRegionIds))
                 <option value="{{ $region->id }}" selected>
                @else
                 <option value="{{ $region->id }}">
                @endif
                     {{ $region->name }}
                 </option>
             @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image: </label>
        {!! Form::file('image', ['class' => 'img-thumbnail form-control-file', 'id' => 'image']) !!}
    </div>

    @if (!is_null($item))
        {{ Form::hidden('_method', 'PUT') }}
    @endif

    {{ Form::token() }}

    {!! Form::submit(!is_null($item) ? 'Update' : 'Create', ['class' => 'btn btn-default']) !!}
    
{!! Form::close() !!}
