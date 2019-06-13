@extends('layouts.dashboard')

@section('content')
	<my-dtr
		:dtr = "{{$dtr}}">
	</my-dtr>
@endsection
