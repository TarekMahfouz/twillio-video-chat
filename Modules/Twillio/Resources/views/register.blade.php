@extends('twillio::layouts.master')

@push('styles')

@endpush

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 offset-3">
                {{ Form::open(['route' => 'twillio.register.submit', 'method' => 'post']) }}
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Your name:</label>
                    <input name="name" type="text" class="form-control" id="exampleInputName" aria-describedby="name">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <p>
                    Have an account?
                    <a href="{{ route('twillio.login') }}">Login</a>
                </p>
                <button type="submit" class="btn btn-primary">Register</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
