@extends('layout')

@section('content')
@auth
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('ログイン中です') }}
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="flex-center position-ref full-height">
    <div class="content">
        <h1 class="title m-b-md">
            yps1 Task#6
        </h1>
    </div>
</div>
@endauth
@endsection
