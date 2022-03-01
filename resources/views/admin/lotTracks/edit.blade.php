@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lotTrack.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lot-tracks.update", [$lotTrack->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="int_lots">{{ trans('cruds.lotTrack.fields.int_lot') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('int_lots') ? 'is-invalid' : '' }}" name="int_lots[]" id="int_lots" multiple>
                    @foreach($int_lots as $id => $int_lot)
                        <option value="{{ $id }}" {{ (in_array($id, old('int_lots', [])) || $lotTrack->int_lots->contains($id)) ? 'selected' : '' }}>{{ $int_lot }}</option>
                    @endforeach
                </select>
                @if($errors->has('int_lots'))
                    <div class="invalid-feedback">
                        {{ $errors->first('int_lots') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lotTrack.fields.int_lot_helper') }}</span>
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