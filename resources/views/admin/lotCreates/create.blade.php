@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lotCreate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lot-creates.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="int_lot">{{ trans('cruds.lotCreate.fields.int_lot') }}</label>
                <input class="form-control date {{ $errors->has('int_lot') ? 'is-invalid' : '' }}" type="text" name="int_lot" id="int_lot" value="{{ old('int_lot') }}" required>
                @if($errors->has('int_lot'))
                    <span class="text-danger">{{ $errors->first('int_lot') }}</span>
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