@extends('layouts.app')

@section('content')
    @foreach($users as $index => $user)
        <fieldset>
            <legend>{{ ($index + 1).' - '.$user->first_name }}</legend>
            <p>{{ $user->email }}</p>
        </fieldset>
    @endforeach
@endsection
