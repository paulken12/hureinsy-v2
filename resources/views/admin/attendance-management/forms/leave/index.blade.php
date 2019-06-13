@extends('layouts.dashboard')

@section('content')
    <leave-form
    	:list = "{{$list}}"
    	:sil = "{{$sil}}"
    	:emp = "{{$emp}}"
    	:leave = "{{$leave}}">
    </leave-form>
@endsection
