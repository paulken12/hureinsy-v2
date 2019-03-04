@extends('layouts.dashboard')

@section('content')
	<shift-form
		:shift = "{{$shift}}">		
	</shift-form>
@endsection