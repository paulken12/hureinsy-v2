@extends('layouts.dashboard')

@section('content')
    <schedule-chart
        :emp_sched = "{{json_encode($emp_sched)}}"
        :emp_dtr = "{{$emp_dtr}}"
        :emp_info ="{{$emp_info}}"
        :holidays ="{{$holidays}}"
        :emp_shift ="{{$emp_shift}}">
    </schedule-chart>
@endsection
