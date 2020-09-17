@extends('layouts.app')

@push('stylesheet')
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-9 mt-2">
        <div class="card">
            <div class="card-header">
              今月の予定
            </div>
            <div class="card-body">
                {!! $calendar->render() !!}
            </div>
        </div>
    </div>
    <div class="col-md-3 mt-2">
      <div class="card">
        <div class="card-header">{{ __('Status') }}</div>
          <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
            <p>{{ __('ログイン中です') }}</p>
            <dl>
                <dt>ユーザーID:</dt>
                <dd>{{ Auth::id() }}</dd>
                <dt>ユーザー名：</dt>
                <dd>{{ Auth::user()->name }}</dd>
                <dt>メールアドレス</dt>
                <dd>{{ AUth::user()->email }}</dd>
                <dt>機能一覧</dt>
                <dd><a class="dropdown-item" href="{{ url('/tasks') }}">タスク管理</a></dd>
                <dd><a class="dropdown-item" href="{{ url('/calendar') }}">カレンダー</a></dd>
            </dl>
        </div>  
			</div>
    </div>
	</div>
</div>
@endsection