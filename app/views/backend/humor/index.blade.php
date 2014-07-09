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
        <h3>HUMOR</h3>
        <div id="remoteFeed">Remote</div>
    </div>
</div>

<div class="row form-wrapper">

    <div id="remoteFeed"></div>
    <table id="example">
        <thead>
        <tr role="row">

            <th class="col-md-3">Location</th>

            <th class="col-md-3">@lang('admin/buildings/table.name')</th>



            <th class="col-md-2 actions">@lang('table.actions')</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <a href="http://xkcd.com/info.0.json" class="btn btn-warning"><i class="icon-pencil icon-white"></i></a>
            </td>

            <td>Fill 1</td>
            <td>Fill 2</td>
        </tr>

        </tbody>
    </table>
</div>



<script type="text/javascript">
    // Hook functions at the load of the page to link the three drop downs
    // together for Location / Building / Room
    //
    // Must control the link, alter selections automatically when user
    // makes a selection so that proper lists fill the other lists
    jQuery(document).ready(function($){
        $('#remoteFeed').load('http://xkcd.com/info.0.json #remoteFeed');
        //var tmpstr = load()
        alert('Remote');
    });
</script>
@stop
