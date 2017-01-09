@extends('base')

@section('content')
    <div id="app">
        <app></app>
    </div>

    <script>
        var user = '{{ $user->name }}';
    </script>
@endsection