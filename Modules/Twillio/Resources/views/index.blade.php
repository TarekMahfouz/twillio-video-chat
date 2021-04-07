{{--@extends('twillio::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('twillio.name') !!}
    </p>
@endsection--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Video Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Oxygen', sans-serif;
        }
    </style>
</head>
<body>
<div id="app">
    <div id="video-chat-window"></div>
    <div class="content">
        <div class="title m-b-md">
            Video Chat Rooms
        </div>

        <div class="row col-3 offset-3">
            {!! Form::open(['url' => 'twillio/room/create']) !!}
            <dev class="form-group">
                <label for="roomname">Room name:</label>
                <input class="form-control" type="text" name="roomName" placeholder="Room name">
            </dev>
            <div class="form-group">
                <button class="btn btn-success mt-2" type="submit">Create Room</button>
            </div>
            {!! Form::close() !!}
        </div>

        @if($rooms)
            @foreach ($rooms as $room)
                <a href="{{ url('/room/join/'.$room) }}">{{ $room }}</a>
            @endforeach
        @endif
    </div>
<!--    <video-chat></video-chat>-->
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
