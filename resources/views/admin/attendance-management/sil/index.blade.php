@extends('layouts.dashboard')

@section('content')
    <sil-form
    	:sil = "{{$sil}}"
    	:emp = "{{$emp}}">
    </sil-form>
@endsection
