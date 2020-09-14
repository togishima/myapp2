@extends('layout')

@push('stylesheet')
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
						{{ $calendar->getTitle() }}
				</div>
				<div class="card-body">
						{!! $calendar->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection