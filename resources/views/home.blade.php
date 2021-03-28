@extends('layouts.app')

@section('content')
            <div id="app">
                <div data-app>
                    <homes :data='{!!json_encode($data, JSON_THROW_ON_ERROR) !!}'></homes>
                </div>
            </div>
@endsection
