@extends('layout')
@section('header')
<div>
  <h1>Task / Show #{{$task->id}}</h1>
</div>
@endsection

@section('content')
<div class="card card-body bg-light p-2 mb-4">
  <div class="row">
    <div class="col-md-6">
      <a class="btn btn-sm btn-link" href="{{ route('tasks.index') }}">Back</a>
    </div>
    <div class="col-md-6">
      <a class="btn btn-sm btn-warning float-right" href="{{ route('tasks.edit', $task->id) }}">
        Edit
      </a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <label>Subject</label>
    <p>
      {{ $task->subject }}
    </p>
    <label>Description</label>
    <p>
      {{ $task->description }}
    </p>
    <label>Due Date</label>
    <p>
      {{ $task->due_date }}
    </p>
    <label>Completed</label>
    <p>
      <input type="checkbox" disabled @if( $task->completed ) checked @endif/>
    </p>

  </div>
</div>
@endsection 