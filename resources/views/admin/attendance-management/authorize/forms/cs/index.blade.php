@extends('layouts.dashboard')

@section('content')
    <authorize-cs-form
    	:list = "{{$list}}"
    	:employees = "{{$employees}}">
    </authorize-cs-form>
@endsection
