@extends('layouts.app')
@section('title-icon')
<i class="fas fa-users"></i>
@endsection
@section('title', 'User Management')
@section('content')
<div class="row">
  <div class="col-12 px-3">
  <org-user-management v-bind:users="{{ json_encode($users) }}" v-bind:invitations="{{ json_encode($invitations) }}"></org-user-management>
  </div>
</div>
@endsection
