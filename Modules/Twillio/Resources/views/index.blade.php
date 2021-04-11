@extends('twillio::layouts.master')

@push('styles')
    <style>
        * {
            font-family: 'Oxygen', sans-serif;
        }
    </style>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

@endpush

@section('content')
    <div id="app">

        <div id="video-chat-window"></div>
        <video-chat room_code="{{ request()->room_code }}" user_id='{{ auth()->user()->id }}'></video-chat>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
