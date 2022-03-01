@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lotTrack.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lot-tracks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lotTrack.fields.id') }}
                        </th>
                        <td>
                            {{ $lotTrack->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lotTrack.fields.int_lot') }}
                        </th>
                        <td>
                            @foreach($lotTrack->int_lots as $key => $int_lot)
                                <span class="label label-info">{{ $int_lot->int_lot }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lot-tracks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection