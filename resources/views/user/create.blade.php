@extends('layouts.carded')
@section('title', ' Add User')
@section('content')
<form action="/user" method="POST">
    @csrf
    <?php if(isset($user)){?>
        <div class="row">
            <div class="col-sm-6">
                <div class="bg-success m-2 p-1 text-dark rounded">{{ $user->name }} was successfully created</div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
                <label for="name"><strong>Name</strong></label>
                <input name="name" type="text" class="form-control" placeholder="First Last">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="email"><strong>Email</strong></label>
                <input name="email" type="email" class="form-control" placeholder="example@email.com">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
                <label for="password"><strong>Password</strong></label>
                <input name="password" type="password" class="form-control" placeholder="********">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="password_confirmation"><strong>Confirm Password</strong></label>
                <input name="password_confirmation" type="password" class="form-control" placeholder="********">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <strong>Permissions</strong>
        </div>
        <!-- checkbox -->
        <?php foreach ($permissions as $perm){ ?>
        <div class="col-sm-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="{{$perm->title}}">
                <label class="form-check-label">{{$perm->title}}</label>
            </div>
        </div>
        <?php } ?>
    </div>
    @foreach ($errors->all() as $error)
    <div class="col-sm-6">
        <div class="bg-danger m-2 p-1 text-dark rounded">{{ $error }}</div>
    </div>
    @endforeach
    <button type="submit" class="btn btn-primary pl-1 mt-3"><i class="fas fa-plus"></i> Create User</button>

</form>
@endsection
