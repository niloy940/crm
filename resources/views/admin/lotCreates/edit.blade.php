@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lotCreate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lot-creates.update", [$lotCreate->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="int_lot">{{ trans('cruds.lotCreate.fields.int_lot') }}</label>
                <input class="form-control {{ $errors->has('int_lot') ? 'is-invalid' : '' }}" type="text" name="int_lot" id="int_lot" value="{{ old('int_lot', $lotCreate->int_lot) }}" required>
                @if($errors->has('int_lot'))
                    <div class="invalid-feedback">
                        {{ $errors->first('int_lot') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lotCreate.fields.int_lot_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection