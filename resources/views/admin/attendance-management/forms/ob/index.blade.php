@extends('layouts.dashboard')

@section('content')
    <ob-form
    	:list = "{{$list}}">
    </ob-form>
@endsection
