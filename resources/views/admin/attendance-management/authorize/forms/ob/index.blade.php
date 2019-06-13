@extends('layouts.dashboard')

@section('content')
    <authorize-ob-form
    	:list = "{{$list}}"
    	:employees = "{{$employees}}">
    </authorize-ob-form>
@endsection
