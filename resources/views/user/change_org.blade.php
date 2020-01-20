@extends('layouts.nomenu')
@section('title', 'Organization / Change')
@section('title-icon')
    <i class="fas fa-sitemap"></i>
@endsection
@section('title-button')
<a class="btn btn-primary rounded float-right" href="{{ route('new_org') }}"><i class="fas fa-plus"></i> Create New Organization</a>
@endsection
@section('content')
<change-organization v-bind:org_list="{{ json_encode($userorgs) }}" v-bind:invitations="{{ json_encode($invitations) }}"></change-organization>
@endsection