@extends('layouts.app')

@section('header')
<div class="page-header">
  <h1><i class="fas fa-plus"></i> タスクの新規作成 </h1>
</div>
@endsection

@section('content')
@include('error')

<div class="row">
  <div class="col-md-12">

    <form action="{{ route('tasks.store') }}" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="user_id" value="{{ $user_id }}">

      <div class="form-group">
        <label for="subject-field">件名</label>
        <input class="form-control" type="text" name="subject" id="subject-field" value="" />
      </div>
      <div class="form-group">
        <label for="description-field">詳細</label>
        <textarea name="description" id="description-field" class="form-control" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="priority-field">重要度</label>
        <select name="priority" id="priority-field">
          <option value>※任意</option>
          <option value="3">★★★</option>
          <option value="2">★★☆</option>
          <option value="1">★☆☆</option>
        </select>
      </div>
      <div class="form-group">
        <label for="due_date-field">締切</label>
        <div class="input-group date datetimepicker" id="due_date" data-target-input="nearest">
          <input type="text" name="due_date"  id="due_date-field" class="form-control datetimepicker-input" data-target="#due_date" />
          <div class="input-group-append" data-target="#due_date" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>

      <div class="well well-sm">
        <button type="submit" class="btn btn-primary">新規作成</button>
        <a class="btn btn-link pull-right" href="{{ route('tasks.index') }}"><i class="fas fa-backward"></i>戻る</a>
      </div>
    </form>
  </div>
</div>
@endsection 