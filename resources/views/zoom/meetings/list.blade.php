@extends('layouts.app')

@push('styles')
    <style>
        a{
            text-decoration: none;
        }
    </style>
@endpush

@section('content')
    @foreach($meetings as $index => $meeting)
        <fieldset>
            <legend>
                {{ ($index + 1) }} -
                <a href="{{ route('zoom.get.meeting', ['id' => $meeting->id]) }}">
                    {{ $meeting->topic }}
                </a> - ID: {{ $meeting->id }}</legend>
            <p>Will be started at: {{ $meeting->start_time }}</p>
            <p>Link to join: <a href="{{ $meeting->join_url }}" target="_blank">Join Now</a></p>

            <div class="col-md-4">
                <a href="{{ route('zoom.end.meeting', ['id' => $meeting->id]) }}">End Meeting</a> |
                <a href="{{ route('zoom.delete.meeting', ['id' => $meeting->id]) }}">Delete Meeting</a>
            </div>
        </fieldset>
        <hr class="mb-3 mt-3">
    @endforeach
@endsection
