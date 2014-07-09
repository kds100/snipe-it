@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Rooms ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="row header">
    <div class="col-md-12">
        <a href="{{ route('create/room') }}" class="btn btn-success pull-right"><i class="icon-plus-sign icon-white"></i> Create New</a>
        <h3>Rooms</h3>
    </div>
</div>

<div class="row form-wrapper">

    <table id="example">
        <thead>
        <tr role="row">
            <th class="col-md-3">@lang('admin/rooms/table.name')</th>



            <th class="col-md-2 actions">@lang('table.actions')</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rooms as $room)
        <tr>
            <td>{{ $room->name }}</td>


            <td>
                <a href="{{ route('update/room', $room->id) }}" class="btn btn-warning"><i class="icon-pencil icon-white"></i></a>


                <a data-html="false" class="btn delete-asset btn-danger" data-toggle="modal" href="{{ route('delete/room', $room->id) }}" data-content="Are you sure you wish to delete this room?" data-title="Delete {{ htmlspecialchars($room->name) }}?" onClick="return false;"><i class="icon-trash icon-white"></i></a>

            </td>

        </tr>
        @endforeach
        </tbody>
    </table>
</div>


@stop
