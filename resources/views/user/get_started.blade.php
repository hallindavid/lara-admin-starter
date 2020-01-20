@extends('layouts.nomenu')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Welcome to {{ config('app.name') }}!</h1>
                </div>
                <div class="card-body text-center">
                    <p class="card-text">Do you want to create a new organization or join an existing one?</p>
                </div>
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col-4 align-self-center px-3">
                        <a href="{{ route('new_org') }}" class="btn btn-outline-success btn-lg btn-block">
                                <i class="fas fa-plus"></i> New Organization
                            </a>
                        </div>
                        <div class="col-4">
                            <img class="card-img" src="{{ asset('images/building.png') }}"/>
                        </div>
                        <div class="col-4 align-self-center px-3">
                            <button disabled class="btn btn-outline-primary btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Coming Soon">
                                <i class="far fa-handshake"></i> Join Existing Organization
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection