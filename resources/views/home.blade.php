@extends('base')

@section('content')
    <div id="app">
        <app></app>
    </div>

    <script>
        var user = '{{ $user ? $user->name : false }}';
    </script>
@endsection