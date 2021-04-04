@extends('layouts.app')

@section('content')
    <form action="{{ route('zoom.create.meeting') }}" method="POST" class="form-group">
        {{ csrf_field() }}
        <input type="text" name="topic" placeholder="topic">
        <button type="submit">Create New Meeting</button>
    </form>
@endsection
