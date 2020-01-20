@extends('layouts.nomenu')
@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h2>We just need a few more details...</h2>
        </div>
    </div>
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row justify-content-center">
          <section class="col-12">
          <user-preferences v-bind:user="{{ auth()->user() }}" v-bind:redirect="1"></user-preferences>
          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
@endsection
