@extends('admin.base')

@section('content')
    <h1>Инструкции</h1>

    @if($mode)
        {!! $faq !!}
    @else
        <form method="post">
            {{ csrf_field() }}
            <textarea name="faq" class="form-control" cols="20" rows="20">{!! $faq !!}</textarea>
            <input class="btn btn-lg btn-primary" type="submit" value="Сохранить" style="margin-top: 1em;">
        </form>
    @endif
@endsection