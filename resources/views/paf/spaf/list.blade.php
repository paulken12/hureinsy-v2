@extends('layouts.dashboard')

@section('content')
<paf-view-form
	:employees = "{{$employees}}"
	:list = "{{$list}}"
	:cchange = "{{$cchange}}"
	:substatus = "{{$substatus}}">
</paf-view-form>
@endsection
