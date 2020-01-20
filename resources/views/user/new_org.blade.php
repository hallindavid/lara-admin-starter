@extends('layouts.nomenu')
@section('title', 'Organization / Create')
@section('title-icon')
    <i class="fas fa-sitemap"></i>
@endsection
@section('content')
<create-organization v-bind:user="{{ json_encode(auth()->user()) }}"></create-organization>
@endsection