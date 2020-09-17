@extends('layouts.app')

@push('stylesheet')
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between">
					<a class="btn btn-outline-secondary" href="{{ url('calendar/' . $calendar->getPrevMonth()) }}"><<前の月</a>
					<span>{{ $calendar->getTitle() }}</span>
					<a class="btn btn-outline-secondary" href="{{ url('calendar/' . $calendar->getNextMonth()) }}">次の月>></a>
				</div>
				<div class="card-body">
						{!! $calendar->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection