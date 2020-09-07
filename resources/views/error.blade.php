@if (count($errors) > 0)
<div class="alert alert-danger">
    <p>入力に問題がありました</p>
    <ul>
        @foreach ($errors->all() as $error)
        <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif