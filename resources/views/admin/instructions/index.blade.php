@extends('admin.base')

@section('content')
    <form class="pull-right" style="margin-top: .2em;">
        <input class="form-control" type="text" placeholder="Поиск" name="search">
    </form>

    <h1>Инструкции</h1>

    @if(! Auth::user()->department_id)
    <a class="btn btn-primary" href="{{ route($baseRoute . 'create') }}" style="margin-bottom: 2em;">Добавить видео</a>
    @endif

    @php
        $view = Auth::user()->department_id ? 'show' : 'edit';
    @endphp

    <div>
    @forelse($itemsList as $item)
        <p><a href="{{ route($baseRoute . $view, ['instruction' => $item->id]) }}">{{ $item->name }}</a></p>
    @empty
        <i>Нет добавленных инструкций</i>
    @endforelse
    </div>
@endsection