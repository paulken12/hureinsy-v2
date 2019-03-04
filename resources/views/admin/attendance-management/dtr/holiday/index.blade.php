@extends('layouts.dashboard')

@section('content')
	<holiday-form
		:holiday = "{{$holiday}}">		
	</holiday-form>
@endsection