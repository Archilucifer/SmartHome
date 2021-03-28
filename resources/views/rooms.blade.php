@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div data-app>
                <rooms :data='{!!json_encode($data, JSON_THROW_ON_ERROR) !!}' :home-id='{!!json_encode($homeId, JSON_THROW_ON_ERROR) !!}'></rooms>
            </div>
        </div>
    </div>
@endsection
