@extends('layouts.dashboard')

@section('content')
    <tv-form
    	:list = "{{$list}}">
    </tv-form>
@endsection
