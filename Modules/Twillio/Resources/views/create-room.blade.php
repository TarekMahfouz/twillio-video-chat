@extends('twillio::layouts.master')

@push('styles')

@endpush

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 offset-3">
                {{ Form::open(['route' => 'twillio.store.room', 'method' => 'post']) }}
                <div class="mb-3">
                    <label for="roomNameInput" class="form-label">Room Name</label>
                    <input name="name" type="text" class="form-control" id="roomNameInput" aria-describedby="roomName">
                </div>
                <button type="submit" class="btn btn-success">Create</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
