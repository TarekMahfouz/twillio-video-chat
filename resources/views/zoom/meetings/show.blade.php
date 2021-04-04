@extends('layouts.app')

@push('styles')
    <style>
        p {
            font-size: 20px;
        }
        span {
            color: brown;
        }
    </style>
@endpush
@section('content')
    <h2>TOPIC: {{ $meeting->topic }}</h2>
    <hr class="mb-3">
    <p>host_id: <span>{{ $meeting->host_id }}</span></p>
    <p>host_email: <span>{{ $meeting->host_email }}</span></p>
    <p>status: <span>{{ $meeting->status }}</span></p>
    <p>timezone: <span>{{ $meeting->timezone }}</span> </p>
    <p>created_at: <span>{{ $meeting->created_at }}</span></p>
    <p>password: <span>{{ $meeting->password }}</span></p>
    <p>join_url: <a href="{{ $meeting->join_url }}">Join</a></p>
@endsection
