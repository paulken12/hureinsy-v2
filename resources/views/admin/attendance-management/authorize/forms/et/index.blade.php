@extends('layouts.dashboard')

@section('content')
    <authorize-et-form
    	:list = "{{$list}}"
    	:employees = "{{$employees}}">
    </authorize-et-form>
@endsection
