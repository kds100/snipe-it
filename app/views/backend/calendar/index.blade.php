@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Calendar ::
@parent
@stop

{{-- Page content --}}
@section('content')
<link href="{{ asset('assets/css/lib/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/lib/fullcalendar.print.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/compiled/calendar.css') }}" rel="stylesheet" type="text/css" />

<div class="row header">
    <div class="col-md-12">
		<h3>Calendar</h3>
	</div>
</div>

<div class="row-fluid calendar-wrapper">
                    <div class="span12">

                        <!-- div that fullcalendar plugin uses  -->
                        <div id='calendar'></div>


                		</div>
</div>

@stop