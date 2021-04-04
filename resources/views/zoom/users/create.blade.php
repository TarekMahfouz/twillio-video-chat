@extends('layouts.app')

@section('content')
    <form action="{{ route('zoom.create.user') }}" method="POST" class="form-group">
        {{ csrf_field() }}
        <input type="text" name="email">
        <button type="submit">Create New User</button>
    </form>
@endsection
