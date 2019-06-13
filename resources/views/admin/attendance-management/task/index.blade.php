@extends('layouts.dashboard')

@section('content')
    <att-task
    	:cs = "{{$cs}}"
    	:et = "{{$et}}"
    	:ob = "{{$ob}}"
    	:ot = "{{$ot}}"
    	:tv = "{{$tv}}"
    	:employee = "{{$employee}}">
    </att-task>
@endsection
