@extends('layouts.carded')
@section('title', 'System Overview')
@section('title-icon')
    <i class="nav-icon fas fa-gears"></i>
@endsection
@section('content')
    <center><h4>Select a function<h4></center>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <table class="table table-condensed table-bordered">
                <tbody>
                    <tr>
                        <td width="25%"><form method="POST" action="{{ route('admin.reset_system') }}">
                                @csrf
                                <button  class="btn btn-danger btn-lg btn-block" type="submit">Reset System</button>
                            </form>
                        </td>
                        <td class="align-middle">
                            <p>This will log you out - erase the entire database, and re-seed with default information</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection