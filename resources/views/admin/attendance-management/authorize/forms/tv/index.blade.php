@extends('layouts.dashboard')

@section('content')
    <authorize-tv-form
    	:list = "{{$list}}"
    	:employees = "{{$employees}}">
    </authorize-tv-form>
@endsection
