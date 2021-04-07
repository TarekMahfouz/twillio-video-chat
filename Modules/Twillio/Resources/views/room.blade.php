{{--@extends('twillio::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('twillio.name') !!}
    </p>
@endsection--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<script src="//media.twiliocdn.com/sdk/js/video/v1/twilio-video.min.js"></script>
<script>
    Twilio.Video.createLocalTracks({
        audio: true,
        video: { width: 300 }
    }).then(function(localTracks) {
        return Twilio.Video.connect('{{ $accessToken }}', {
            name: '{{ $roomName }}',
            tracks: localTracks,
            video: { width: 300 }
        });
    }).then(function(room) {
        console.log('Successfully joined a Room: ', room.name);

        room.participants.forEach(participantConnected);

        var previewContainer = document.getElementById(room.localParticipant.sid);
        if (!previewContainer || !previewContainer.querySelector('video')) {
            participantConnected(room.localParticipant);
        }

        room.on('participantConnected', function(participant) {
            console.log("Joining: '"   participant.identity   "'");
            participantConnected(participant);
        });

        room.on('participantDisconnected', function(participant) {
            console.log("Disconnected: '"   participant.identity   "'");
            participantDisconnected(participant);
        });
    });
    // additional functions will be added after this point
</script>

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
    <div class="content">
        <div class="content">
            <div class="title m-b-md">
                Video Chat Rooms
            </div>

            <div id="media-div">
            </div>
        </div>
    </div>
<!--    <video-chat></video-chat>-->
</div>
</body>
</html>
