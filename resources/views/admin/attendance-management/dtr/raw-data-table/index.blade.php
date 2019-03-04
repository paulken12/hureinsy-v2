@extends('layouts.dashboard')
@section('content')
    <dtr-table
        :dtr = "{{json_encode($raw_file)}}"
    ></dtr-table>
    
@endsection