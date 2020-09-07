@extends('layout')
@section('header')
<div>
  <h1>タスク詳細 #{{$task->id}}</h1>
</div>
@endsection

@section('content')
<div class="card card-body bg-light p-2 mb-4">
  <div class="row">
    <div class="col-md-6">
      <a class="btn btn-sm btn-link" href="{{ route('tasks.index') }}">一覧へ戻る</a>
    </div>
    <div class="col-md-6">
      <a class="btn btn-sm btn-warning float-right" href="{{ route('tasks.edit', $task->id) }}">
        編集
      </a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <label>件名</label>
    <p>
      {{ $task->subject }}
    </p>
    <label>詳細</label>
    <p>
      {{ $task->description }}
    </p>
    <label>締切</label>
    <p>
      {{ $task->due_date }}
    </p>
    <label>完了</label>
    <p>
      <input type="checkbox" disabled @if( $task->completed ) checked @endif/>
    </p>

  </div>
</div>
@endsection 