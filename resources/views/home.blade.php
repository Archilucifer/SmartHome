@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row'>
        <div data-app>
            <home :data='{!!json_encode($data) !!}'></home>
        </div>
    </div>
</div>
@endsection
