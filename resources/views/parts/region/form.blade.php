{!! Form::model($item, ['url' => !is_null($item) ? "$feature/$item->id" : $feature, 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}

    {{ Form::hidden('user_id', Auth::user()->id) }}

    <div class="form-group">
        <label for="name">{{ ucfirst($feature) }}: </label>
        {{ Form::text('name', !is_null($item) ? $item->name : null, ['placeholder' => ucfirst($feature), 'class' => 'form-control', 'id' => 'name']) }}
    </div>

    @if (!is_null($item))
        {{ Form::hidden('_method', 'PUT') }}
    @endif

    {{ Form::token() }}

    {!! Form::submit(!is_null($item) ? 'Update' : 'Create', ['class' => 'btn btn-default']) !!}
    
{!! Form::close() !!}
