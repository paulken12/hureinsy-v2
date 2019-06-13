@extends('layouts.dashboard')

@section('content')
<paf-confirmation-form
	:employees = "{{$employees}}"
	:list = "{{$list}}"
	:cchange = "{{$cchange}}"
	:substatus = "{{$substatus}}"
></paf-confirmation-form>
@endsection
