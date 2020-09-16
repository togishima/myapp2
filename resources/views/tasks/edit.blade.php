@extends('layouts.app')

@section('header')
<div class="page-header">
  <h1><i class="fas fa-edit"></i>タスク編集 #{{$task->id}}</h1>
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
        <label for="subject-field">件名</label>
        <input class="form-control" type="text" name="subject" id="subject-field"
          value="{{ old('subject', $task->subject ) }}" />
      </div>
      <div class="form-group">
        <label for="description-field">詳細n</label>
        <textarea name="description" id="description-field" class="form-control"
          rows="3">{{ old('description', $task->description ) }}</textarea>
      </div>
      <div class="form-group">
        <label for="priority-field">重要度</label>
        <select name="priority" id="priority-field">
          <option value>
            @switch($task->priority)
              @case(1)
                {{ '★☆☆' }}
                @break
              @case(2)
                {{ '★★☆' }}
                @break
              @case(3)
                {{ '★★★'}}
                @break
              @default
                {{ '※任意' }}
            @endswitch          
          </option>
          <option value="3">★★★</option>
          <option value="2">★★☆</option>
          <option value="1">★☆☆</option>
        </select>
      </div>
      <div class="form-group">
        <label for="due_date-field">締切</label>
        <div class="input-group date datetimepicker" id="due_date" data-target-input="nearest">
          <input type="text" name="due_date"  id="due_date-field" class="form-control datetimepicker-input" data-target="#due_date" value="{{ old('due_date', $task->due_date ) }}" />
          <div class="input-group-append" data-target="#due_date" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>
      <div class="form-group form-check">
        <input class="form-check-input" type="checkbox" name="completed" id="completed-field"
          value="1" @if( $task->completed ) checked @endif/>
        <label class="form-check-label" for="completed-field">完了</label>
      </div>

      <div class="well well-sm">
        <button type="submit" class="btn btn-primary">変更を保存</button>
        <a class="btn btn-link pull-right" href="{{ route('tasks.index') }}"><i class="fas fa-backward"></i> 戻る</a>
      </div>
    </form>

  </div>
</div>
@endsection