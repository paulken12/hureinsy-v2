@extends('layouts.dashboard')

@section('content')
    <att-table
    	:list = "{{$list}}"
    	:employees = "{{$employees}}">
    </att-table>
@endsection
