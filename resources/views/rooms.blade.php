@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div data-app>
                <rooms :data='{!!json_encode($data) !!}' :home-id='{!!json_encode($homeId) !!}'></rooms>
            </div>
        </div>
    </div>
@endsection
