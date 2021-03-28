@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div data-app>
                <devices
                    :data='{!!json_encode($data, JSON_THROW_ON_ERROR) !!}'
                    :home-id='{!!json_encode($homeId, JSON_THROW_ON_ERROR) !!}'
                    :rooms='{{json_encode($rooms, JSON_THROW_ON_ERROR)}}'
                    :homes='{{json_encode($homes, JSON_THROW_ON_ERROR)}}'>
                </devices>
            </div>
        </div>
    </div>
@endsection
