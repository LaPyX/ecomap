@extends('admin.base')

@section('content')
    <h1>Новости</h1>

    <a class="btn btn-primary" href="{{ route('admin.news.create') }}">Создать новость</a>

    <form class="pull-right">
        <input class="form-control" type="text" placeholder="Поиск" name="search">
    </form>

    <table class="table" style="margin-top: .75em;">
        <thead>
        <td>Название</td>
        <td>Дата создания</td>
        <td>Статус</td>
        </thead>
        @forelse($itemsList as $item)
            <tr>
                <td>
                    <a href="{{ route('admin.news.edit', ['news' => $item->id]) }}">{{ $item->name }}</a>
                </td>
                <td>
                    {{ $item->created_at }}
                </td>
                <td>
                    {{ $item->status ? 'Опубликовано' : 'Черновик' }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <i>Нет добавленных новостей</i>
                </td>
            </tr>
        @endforelse
    </table>

    {{ $itemsList->links() }}
@endsection