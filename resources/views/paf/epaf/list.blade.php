@extends('layouts.dashboard')

@section('content')
<paf-approval-form
	:employees = "{{$employees}}"
	:list = "{{$list}}"
	:cchange = "{{$cchange}}"
	:substatus = "{{$substatus}}">
</paf-approval-form>
@endsection
