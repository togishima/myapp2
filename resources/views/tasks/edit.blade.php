@extends('layout')

@section('header')
<div class="page-header">
  <h1><i class="fas fa-edit"></i> Task / Edit #{{$task->id}}</h1>
</div>
@endsection

@section('content')
@include('error')

<div class="row">
  <div class="col-md-12">

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
      @method('PUT')
      @csrf

      <div class="form-group">
        <label for="subject-field">Subject</label>
        <input class="form-control" type="text" name="subject" id="subject-field"
          value="{{ old('subject', $task->subject ) }}" />
      </div>
      <div class="form-group">
        <label for="description-field">Description</label>
        <textarea name="description" id="description-field" class="form-control"
          rows="3">{{ old('description', $task->description ) }}</textarea>
      </div>
      <div class="form-group">
        <label for="due_date-field">Due Date</label>
        <div class="input-group date datetimepicker" data-target-input="nearest">
          <input type="text" name="due_date"  id="due_date-field" class="form-control datetimepicker-input" data-target="#due_date" value="{{ old('due_date', $task->due_date ) }}" />
          <div class="input-group-append" data-target="#due_date" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>
      <div class="form-group form-check">
        <input class="form-check-input" type="checkbox" name="completed" id="completed-field"
          value="1" @if( $task->completed ) checked @endif/>
        <label class="form-check-label" for="completed-field">Completed</label>
      </div>

      <div class="well well-sm">
        <button type="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-link pull-right" href="{{ route('tasks.index') }}"><i class="fas fa-backward"></i> Back</a>
      </div>
    </form>

  </div>
</div>
@endsection