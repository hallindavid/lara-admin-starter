@extends('layouts.carded')
@section('title')
<div class="row">
    <div class="col-sm-6">
        <h2> User Directory</h2>
    </div>
    <div class="col-sm-6">
        <button id="addButton" @click="addContact()" type="button" class="btn-primary btn float-right" data-toggle="modal"
        data-target="#addModal"> <i class="fas fa-plus"></i> Add Contact</button>
    </div>
@endsection
@section('content')
        <Users></Users>
@endsection
