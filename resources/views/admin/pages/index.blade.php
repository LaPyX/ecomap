@extends('admin.base')

@section('content')
    <h1>Cтраницы</h1>

    <table class="table" style="margin-top: .75em;">
        <thead>
            <tr>
                <td>Название</td>
                <td width="320">Дата последнего редактирования</td>
            </tr>
        </thead>
        @forelse($itemsList as $item)
            <tr>
                <td>
                    <a href="{{ route('admin.pages.edit', ['page' => $item->id]) }}">{{ $item->name }}</a>
                </td>
                <td>
                    {{ $item->created_at }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <i>Нет добавленных страниц</i>
                </td>
            </tr>
        @endforelse
    </table>
@endsection