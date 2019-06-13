@extends('layouts.dashboard')

@section('content')
    <authorize-ot-form
    	:list = "{{$list}}"
    	:employees = "{{$employees}}">
    </authorize-ot-form>
@endsection
