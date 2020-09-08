@extends('layout')

@section('header')
<div>
  <h1>
    <i class="fas fa-align-justify"></i> タスク一覧
    <a class="btn btn-success float-right" href="{{ route('tasks.create') }}"><i class="fas fa-plus"></i> 新規作成</a>
  </h1>
</div>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12 scroll">
    @if($tasks->count())
    <table class="table table-sm table-striped">
      <thead>
        <tr>
          <th class="nowrap">@sortablelink('id', '#')</th>
          <th class="nowrap">件名</th>
          <th class="nowrap">詳細</th>
          <th class="nowrap">@sortablelink('due_date', '締切')</th>
          <th class="nowrap">@sortablelink('completed', '完了')</th>
          <th class="nowrap">操作</th>
        </tr>
      </thead>

      <tbody>
        @foreach($tasks as $task)
        <tr>
          <td class="text-center"><strong>{{$task->id}}</strong></td>

          <td>{{$task->subject}}</td>
          <td>{{$task->description}}</td>
          <td>{{$task->due_date}}</td>
          <td><input type="checkbox" disabled @if( $task->completed ) checked @endif/></td>

          <td class="text-right nowrap">
            <a class="btn btn-sm btn-primary" href="{{ route('tasks.show', $task->id) }}">
              <i class="fas fa-eye">詳細</i>
            </a>
            <a class="btn btn-sm btn-warning" href="{{ route('tasks.edit', $task->id) }}">
              <i class="fas fa-edit">編集</i>
            </a>
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;"
              onsubmit="return confirm('本当に削除しますか？');">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">

              <button type="submit" class="btn btn-sm btn-danger">
                <i class="fas fa-trash">削除</i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {!! $tasks->render() !!}
    @else
    <h3 class="text-center alert alert-info">タスクはありません</h3>
    @endif

  </div>
</div>

@endsection