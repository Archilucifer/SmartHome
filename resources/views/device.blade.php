@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div data-app>
                <devices :data='{!!json_encode($data) !!}' :home-id='{!!json_encode($homeId) !!}' :rooms='{{json_encode($rooms)}}' :homes='{{json_encode($homes)}}'></devices>
            </div>
        </div>
    </div>
@endsection
