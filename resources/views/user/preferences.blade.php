@extends('layouts.app')
@section('title-icon')
<i class="fas fa-tools"></i>
@endsection
@section('title', 'Preferences')
@section('content')
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row justify-content-center">
          <section class="col-12">
          <user-preferences v-bind:user="{{ auth()->user() }}"></user-preferences>
          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
@endsection
