@extends('layouts.dashboard')

@section('content')
<paf-evaluation-form
	:employees = "{{$employees}}"
	:list = "{{$list}}"
	:cchange = "{{$cchange}}"
	:substatus = "{{$substatus}}"
	:beha = "{{$beha}}"
	:prof = "{{$prof}}"
	:over = "{{$over}}"
	:perf = "{{$perf}}">
</paf-evaluation-form>
@endsection
