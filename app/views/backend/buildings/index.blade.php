@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Buildings ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="row header">
    <div class="col-md-12">
        <a href="{{ route('create/building') }}" class="btn btn-success pull-right"><i class="icon-plus-sign icon-white"></i> Create New</a>
        <h3>Buildings</h3>
    </div>
</div>

<div class="row form-wrapper">

    <table id="example">
        <thead>
        <tr role="row">

            <th class="col-md-3">Location</th>

            <th class="col-md-3">@lang('admin/buildings/table.name')</th>



            <th class="col-md-2 actions">@lang('table.actions')</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($buildings as $building)
        <tr>

            <td>{{ $building->location->name }}</a></td>

            <td>{{ $building->name }}</td>


            <td>
                <a href="{{ route('update/building', $building->id) }}" class="btn btn-warning"><i class="icon-pencil icon-white"></i></a>


                <a data-html="false" class="btn delete-asset btn-danger" data-toggle="modal" href="{{ route('delete/building', $building->id) }}" data-content="Are you sure you wish to delete this building?" data-title="Delete {{ htmlspecialchars($building->name) }}?" onClick="return false;"><i class="icon-trash icon-white"></i></a>

            </td>

        </tr>
        @endforeach
        </tbody>
    </table>
</div>


@stop
