@extends('layouts.app')

@section('content')
    <h2>There are {{ count($users) }} Users</h2>
    <h2>There are {{ count($meetings) }} Meetings</h2>
@endsection
