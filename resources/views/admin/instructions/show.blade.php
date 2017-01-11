@extends('admin.base')

@section('content')
    <h1>{{ $item->name }}</h1>

    <div>
        <a href="{{ route($baseRoute . 'index') }}" class="btn btn-default" style="margin-bottom: 2em;">Вернуться к списку инструкций</a>
    </div>

    {!! $item->text !!}
@endsection